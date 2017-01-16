<?php

namespace AppBundle\Model;


class JsonConverter{

    private $users;
    private $questions;
    private $categories;

    function __construct($users = [], $questions = [], $categories = []){
        $this->users =  $users;
        $this->questions = $questions;
        $this->categories =  $categories;
    }

    public function addUser($user){
        array_push($this->users, $user);
        return $this;
    }

    public function resetUsers(){
        $this->users = array();
        return $this;
    }

    public function getUser(){
        return $this->users;
    }

    public function setQuestions($questions){
        $this->questions = $questions;
        return $this;        
    }
    public function getQuestions(){
        return $this->questions;
    }

    public function setCategories($categories){
        $this->categories = $categories;
        return $this;        
    }
    public function getCategories(){
        return $this->categories;
    }

    public function parser(){

    }
    public function toJson(){
        $json = json_encode(array(
            "users" => $this->users,
            "questions" => $this->questions,
            "categories" => $this->categories
        ));
        return $json;
    }
}