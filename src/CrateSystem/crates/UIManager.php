<?php

declare(strict_types=1);

namespace CrateSystem\crates;

use pocketmine\Player;
use pocketmine\utils\{
	Config, TextFormat as C
};

use CrateSystem\Main;

class UIManager{

	/** @var Main */
	private $plugin;

	public function __construct(Main $plugin){
		$this->plugin = $plugin;
	}

	public function CrateUI(Player $player){
		$this->cfg = $this->getCfg($player);
		$form = $this->plugin->FormAPI->createSimpleForm(function (Player $player, array $data){
			$result = $data[0];
			switch($result){
				case 1:
				break;
			}
		});

		$form->setTitle(C::BLUE . "Crates List");
		$form->setContent("");

		$form->addButton(C::WHITE . "Exit");
		$form->addButton(C::GREEN . "Common " . C::GRAY . "- " . C::YELLOW . $this->cfg->get("Common"));
		$form->addButton(C::RED . "Vote " . C::GRAY . "- " . C::YELLOW . $this->cfg->get("Vote"));
		$form->addButton(C::GOLD . "Rare " . C::GRAY . "- " . C::YELLOW . $this->cfg->get("Rare"));
		$form->addButton(C::AQUA . "Legendary " . C::GRAY . "- " . C::YELLOW . $this->cfg->get("Legendary"));

		$form->sendToPlayer($player);
	}

	public function getPlayer(Player $player){
		return $this->plugin->getDataFolder() . "players" . DIRECTORY_SEPARATOR . strtolower($player->getName()) . ".yml";
	}

	public function getCfg(Player $player){
		return new Config($this->getPlayer($player), Config::YAML);
	}
}