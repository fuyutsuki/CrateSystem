<?php

declare(strict_types=1);

namespace CrateSystem\crates;

use pocketmine\item\Item;
use pocketmine\Player;
use pocketmine\utils\{
    Config, TextFormat as C
};
use CrateSystem\Main;

class UIManager{

    /** @var Main */
    private $plugin;

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
    }

    public function crateUI(Player $player) : void{
        $form = $this->plugin->FormAPI->createSimpleForm(function (Player $player, array $data){
            switch($data[0]){
                case 0:
                    $player->sendMessage(C::RED . "Exiting Crates");
                    return;
                case 1:
                    if($this->plugin->getCfg($player)->get("Common") >= 1){
                        $item = mt_rand($this->plugin->getItemCfg()->get("Common"));
                        $player->getInventory()->addItem(Item::get($item));
                    }else{
                        $player->sendMessage(C::RED . "You do not have any common keys!");
                    }
                    return;
                case 2:
                    if($this->plugin->getCfg($player)->get("Vote") >= 1){
                        $item = mt_rand($this->plugin->getItemCfg()->get("Vote"));
                        $player->getInventory()->addItem(Item::get($item));
                    }else{
                        $player->sendMessage(C::RED . "You do not have any vote keys!");
                    }
                    return;
                case 3:
                    if($this->plugin->getCfg($player)->get("Rare") >= 1){
                        $item = mt_rand($this->plugin->getItemCfg()->get("Rare"));
                        $player->getInventory()->addItem(Item::get($item));
                    }else{
                        $player->sendMessage(C::RED . "You do not have any rare keys!");
                    }
                    return;
                case 4:
                    if($this->plugin->getCfg($player)->get("Legendary") >= 1){
                        $item = mt_rand($this->plugin->getItemCfg()->get("Legendary"));
                        $player->getInventory()->addItem(Item::get($item));
                    }else{
                        $player->sendMessage(C::RED . "You do not have any legendary keys!");
                    }
                    return;
            }
        });

        $form->setTitle(C::BLUE . "Crates List");
        $form->setContent("");
        $form->addButton(C::WHITE . "Exit");
        $form->addButton(C::GREEN . "Common " . C::GRAY . "- " . C::YELLOW . $this->plugin->getCfg($player)->get("Common"));
        $form->addButton(C::RED . "Vote " . C::GRAY . "- " . C::YELLOW . $this->plugin->getCfg($player)->get("Vote"));
        $form->addButton(C::GOLD . "Rare " . C::GRAY . "- " . C::YELLOW . $this->plugin->getCfg($player)->get("Rare"));
        $form->addButton(C::AQUA . "Legendary " . C::GRAY . "- " . C::YELLOW . $this->plugin->getCfg($player)->get("Legendary"));
        $form->sendToPlayer($player);
    }
}