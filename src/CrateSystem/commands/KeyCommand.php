<?php
declare(strict_types=1);

namespace CrateSystem\commands;

use pocketmine\command\ConsoleCommandSender;
use pocketmine\Player;
use pocketmine\command\CommandSender;
use pocketmine\lang\TranslationContainer;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat as C;

use CrateSystem\Main;

class KeyCommand extends BaseCommand{

    /** @var Main */
    private $main;
    /** @var Config $cfg */
    private $cfg;

    public function __construct(Main $main){
        parent::__construct("key", $main);
        $this->main = $main;
        $this->setDescription("Key Command.");
    }

    /**
     * @param CommandSender $sender
     * @param string $commandLabel
     * @param array $args
     * @return bool
     */
    public function execute(CommandSender $sender, string $commandLabel, array $args) : bool{
        $usage = "Usage: /key <player> <key> <amount>";

        if(!$sender->hasPermission("cratesystem.key")){
            $sender->sendMessage(new TranslationContainer(C::RED . "%commands.generic.permission"));
            return false;
        }

        if(count($args) < 1){
            $sender->sendMessage($usage);
            return false;
        }

        if(!isset($args[1])){
            $sender->sendMessage($usage);
            return false;
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
            $this->cfg = $this->getMain()->getPlayerCfg($player);
            $this->cfg->set($args[1], $args[2]);
            $this->cfg->save();
            $sender->sendMessage(C::GREEN . "Successfully Gave {$player->getName()} $args[2] $args[1] Crate!");
            $player->sendMessage(C::YELLOW . "You now have $args[2] $args[1] Crate.");
        }else{
            $sender->sendMessage(C::RED . "Could'nt found Crate $args[1]");
            return false;
        }

        return true;
    }
    public function getMain(): Main{
        return $this->main;
    }
}