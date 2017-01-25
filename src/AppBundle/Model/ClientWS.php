<?php

namespace AppBundle\Model;

use AppBundle\Controller\DefaultController;


class Client{
    /**
    *@var int
    */
    private $idUser;

    /**
    *@var int
    */
    private $idWS;

    /**
    *@var string
    */
    private $infoUser;


    public function __construct(int $idUser,int $idWS){
        $this->idUser = $idUser;
        $this->idWS = $idWS;
        $doctrine = DefaultController::getDoctino();

        $user = $doctrine->getRepository('AppBundle:UserInformation')->findOneByIdUser($this->$idUser);
        $this->infoUser = array(
                "username" => $user->getUsername(),
                "imgUrl" => $user->getImgUrl(),
                "idUser" => $this->idUser
        );
    }

    /**
    *get $idUser
    *@return int
    */
    public function getIdUser(){
        return $this->idUser;
    }

    /**
    *set $idWS
    *@param int
    *@return Client
    */
    public function setIdWS(int $idWS){
        $this->idWS = $idWS;
        return $this;
    }

    /**
    *get $idWS
    *@return int
    */
    public function getIdWS(){
        return $this->idWS;
    }

    /**
    *get $infoUser
    *@return array
    */
    public function getUserInfo(){
        return $this->userInfo;
    }
}
