<?php

declare(strict_types=1);

namespace CrateSystem\events;

use CrateSystem\Main;

class EventManager{

	/** @var Main */
	private $plugin;

	public function __construct(Main $plugin){
		$this->plugin = $plugin;
		$this->registerEvents();
	}

	public function registerEvents(): void{
		$p = $this->plugin;
		new JoinEvent($p);
	}
}