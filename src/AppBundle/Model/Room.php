<?php

namespace AppBundle\Model;

class Room{
    protected $id;
    protected $name;
    protected $clients;
    protected $questions;

    public function __construct(){

    }

    public function __destruct(){
        echo sprintf($this->id . ' room destroyed');
    }
}
