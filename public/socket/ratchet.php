<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;

// Make sure composer dependencies have been installed
require __DIR__.'/../../bootstrap/autoload.php';


/**
 * chat.php
 * Send any incoming messages to all connected clients (except sender)
 */
class MyChat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {

        $this->clients->attach($conn);

        $conn->send('ping');

        echo ('new client connect'."\n\r");
    }

    public function onMessage(ConnectionInterface $from, $msg) {


        try
        {
            if($msg == "client-count")
            {
                echo "client count is : ". $this->clients->count()."\n\r";
                return;                
            }
            
	        echo  "new message : " .$msg."\n\r";

            
            foreach ($this->clients as $client) {
                //if ($from != $client) {
                $client->send($msg);
                // }
            }
        }
        catch (\Exception $exception)
        {
            echo $exception->getMessage();
        }


        
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);

        echo "client closed ."."\n\r";
    }
    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();


        echo $e->getMessage()."\n\r";
    }
}


/*
// Run the server application through the WebSocket protocol on port 8080
$app = new Ratchet\App('127.0.0.1', 8080);
$app->route('/chat', new MyChat);
$app->route('/echo', new Ratchet\Server\EchoServer, array('*'));

echo("server running ...\n");
$app->run();
 */

$server = IoServer::factory(
       new HttpServer( 
           new WsServer(
               //new Ratchet\Server\EchoServer()
               new MyChat()
           )
       ),
       8080
   );


$server->run();