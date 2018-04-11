<?php

declare(strict_types=1);

namespace CrateSystem\crates;

use pocketmine\Player;
use pocketmine\utils\{
    Config, TextFormat as C
};
use CrateSystem\Main;

class UIManager{

    /** @var Main */
    private $plugin;
    /** @var Config */
    private $cfg;

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
    }

    public function crateUI(Player $player) : void{
        $this->cfg = $this->getCfg($player);
        $form = $this->plugin->FormAPI->createSimpleForm(function (Player $player, array $data){
            switch($data[0]){
                case 1:
                    return;
            }
        });

        $form->setTitle(C::BLUE . "Crates List");
        $form->setContent("");
        $form->addButton(C::WHITE . "Exit");
        $form->addButton(C::GREEN . "Common " . C::GRAY . "- " . C::YELLOW . $this->cfg->get("Common"));
        $form->addButton(C::RED . "Vote " . C::GRAY . "- " . C::YELLOW . $this->cfg->get("Vote"));
        $form->addButton(C::GOLD . "Rare " . C::GRAY . "- " . C::YELLOW . $this->cfg->get("Rare"));
        $form->addButton(C::AQUA . "Legendary " . C::GRAY . "- " . C::YELLOW . $this->cfg->get("Legendary"));
        $form->sendToPlayer($player);
    }

    public function getPlayer(Player $player) : string{
        return $this->plugin->getDataFolder() . "players" . DIRECTORY_SEPARATOR . strtolower($player->getName()) . ".yml";
    }

    public function getCfg(Player $player) : Config{
        return new Config($this->getPlayer($player), Config::YAML);
    }
}