<?php

namespace Jason8831\Chat\Tasks;

use pocketmine\scheduler\AsyncTask;

class DiscordTasks extends AsyncTask
{

    private $webhook, $c;

    public function __construct($webhook, $c)
    {
        $this->webhook = $webhook;
        $this->c = $c;
    }

    public function onRun(): void
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->webhook);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode(unserialize($this->c)));
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $reponse = curl_exec($curl);
        $resultat = ["Response" => $reponse];
        $this->setResult($resultat, true);
    }
}