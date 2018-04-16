<?php

declare(strict_types=1);

namespace CrateSystem\crates;

use pocketmine\Player;
use pocketmine\Server;
use pocketmine\item\Item;
use pocketmine\utils\{
    Config, TextFormat as C
};
use CrateSystem\Main;

class UIManager{

    /** @var Main */
    private $main;
    /** @var Config $cfg */
    private $cfg;

    /**
     * UIManager constructor.
     * @param Main $main
     */
    public function __construct(Main $main){
        $this->main = $main;
    }

    /**
     * @param Player $player
     * @return void
     */
    public function crateUI(Player $player) : void{
        $this->cfg = $this->getMain()->getPlayerCfg($player);
        $form = Server::getInstance()->getPluginManager()->getPlugin("FormAPI")->createSimpleForm(function (Player $player, $data){
            // NOTE: $data returns int (SimpleForm key)
            if($data !== null) {
                switch ($data) {
                    case 1:
                        var_dump("Common");
                        return;
                    case 2:
                        var_dump("Vote");
                        return;
                }
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

    /**
     * @param Player $player
     * @return void
     */
    public function Common(Player $player) : void{
        $this->cfg = $this->getMain()->getPlayerCfg($player);
        if($this->cfg->get("Common") >= 1){
            $item = mt_rand($this->getMain()->getItemCfg()->get("Common"));
            $player->getInventory()->addItem(Item::get($item));
        }else{
            $player->sendMessage(C::RED . "You don't have any Common key.");
        }
    }

    public function getMain() : Main{
        return $this->main;
    }
}
