<?php
require("phpMQTT.php");

use Bluerhinos\phpMQTT;


class mqttPublish
{
    protected $mqtt;

    public function __construct() {

        $server = "192.168.1.242";     // change if necessary
        $port = 1883;                     // change if necessary
        $username = "";                   // set your username
        $password = "";                   // set your password
        $client_id = "phpMQTT-publisher"; // make sure this is unique for connecting to sever - you could use uniqid()

        $this->mqtt = new phpMQTT($server, $port, $client_id);

        if (!$this->mqtt->connect(true, NULL, $username, $password)) 
            return null;        
    }

    public function publish($topic , $message , $retain)
    {
        $this->mqtt->publish($topic, $message, $retain);        
    }

    public function close()
    {
        $this->mqtt->close();
    }
}






?>


