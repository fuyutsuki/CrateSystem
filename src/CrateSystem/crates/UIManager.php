<?php

declare(strict_types=1);

namespace CrateSystem\crates;

use pocketmine\Player;
use pocketmine\item\Item;
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
        $this->cfg = $this->plugin->getPlayerCfg($player);
        $form = $this->plugin->FormAPI->createSimpleForm(function (Player $player, array $data){
            $result = $data[0];
            if($result != null){
            }
            switch($result){
                case 1:
                return;
            }
        });

        $form->setTitle(C::BLUE . "Crates List");
        $form->addButton(C::WHITE . "Exit");
        $form->addButton(C::GREEN . "Common " . C::GRAY . "- " . C::YELLOW . $this->cfg->get("Common"));
        $form->addButton(C::RED . "Vote " . C::GRAY . "- " . C::YELLOW . $this->cfg->get("Vote"));
        $form->addButton(C::GOLD . "Rare " . C::GRAY . "- " . C::YELLOW . $this->cfg->get("Rare"));
        $form->addButton(C::AQUA . "Legendary " . C::GRAY . "- " . C::YELLOW . $this->cfg->get("Legendary"));
        $form->sendToPlayer($player);
    }

    public function Common(Player $player){
        $this->cfg = $this->plugin->getPlayerCfg($player);
        if($this->cfg->get("Common") >= 1){
            $item = mt_rand($this->plugin->getItemCfg()->get("Common"));
            $player->getInventory()->addItem(Item::get($item));
        }else{
            $player->sendMessage(C::RED . "You don't have any Common key.");
        }
    }
}