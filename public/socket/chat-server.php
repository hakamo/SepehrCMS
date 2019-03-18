<?php

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use MyApp\Chat;


require dirname(__FILE__) . '/../../../vendor/autoload.php';

require_once('Chat.php');

// $_chat = new Chat();

 $server = IoServer::factory(new HttpServer( new WsServer( new Chat() ) ),8080);

//$server->loop->addPeriodicTimer(1, function () use ($_chat) {     
    
//    //foreach ($_chat->clients as $client) {                  
//    //        $client->send("hello client");          
//    //}

//    $_chat->broadcast('hello world');

   

//});

//echo('server loaded');


$server->run();



