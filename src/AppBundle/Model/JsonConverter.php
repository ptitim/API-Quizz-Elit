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

    public function addUser($userInformation){
        $temp = array("username" => $userInformation->getUsername(),"socket" => $userInformation->getSocket(),"friendlist"=> array(), "scoreTotal" => $userInformation->getScoreTotal() );
        array_push($this->users, $temp);
        return $this;
    }

    public function resetUsers(){
        $this->users = array();
        return $this;
    }

    public function getUsers(){
        return $this->users;
    }

    public function resetQuestions($questions){
        $this->questions = array();
        return $this;        
    }
    public function addQuestion($question, $falsies){
        $temp = array(
            "body" => $question->getBody(),
            "answer" => $question->getReponse(),
            "falsies" => $falsies
        );
        array_push($this->questions, $temp);
    }

    public function setQuestions($question){
        $this->questions = $question;
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

    public function toJson(){
        $json = json_encode(array(
            "users" => $this->users,
            "questions" => $this->questions,
            "categories" => $this->categories
        ));
        return $json;
    }

    static public function sortCatToJson($data){

        $tmp = array_map(function($item){
            return $item->getName();
        },$data);

        return json_encode(array("list" => $tmp));
    }
}