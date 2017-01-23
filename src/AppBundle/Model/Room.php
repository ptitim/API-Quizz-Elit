<?php

namespace AppBundle\Model;

class Room{
    protected $id;
    protected $name;
    protected $clients;
    protected $questions;
    protected $category;
    static private $rooms;

    public function __construct($idUser){
        $this->id = $idUser;
    }

    public function joinRoom($client){
        if(count($this->clients) > 2){
            return ;
        }else{
            array_push($this->clients, $client);
        }
    }

    public function __destruct(){
        echo sprintf($this->id . ' room destroyed');
    }

    static public function getRoom($id){
        foreach($room as $this->rooms){
            if($room->getId() == $id){
                return $room;
            }
        }
    }

    public function getClients(){
        return $this->clients;
    }

    /**
    *@return array
    */
    static public function getEmptyRooms(){
        $tmp = array_filter($this->rooms, function($item){
            if(count($item) <2){
                return $item;
            }else{
                return ;
            }
        });
        return $tmp;
    }
    /**
    *Get Id
    */
    public  function getId(){
        return $this->id;
    }
}
