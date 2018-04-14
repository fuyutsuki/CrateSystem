<?php

declare(strict_types=1);

namespace CrateSystem\events;

use CrateSystem\Main;

class EventManager{

    /** @var Main */
    private $main;

    public function __construct(Main $main){
        $this->main = $main;
        $this->registerEvents();
    }

    private function registerEvents() : void{
        new JoinEventListener($this->main);
    }
}