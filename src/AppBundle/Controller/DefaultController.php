<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use AppBundle\Entity\User;
use AppBundle\Entity\Question;
use AppBundle\Entity\Reponse;

use AppBundle\Model\JsonConverter;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
    *@Route("/testJson")
    */
    public function testJson(){
        $user = array(
            "pseudo"=> "timtim",
            "classement"=> 1244,
            "socket" => 123
        );
        
        $question = array(
            array("question" => "sa va?", "answer" => "oui", "falsies" => array("non","bien, bien", "hi")),
            array("question" => "tagada?", "answer" => "nope", "falsies" => array("test", "tres", "hiou"))
        );
        $categories = array("film", "test", "café");
        $data = new JsonConverter();
        $data->addUser($user);
        $data->setCategories($categories);
        $data->setQuestions($question);
        $json = $data->toJson();
        return new Response($json);
    }
}
