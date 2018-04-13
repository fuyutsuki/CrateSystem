<?php

declare(strict_types=1);

namespace CrateSystem\crates;

use pocketmine\utils\Config;

use CrateSystem\Main;

class CrateManager{

    /** @var Main */
    private $plugin;

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
    }

    public function getCfg(){
    	return new Config($this->plugin->getDataFolder() . "config.yml", Config::YAML);
    }
}