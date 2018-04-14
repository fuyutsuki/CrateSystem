<?php

declare(strict_types=1);

namespace CrateSystem;

class Configuration{

    /** @var Main */
    private $main;

    public function __construct(Main $main){
        $this->main = $main;
        $this->registerConfig();
    }

    private function registerConfig() : void{
        $this->main->saveResource("items.yml");
        $this->main->saveResource("config.yml");
        if(!is_dir($this->main->getDataFolder() . "players")) @mkdir($this->main->getDataFolder() . "players");
    }
}