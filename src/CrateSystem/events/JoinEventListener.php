<?php

declare(strict_types=1);

namespace CrateSystem\events;

use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\Config;
use CrateSystem\Main;

class JoinEventListener implements Listener{

    /** @var Main */
    private $main;

    public function __construct(Main $main){
        $this->main = $main;
        $main->getServer()->getmainManager()->registerEvents($this, $main);
    }

    public function onJoin(PlayerJoinEvent $event) : void{
        $player = $event->getPlayer();
        if(!file_exists($this->main->getDataFolder() . "players" . DIRECTORY_SEPARATOR . strtolower($player->getName()) . ".yml")){
            $this->regPlayer($player);
        }
    }

    public function regPlayer(Player $player) : void{
        new Config($this->main->getPlayer($player), Config::YAML, [
            "Common" => 0,
            "Vote" => 0,
            "Rare" => 0,
            "Legendary" => 0
        ]);
    }
}