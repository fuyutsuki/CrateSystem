<?php

declare(strict_types=1);

namespace CrateSystem\commands;

use CrateSystem\Main;

class CommandManager{

    /** @var Main */
    private $plugin;

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
        $this->registerCommands();
    }

    public function registerCommands() : void{
        $commands = [
            new CrateCommand($this->plugin),
            new KeyCommand($this->plugin)
        ];
        $this->plugin->getServer()->getCommandMap()->registerAll("CrateSystem", $commands);
    }
}