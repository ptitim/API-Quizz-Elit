<?php

namespace AppBundle\Model;

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
            $password = md5($data->password);
             $user->setPassword($password);
        }
        
            $user->setEmail($mail)
                ->setAccountType($accountType);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        $id = $user->getId();
        
        $information = new UserInformation($id);
            $information->setUsername($data->username);
            isset($imgUrl) ? $information->setImgUrl($imgUrl) : null;
            
    }
}