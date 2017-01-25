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
        if(isset($rawdata)){
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
                    $this->game_join($data, $from);
                    break;
                case "game.select":
                    $this->game_select($data);
                    break;
                case "game.score":
                    $this->game_score($data);
                    break;
                case "game.end":
                    $this->game_end($data);
                    break;
                default:
                    break;

            }
        }

        // $from->send('your messages is :', $rawData);

        // $numRecv = count($this->clients) - 1;
        // echo sprintf('Connection %d sending message "%s" to %d other connection%s' . "\n"
        //     , $from->resourceId, $msg, $numRecv, $numRecv == 1 ? '' : 's');

        // foreach ($this->clients as $client) {
        //     if ($from !== $client) {
        //         // The sender is not the receiver, send to each client connected
        //         $client->send($rawData);
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

    private function game_create($data, $idWS){
        $room = new Room($data->idUser, $data->category);
        $client = new Client($data->idUser, $idWS);
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
            $client->send(json_encode(array('type'=> 'game_start','quetions' => $questions)));
        }
    }

    private function game_select($data){
        $room  = Room::getRoom($data->idRoom);
        $clients = $room->getClients();

        foreach($client as $clients){
            $client->send(json_encode(array('type' => 'game.select', 'idUser' => $client->getIdUser(),'selection' => $data->selection)));
        }
    }
    private function game_score($data){
      $room = Room::getRoom($data->idRoom);
      $clients = $room->getClients();

      foreach ($client as $clients) {
            $client->send(json_encode(array('type' =>'game.score', 'idUser' => $client->getIdUser(),'score' => $data->score)));
      }
    }

    private function game_join($data, $idWS){
        $room = Room::getRoom($data->idRoom);
        $client = new Client($data->idUser, $idWS);
        $room->joinRoom($client);
        $clients = $room->getClients();

        foreach($item as $clients ){
            $item->send(json_encode(array('type' => 'game.join', 'user' => $item->getUserInfo() )));
        }
    }

    private function game_end($data){
        $room = Room::getRoom($data->idRoom);
        
        foreach($client as $room->getClients){
            $client->setNewScoreTotal($data->scoreTotal);
        }
    }

}
