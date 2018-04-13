<?php

declare(strict_types=1);

namespace CrateSystem\commands;

use CrateSystem\Main;

class CommandManager{

    /** @var Main */
    private $main;

    /**
     * CommandManager constructor.
     * @param Main $main
     */
    public function __construct(Main $main){
        $this->main = $main;
        $this->registerCommands();
    }


    public function registerCommands() : void{
        $commands = [
            new CrateCommand($this->main),
            new KeyCommand($this->main)
        ];
        $this->main->getServer()->getCommandMap()->registerAll("CrateSystem", $commands);
    }
}