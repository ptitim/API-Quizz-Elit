<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use Doctrine\Common\Util\Debug;

use AppBundle\EventListener\TokenListener;
use AppBundle\Entity\User;
use AppBundle\Entity\Question;
use AppBundle\Entity\Reponse;
use AppBundle\Entity\UserInformation;
use AppBundle\Entity\OtherUser;

use AppBundle\Model\JsonConverter;
use AppBundle\Model\DoctrineHelper;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $test = new TokenListener(array("123"));
        return new Response('<p>hello etienne</p>');
    }

    /**
    *@Route("/users/signup")
    *@Method({"POST"})
    */
    public function addUser(){

        $rawData = file_get_contents("php://input");
        $data = json_decode($rawData);
        $mail = $data->email;

        $em = $this->getDoctrine()
                ->getRepository('AppBundle:User')
                ->findOneByEmail($mail) ;
        
        if(count($em) == 1){
            $response = new Response(json_encode(array("id" => $em->getId())));
            $response->setStatusCode(202);
            return $response;
        }
        
        $user = DoctrineHelper::addUser($data);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $id = $user->getId();
        $info = DoctrineHelper::addUserInformation($data, $id);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($info);
        $em->flush();
        return new Response(json_encode(array("id" => $id)));       
    }

    /**
    *@Route("/users/signin")
    */
    public function signinLocal(){
        $rawData = file_get_contents("php://input");
        $data = json_decode($rawData);
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->findOneByEmail($data->email);
        
        if($user == null){
                $response = new Response();
                $response->setStatusCode(403);
                return $response;
        }else{

            if($user->getPassword() == md5($data->password) ){
                $response = new Response(json_encode(array('id' => $user->getId())));
                $response->setStatusCode(200);
                return $response;
            }else{
                $response = new Response();
                $response->setStatusCode(403);
                return $response;
            }
        }
    }

    private function setUserInformation($info){


    }


    /**
    *@Route("/users/{id}/update")
    *@Method("PUT")
    */
    public function AddUserInformation($id){
        $rawData = file_get_contents("php://input");
        $data = json_decode($data);



        return new Response("");
    }

    /**
    *@Route("/users/{id}")
    *
    */
    public function getUserInformation($id){
        $data = $this->getDoctrine()->getRepository('AppBundle:UserInformation')->findOneByIdUser($id);
        if($data == null){
            $response = new Response();
            $response->setStatusCode(400);
            return $response;
        }else{
            $json = new JsonConverter();
            $json->addUser($data);
            return new Response($json->toJson());
        }
    }

    /**
    *@Route("/game/{category}")
    *
    */
    public function sendQuestions($category){

        $tmp = $this->getDoctrine()->getRepository('AppBundle:Question')->findByRandom($category);
        dump($tmp);
        return new Response('$tmp');
    }

    /**
    *@Route("/tg")
    */
    public function getListCat(){
        $rep = $this->getDoctrine()->getRepository('AppBundle:CatQuestion')->findAll();
        
        $tmp = array_map(function($item){
            return $item->getName();
        }, $rep);

        return new Response(json_encode($tmp));
    }
}
