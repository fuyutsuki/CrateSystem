<?php

declare(strict_types=1);

namespace CrateSystem\commands;

use pocketmine\plugin\Plugin;
use pocketmine\Server;
use pocketmine\command\{
    Command, PluginIdentifiableCommand
};

use CrateSystem\Main;

abstract class BaseCommand extends Command implements PluginIdentifiableCommand{

    /** @var Main */
    private $main;

    /**
     * BaseCommand constructor.
     * @param string $name
     * @param Main $main
     */
    public function __construct(string $name, Main $main){
        parent::__construct($name);
        $this->main = $main;
        $this->usageMessage = "";
    }

    /**
     * @return Main
     */
    public function getPlugin() : Plugin{
        return $this->getMain();
    }

    /**
     * @return Server
     */
    public function getServer() : Server{
        return $this->getMain()->getServer();
    }

    /**
     * @return Main
     */
    public function getMain(): Main{
        return $this->main;
    }
}