<?php
declare(strict_types=1);

namespace CrateSystem\commands;

use pocketmine\Player;
use pocketmine\command\CommandSender;
use pocketmine\level\sound\EndermanTeleportSound;
use pocketmine\math\Vector3;
use pocketmine\lang\TranslationContainer;
use pocketmine\utils\{
    Config, TextFormat as C
};

use CrateSystem\crates\UIManager;
use CrateSystem\Main;

class KeyCommand extends BaseCommand{

    /** @var Main */
    private $plugin;

    public $keys = ["Common"];

    public function __construct(Main $plugin){
        parent::__construct("key", $plugin);
        $this->plugin = $plugin;
        $this->setDescription("Key Command.");
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args) : bool{
        $usage = "Usage: /key <player> <key> <amount>";
        if(!$sender->hasPermission("cratesystem.key")){
            $sender->sendMessage(new TranslationContainer(C::RED . "%commands.generic.permission"));
            return false;
        }

        if(count($args) < 1){
            $sender->sendMessage($usage);
            return true;
        }

        if(!isset($args[1])){
            $sender->sendMessage($usage);
            return true;
        }

        $player = $this->getServer()->getPlayerExact($args[0]);
        if(!$player instanceof Player){
            if($player instanceof ConsoleCommandSender){
                $sender->sendMessage(C::RED . "Please provide a player.");
                return false;
            }
            $sender->sendMessage(C::RED . "$args[0] player cannot be found.");
            return false;
        }

        if($args[1] == in_array($args[1], ["Common", "Vote", "Rare", "Legendary"])){
            $this->cfg = $this->getCfg($player);
            $this->cfg->set($args[1], $args[2]);
            $this->cfg->save();
            $sender->sendMessage(C::GREEN . "Successfully Gave {$player->getName()} $args[2] $args[1] Crate!");
            $player->sendMessage(C::YELLOW . "You now have $args[2] $args[1] Crate.");
        }else{
            $sender->sendMessage(C::RED . "Could'nt found Crate $args[1]");
        }

        return true;
    }

    public function getPlayer(Player $player){
        return $this->plugin->getDataFolder() . "players" . DIRECTORY_SEPARATOR . strtolower($player->getName()) . ".yml";
    }

    public function getCfg(Player $player){
        return new Config($this->getPlayer($player), Config::YAML);
    }
}