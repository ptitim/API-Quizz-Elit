<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use Doctrine\Common\Util\Debug;

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
        return new Response('<p>hello etienne</p>');
    }

    /**
    *@Route("/users/add")
    *@Method({"POST"})
    */
    public function addUser(){

        $rawData = file_get_contents("php://input");
        $data = json_decode($rawData);
        $mail = $data->email;

        $em = $this->getDoctrine()
                ->getRepository('AppBundle:User')
                ->findByEmail($mail) ;
        
        if(count($em) == 1){
            $response = new Response($rawData);
            $response->setStatusCode(202);
            return $response;
        }
        
        $user = DoctrineHelper::addUser($data);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $id = $user->getId();
        $info = DoctrineHelper::addUserInformation($data, $id);

        $em->persist($em);
        $em->flush();
        return new Response("");       
    }

    /**
    *@Route("/signin")
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
                $response = new Response();
                $response->setStatusCode(200);
                return $response;
            }else{
                $response = new Response();
                $response->setStatusCode(403);
                return $response;
            }
        }
    }


    /**
    *@Route("/users/{id}/update")
    *@Method("POST")
    */
    public function AddUserInformation($id){
        $rawData = file_get_contents("php://input");
        $data = json_decode($data);

        

        return new Response("");
    }

    /**
    *@Route("/game/{category}")
    *
    */
    public function sendQuestions($category){
        $json = new JsonConverter();
        $questions = $this->getDoctrine()
                ->getRepository('AppBundle:Question')
                ->findByCatQuestion($category);
        
        array_map(function($item) use($json){
            $em = $this->getDoctrine()
                        ->getRepository('AppBundle:Reponse')
                        ->findByCatReponse($item->getCatReponse());
            $falsies = array();
            $n = 0;
            for($i = 0; $i < 3; $i++){
                $index = random_int(0, count($em)-1);

                while($em[$index]->getReponse() == $item->getReponse()){
                    $index = random_int(0, count($em)-1);
                }

                array_push($falsies, $em[$index]->getReponse());
                unset($em[$index]);
                $tmp = array_values($em);
                $em=$tmp;
            }
            //todo renvoyer 5 questions
            $json->addQuestion($item, $falsies);
        },$questions);

        return new Response($json->toJson());
    }
}
