<?php

namespace AppBundle\Model;

class Room{
    protected $id;
    protected $name;
    protected $clients;
    protected $questions;

    public function __construct(){

    }

    public function joinRoom($client){
        if(count($this->clients) > 1){
            return ;
        }
    }

    public function __destruct(){
        echo sprintf($this->id . ' room destroyed');
    }
}
