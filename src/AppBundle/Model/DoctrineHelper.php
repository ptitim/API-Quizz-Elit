<?php

namespace AppBundle\Model;

use AppBundle\Entity\User;
use AppBundle\Entity\UserInformation;
use AppBundle\Model\JsonConverter;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DoctrineHelper extends Controller{
    static public function addUser($data){
        $user = new User();
        $username = $data->username;
        $mail = $data->email;

        if($data->google){
            $imgUrl = $data->imageUrl;
            $idUser = $data->id;
            $accountType= "google";
            $user->setIdExt($idUser);
        }else{
            $accountType = "local";
            $password = $data->password;
            $user->setPassword($password);
        }
        
            $user->setEmail($mail)
                ->setAccountType($accountType);

        $id = $user->getId();
        

        return $user;
    }

    static public function addUserInformation($data, $id){
        $information = new UserInformation($id);
        $information->setUsername($data->username);
        $information->setScoreTotal(0);
        isset($imgUrl) ? $information->setImgUrl($imgUrl) : $information->setImgUrl("http://maxlab.fr/wp-content/uploads/2014/05/png-293x300.png");

        return $information;
    }

    static public function changeUserInformation($data, $userInformation){
        isset($data->username) ? $userInformation->setUsername($data->username) : null;
        isset($data->imagegUrl) ? $userInformation->setImgUrl($data->imageUrl) : null;
        isset($data->scoreTotal) ? $userInformation->setScoreTotal($data->scoreTotal) : null;
    }

}