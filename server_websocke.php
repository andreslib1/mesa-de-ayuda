<?php
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

require 'vendor/autoload.php';

class NotificationServer implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        // Aquí puedes procesar el mensaje que envió el cliente, si lo necesitas
    }

    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }

    public function sendNotification($notificationData) {
        foreach ($this->clients as $client) {
            $client->send(json_encode($notificationData));
        }
    }
}

$server = new \Ratchet\App('localhost', 8080);
$server->route('/notifications', new NotificationServer);
$server->run();

?>