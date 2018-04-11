<?php
declare(strict_types=1);

namespace CrateSystem\commands;

use pocketmine\Player;
use pocketmine\command\CommandSender;
use pocketmine\level\sound\EndermanTeleportSound;
use pocketmine\math\Vector3;
use pocketmine\utils\{
    Config, TextFormat as C
};

use CrateSystem\crates\UIManager;
use CrateSystem\Main;

class CrateCommand extends BaseCommand{

    /** @var Main */
    private $plugin;
    /** @var Config */
    private $cfg;
    /** @var UIManager */
    private $UIManager;

    public function __construct(Main $plugin){
        parent::__construct("crate", $plugin);
        $this->plugin = $plugin;
        $this->setDescription("Crate Command.");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : bool{
        $this->cfg = new Config($this->plugin->getDataFolder() . "config.yml", Config::YAML);
        $this->UIManager = new UIManager($this->plugin);

        if(!$sender instanceof Player){
            $sender->sendMessage(C::RED . "Please use this command ingame.");
            return false;
        }

        if($this->cfg->get("type") == "ui"){
            $this->UIManager->CrateUI($sender);
        }
        return true;
    }
}