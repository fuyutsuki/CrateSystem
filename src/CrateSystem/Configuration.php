<?php

declare(strict_types=1);

namespace CrateSystem;

class Configuration{

    /** @var Main */
    private $plugin;

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
        $this->registerConfig();
    }

    public function registerConfig() : void{
        $this->plugin->saveResource("items.yml");
        $this->plugin->saveResource("config.yml");
        if(!is_dir($this->plugin->getDataFolder() . "players")) @mkdir($this->plugin->getDataFolder() . "players");
    }
}