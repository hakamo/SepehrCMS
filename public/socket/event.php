<?php 
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use React\Socket\Server as Reactor;
use React\EventLoop\Factory as LoopFactory;;
require dirname(__FILE__) . '/../../../vendor/autoload.php';


$clients = null;

class Server implements MessageComponentInterface
{   
    public function __construct(React\EventLoop\LoopInterface $loop) 
    {
        global $clients;
        $clients = new \SplObjectStorage;

        // Breathe life into the game
        $loop->addPeriodicTimer(40, function() 
        {
            $this->doTick();
        });
    }

    public function onOpen(ConnectionInterface $ch) 
    {
        global $clients;
        $clients->attach($ch);

        $controller = new   Controller($ch);
        $controller->login();
    }

    public function onMessage(ConnectionInterface $ch, $args) 
    {
        $controller = new Controller($ch, $args);

        if($controller->isLoggedIn())
        {
            $controller->interpret();
        }
        else
        {
            $controller->login();
        }

    }

    public function onClose(ConnectionInterface $conn) 
    {
        global $clients;
        $clients->detach($conn);
        echo "Connection {$conn->resourceId} has disconnected\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) 
    {
        echo "An error has occurred: {$e->getMessage()}\n";
        $conn->close();
    }

    public function doTick()
    {
        global $clients;
        $update = new Update($clients);
    }
}

$loop = LoopFactory::create();
$socket = new Reactor($loop);
$socket->listen(9000, '127.0.0.1');
$server = new IoServer(new HttpServer(new WsServer(new Server($loop))), $socket, $loop);
$server->run();