<?php

declare(strict_types=1);

namespace CrateSystem;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use CrateSystem\commands\CommandManager;
use CrateSystem\crates\CrateManager;
use CrateSystem\events\EventManager;

class Main extends PluginBase{

    /** @var CrateManager */
    public $CrateManager;

    public function onEnable() : void{
        $this->registerManager();
        $this->getLogger()->info("CrateSystem has been loaded!");
    }

    public function registerManager() : void{
        new Configuration($this);
        new CommandManager($this);
        new EventManager($this);
        $this->CrateManager = new CrateManager($this);
        //$this->KeyManager = new KeyManager($this);
    }

    public function getCfg() : Config{
        return new Config($this->getDataFolder() . "config.yml", Config::YAML);
    }

    public function getPlayerCfg(Player $player) : Config{
        return new Config($this->getPlayer($player), Config::YAML);
    }

    public function getItemCfg() : Config{
        return new Config($this->getDataFolder() . "items.yml", Config::YAML);
    }

    public function getPlayer(Player $player) : string{
        return $this->getDataFolder() . "players" . DIRECTORY_SEPARATOR . strtolower($player->getName()) . ".yml";
    }
}