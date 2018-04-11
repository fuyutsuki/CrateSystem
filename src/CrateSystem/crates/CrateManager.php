<?php

declare(strict_types=1);

namespace CrateSystem\crates;

use pocketmine\utils\Config;

use CrateSystem\Main;

class CrateManager{

    /** @var Main */
    private $plugin;
    /** @var Config */
    private $cfg;

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
        $this->cfg = new Config($this->plugin->getDataFolder() . "items.yml", Config::YAML);
    }
}