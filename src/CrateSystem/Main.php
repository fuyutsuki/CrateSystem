<?php

declare(strict_types=1);

namespace CrateSystem;

use pocketmine\plugin\PluginBase;

use CrateSystem\commands\CommandManager;
use CrateSystem\crates\CrateManager;
use CrateSystem\key\KeyManager;
use CrateSystem\UIAPI\FormAPI;
use CrateSystem\events\EventManager;

class Main extends PluginBase{

	public function onEnable(){
		$this->registerManager();
		$this->getLogger()->info("CrateSystem has been loaded!");
	}

	public function registerManager(): void{
		new Configuration($this);
		new CommandManager($this);
		new EventManager($this);
		$this->CrateManager = new CrateManager($this);
		#$this->KeyManager = new KeyManager($this);
		$this->FormAPI = new FormAPI();
	}
}