<?php

declare(strict_types=1);

namespace CrateSystem\commands;

use pocketmine\Server;
use pocketmine\command\{
    Command, CommandSender, PluginIdentifiableCommand
};
use pocketmine\plugin\Plugin;

use CrateSystem\Main;

abstract class BaseCommand extends Command implements PluginIdentifiableCommand{

    /** @var Main */
    private $plugin;

    public function __construct(string $name, Main $plugin){
        parent::__construct($name);
        $this->plugin = $plugin;
        $this->usageMessage = "";
    }

    public function getPlugin() : Plugin{
        return $this->plugin;
    }

    public function getServer() : Server{
        return $this->plugin->getServer();
    }

}