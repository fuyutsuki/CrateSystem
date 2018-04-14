<?php

declare(strict_types=1);

namespace CrateSystem\crates;

use pocketmine\utils\Config;

use CrateSystem\Main;

class CrateManager{

    /** @var Main */
    private $main;

    public function __construct(Main $main){
        $this->main = $main;
    }

    public function getCfg() : Config{
    	return new Config($this->main->getDataFolder() . "config.yml", Config::YAML);
    }
}