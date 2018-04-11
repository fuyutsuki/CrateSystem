<?php

declare(strict_types=1);

namespace CrateSystem\events;

use pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\utils\Config;

use CrateSystem\Main;

class JoinEvent implements Listener{

	/** @var Main */
	private $plugin;

	public function __construct(Main $plugin){
		$this->plugin = $plugin;
		$plugin->getServer()->getPluginManager()->registerEvents($this, $plugin);
	}

	public function getPlayer(Player $player){
		return $this->plugin->getDataFolder() . "players" . DIRECTORY_SEPARATOR . strtolower($player->getName()) . ".yml";
	}

	public function getCfg(Player $player){
		return new Config($this->getPlayer($player), Config::YAML);
	}

	public function RegPlayer(Player $player){
		new Config($this->getPlayer($player), Config::YAML, [
			"Common" => 0,
			"Vote" => 0,
			"Rare" => 0,
			"Legendary" => 0
		]);
	}

	public function onJoin(PlayerJoinEvent $event): void{
		$player = $event->getPlayer();

		if(!file_exists($this->plugin->getDataFolder() . "players" . DIRECTORY_SEPARATOR . strtolower($player->getName()) . ".yml")){
			$this->RegPlayer($player);
		}
	}
}