<?php

namespace AppBundle\Model;

use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class Room{
    protected $id;
    protected $name;
    protected $clients;
    protected $questions;
    protected $category;

    /*
    *Static
    */
    static private $rooms;

    static public function getRoom($id){
        foreach($room as $this->rooms){
            if($room->getId() == $id){
                return $room;
            }
        }
    }

    static public function getNotFullRooms(){
        $notFull = array_filter($this->rooms, function($item){
            if(count($item) < 2){
                return $item;
            }
        });
        return $notFull;
    }

    /*
    *Public
    */
    public function __construct($idUser, $category){
        $this->clients = new \SplObjectStorage;
        $this->id = $idUser;
        $this->category = $category;
    }

    public function __destruct(){
        echo sprintf($this->id . ' room destroyed');
    }




    /**
    *Add Client to the room
    *@return array
    */
    public function joinRoom($client){
        $this->clients->attach($client);
        if(count($this->clients) > 2){
            return $this->clients;
        }else{
            array_push($this->clients, $client);
            return $this->clients;
        }
    }




    /**
    *get clients
    *@param Client
    *@return array
    */
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

    /**
    *set name
    *@param simple
    *@return Room
    */
    public function setName(string $name){
        $this->name = $name;
        return $this;
    }

    /**
    *get name
    *@return string
    */
    public function getName(){
        return $this->name;
    }


    /**
    *set a new array of 5 question
    *return Room
    */
    public function setQuestions(){
        $this->questions = $this->getManager()
                    ->getRepository('AppBundle:Question')
                    ->findByRandom($category);
        return $this;
    }
    /**
    *get question
    */
    public function getQuestions(){
        return $this->questions;
    }

    /**
    *set category
    *@param string
    *@return Room
    */
    public function setCategory(string $category){
        $this->category = $category;
        return $this;
    }

    /**
    *get category
    *@return string
    */
    public function getCategory(){
        return $this->category;
    }

    public function getManager($entityManager){
        return $entityManager();        
    }
}
