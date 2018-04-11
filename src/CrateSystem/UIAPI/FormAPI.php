<?php

declare(strict_types=1);

namespace CrateSystem\UIAPI;

use pocketmine\plugin\PluginBase;
use pocketmine\event\{
    Listener, player\PlayerQuitEvent, server\DataPacketReceiveEvent
};
use pocketmine\network\mcpe\protocol\ModalFormResponsePacket;

class FormAPI extends PluginBase implements Listener{

    public $formCount = 0;
    public $forms = [];

    public function onEnable() : void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function createCustomForm(callable $function = null) : CustomForm{
        $this->formCount++;
        $form = new CustomForm($this->formCount, $function);
        if($function !== null){
            $this->forms[$this->formCount] = $form;
        }
        return $form;
    }

    public function createSimpleForm(callable $function = null) : SimpleForm{
        $this->formCount++;
        $form = new SimpleForm($this->formCount, $function);
        if($function !== null){
            $this->forms[$this->formCount] = $form;
        }
        return $form;
    }

    public function onPacketReceived(DataPacketReceiveEvent $ev) : void{
        $pk = $ev->getPacket();
        if($pk instanceof ModalFormResponsePacket){
            $player = $ev->getPlayer();
            $formId = $pk->formId;
            $data = json_decode($pk->formData, true);
            if(isset($this->forms[$formId])){
                $form = $this->forms[$formId];
                if(!$form->isRecipient($player)){
                    return;
                }
                $callable = $form->getCallable();
                if(!is_array($data)){
                    $data = [$data];
                }
                if($callable !== null){
                    $callable($ev->getPlayer(), $data);
                }
                unset($this->forms[$formId]);
                $ev->setCancelled();
            }
        }
    }

    public function onPlayerQuit(PlayerQuitEvent $ev)  : void{
        $player = $ev->getPlayer();
        foreach($this->forms as $id => $form){
            if($form->isRecipient($player)){
                unset($this->forms[$id]);
                return;
            }
        }
    }
}