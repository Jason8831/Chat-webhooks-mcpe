<?php

namespace Jason8831\Chat\API;


use Jason8831\Chat\Main;
use Jason8831\Chat\Tasks\DiscordTasks;

class DiscordAPI
{

    /**
     * @param string $message
     * @param string $webook
     * @param string $sujet
     * @return void
     */
    public static function message(string $message, string $webook, string $sujet): void{
        $c = ["content" => $message, "username" => $sujet];
        Main::getInstance()->getServer()->getAsyncPool()->submitTask(new DiscordTasks($webook, serialize($c)));
    }
}