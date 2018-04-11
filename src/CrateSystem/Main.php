<?php

declare(strict_types=1);

namespace CrateSystem;

use pocketmine\Player;
use pocketmine\plugin\PluginBase;

use CrateSystem\commands\CommandManager;
use CrateSystem\crates\CrateManager;
use CrateSystem\key\KeyManager;
use CrateSystem\UIAPI\FormAPI;
use CrateSystem\events\EventManager;
use pocketmine\utils\Config;

class Main extends PluginBase{

    /** @var FormAPI */
    public $FormAPI;
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
        $this->FormAPI = new FormAPI();
    }

    public function getPlayer(Player $player) : string{
        return $this->getDataFolder() . "players" . DIRECTORY_SEPARATOR . strtolower($player->getName()) . ".yml";
    }

    public function getCfg(Player $player) : Config{
        return new Config($this->getPlayer($player), Config::YAML);
    }

    public function getItemCfg() : Config{
        return new Config($this->getDataFolder() . "items.yml", Config::YAML);
    }
}