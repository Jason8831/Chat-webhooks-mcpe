<?php

namespace Jason8831\Chat\Events;

use Jason8831\Chat\API\DiscordAPI;
use Jason8831\Chat\Main;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\utils\Config;

class PlayersChatEvents implements Listener
{

    /**
     * @param PlayerChatEvent $event
     * @return void
     */

    public function tchat(PlayerChatEvent $event): void{
        $config = new Config(Main::getInstance()->getDataFolder() . "config.yml", Config::YAML);
        $player = $event->getPlayer();
        $msg = $event->getMessage();
        $name = $player->getName();

        $msg = str_replace(" @", " ", $msg);

        date_default_timezone_set("Europe/Paris");
        $playername = str_replace(["§1", "§2", "§3", "§4", "§5", "§6", "§7", "§8", "§9", "§a", "§b", "§c", "§d", "§e", "§f", "§l", "§o", "§k", "§r"], [" ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " ", " "], $player->getNameTag());
        $message = "[" . strftime("%H:%M:%S") . "]" . $playername . ": $msg";
        $webhook = $config->get("webhook");
        DiscordAPI::message($message, $webhook, "Chat In Game");
    }

}