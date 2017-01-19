<?php

namespace AppBundle\Model;

use AppBundle\Entity\User;
use AppBundle\Entity\UserInformation;

class DoctrineHelper{
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

    static public function addUserInformation(){
            $information = new UserInformation($id);
            $information->setUsername($data->username);
            isset($imgUrl) ? $information->setImgUrl($imgUrl) : null;

            return $information;
    }
}