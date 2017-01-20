<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use Doctrine\Common\Util\Debug;

use AppBundle\Entity\Question;
use AppBundle\Entity\Reponse;
use AppBundle\Entity\CatQuestion;
use AppBundle\Entity\CatReponse;

use AppBundle\Model\JsonConverter;

class BackOffice extends Controller{
    /**
    *@Route("/get/{category}")
    */
    public function sortCatReponse($category){
        if($category == "CatReponse" OR $category == "CatQuestion"){

            $em = $this->getDoctrine()
                        ->getRepository('AppBundle:'.$category)
                        ->findAll();
            return new Response(JsonConverter::sortCatToJson($em));
        }else{
            $response = new Response();
            $response->setStatusCode(400);
            return $response;
        }
    }

    /**
    *@Route("/add/{category}")
    *Method("POST")
    */
    public function addCat($category){
        $rawData = file_get_contents("php://input");
        $data = json_decode($rawData);

        if($category == "CatQuestion"){
            $em = $this->getDoctrine()->getRepository('AppBundle:CatQuestion')->findByName($data->name);
            if($em == null){
                $response = new Response();
                $response->setStatusCode(202);
                return $response;
            }else{
                $question = new CatQuestion();
                $question->setName($data->name);
                return new Response("");
            }
        }else if($category == "CatReponse"){
            $em = $this->getDoctrine()->getRepository('AppBundle:CatReponse')->findByName($data->name);
            if($em == null){
                
                $response = new Response();
                $response->setStatusCode(202);
                return $response;
            }else{
                $question = new CatQuestion();
                $question->setName($data->name);
                return new Response("");
            }
        }
        else{
            $response = new Response();
            $response->setStatusCode(400);
            return $response;
        }
    }
}

