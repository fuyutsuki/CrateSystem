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

	public function registerCommands(): void{
		$p = $this->plugin;

		$commands = [
			new CrateCommand($p),
			new KeyCommand($p)
		];

		$this->plugin->getServer()->getCommandMap()->registerAll("CrateSystem", $commands);
	}
}