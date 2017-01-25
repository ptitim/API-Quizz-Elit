<?php
namespace AppBundle\Controller;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

use AppBundle\Model\Room;

class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        // Store the new connection to send messages to later
        $this->clients->attach($conn);
        echo "New connection! ({$conn->resourceId})\n";
        $conn->send('{"id": '.$conn->resourceId.'}');
    }

    public function onMessage(ConnectionInterface $from, $rawData) {
        $data = json_decode($rawData);

        switch ($data->type){
            case "game.create":
                $this->game_create($data, $from);
                break;
            case "game.start":
                $this->game_start($data);
                break;
            case "websocket.state":
                return true;
            case "game.join":
                break;
            case "game.select":
                break;
            case "game.score":
                break;
            case "game.end":
                break;
            default:
                break;

        }
        // $numRecv = count($this->clients) - 1;
        // echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
        //     , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        // foreach ($this->clients as $client) {
        //     if ($from !== $client) {
        //         // The sender is not the receiver, send to each client connected
        //         $client->send($msg);
        //     }
        // }
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

    private function game_create($data, $client){
        $room = new Room($data->idUser, $data->category);
        $room->joinRoom($client);

        $idRoom = $room->getId();
        $json = json_encode(array('type'=>'game.create', 'idRoom' => $idRoom));
        $client->send($json);
    }

    private function game_start($data){
        $room  = Room::getRoom($data->idRoom);
        $clients = $room->getClients();
        $quesions = $room->setQuestions()->getQuestions();

        foreach($client as $clients){
            $client->send($questions);
        }
    }

    private function game_select($data){
        $room  = Room::getRoom($data->idRoom);
        $clients = $room->getClients();

        foreach($client as $clients){
            $client->send(json_encode(array('idUser' => $client->getIdUser(),'selection' => $data->selection)));
        }
    }

    private function game_join($data){
        $room = Room::getRoom($data->idRoom);

        array_map(function($client){

        });
    }

}
