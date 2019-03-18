<?php
namespace MyApp;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Thread;


class Chat implements MessageComponentInterface {

    protected  $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
        
        echo "constructed  ";
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);

        echo "New connection! ({$conn->resourceId})\n";
    }
    
    public function onClose(ConnectionInterface $conn) {
        // The connection is closed, remove it, as we can no longer send it messages
        $this->clients->detach($conn);

        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "An error has occurred: {$e->getMessage()}\n";

        $conn->close();
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        //$numRecv = count($this->clients) - 1;
        //echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n" , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');


        echo $msg;

        //foreach ($this->clients as $client) {
            
        //    $client->send($msg);    
            
        //    echo($client->resourceId.' timer :' . $msg);
        //}
       
    } 
    
    public function broadcast($msg)
    {
        foreach ($this->clients as $client) {
            
                $client->send($msg);    
                
                echo($client->resourceId.' timer :' . $msg);
        }
    }
}








