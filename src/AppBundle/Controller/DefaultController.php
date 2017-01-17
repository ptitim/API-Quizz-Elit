<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\User;
use AppBundle\Entity\Question;
use AppBundle\Entity\Reponse;
use AppBundle\Entity\UserInformation;
use AppBundle\Entity\OtherUser;

use AppBundle\Model\JsonConverter;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        // return $this->render('default/index.html.twig', [
        //     'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        // ]);
        // return new Response('<img src="http://www.peoplefirstinfo.org.uk/media/1137057/homepage.jpg" style="width:100vw; height:100vh;"></img>');
        return new Response('<p>hello etienne</p>');
    }

    /**
    *@Route("/testJson")
    */
    public function testJson(){
        $user = $this->getDoctrine()
                    ->getRepository('AppBundle:UserInformation')
                    ->find(1);
        
        $temp = $this->getDoctrine()
                    ->getRepository('AppBundle:Question')
                    ->findAll(1);

        // $question = array_map(function($e){
        //     $em = $this->getDoctrine()
        //             ->getRepository('AppBundle:Reponse')
        //             ->findByCatReponse($e->getCatReponse() );
        //     $falsies = array();

        //     for($i = 0; $i < 3; $i++){

        //         $index = random_int(0, count($em)-1);
        //         while($em[$index]->getReponse() == $e->getReponse()){
        //             $index = random_int(0, count($em)-1);
        //         }
        //         array_push($falsies, $em[$index]->getReponse());
        //     }
        //     return array("body" => $e->getBody() , "answer" => $e->getReponse(), "falsies" => $falsies);
        // }, $temp);

        $question = array(
            array("question" => "sa va?", "answer" => "oui", "falsies" => array("non","bien, bien", "hi")),
            array("question" => "tagada?", "answer" => "nope", "falsies" => array("test", "tres", "hiou"))
        );
        $categories = array();
        $data = new JsonConverter();
        $data->addUser($user);
        $data->setCategories($categories);
        $data->setQuestions($question);
        $json = $data->toJson();
        return new Response($json);
    }

    /**
    *@Route("/users/add")
    *@Method({"POST"})
    */
    public function addUser(){

        $rawData = file_get_contents("php://input");
        $data = json_decode($rawData);

        return new Response("");       
    }

    /**
    *@Route("/users/add")
    *@Method({"OPTIONS"})
    */
    public function options() {
        return new Response("");
    }

    /**
    *@Route("/users/{id}/update")
    *@Method("POST")
    */
    public function AddUserInformation($id){

        $em = $this->getDoctrine()->getManager();
        $em->persist($userInf);
        $em->flush();

        return new Response('<p>New Information added:' .$userInf->getUsername() .'</p>');
    }

    /**
    *@Route("/game/{category}")
    *
    */
    public function sendQuestions($category){
        $questions = $this->getDoctrine()
                ->getRepository('AppBundle:Question')
                ->createQuery('question')
                ->where('question.cat_question == '.category)
                ->getQuery();
        return new Response('en attente');
    }

}
