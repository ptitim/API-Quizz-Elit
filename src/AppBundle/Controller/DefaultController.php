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

        $question = array(
            array("question" => "sa va?", "answer" => "oui", "falsies" => array("non","bien, bien", "hi")),
            array("question" => "tagada?", "answer" => "nope", "falsies" => array("test", "tres", "hiou"))
        );
        $categories = array("film", "test");
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
        $mail = $data->email;

        $em = $this->getDoctrine()
                ->getRepository('AppBundle:User')
                ->findByEmail($mail) ;
        
        if(count($em) == 1){
            $response = new Response($rawData);
            $response->setStatusCode(202);
            return $response;
        }
        
        $user = new User();
        $username = $data->username;
        
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

        return new Response("");       
    }

    /**
    *@Route("/signin")
    */
    public function signinLocal(){
        $rawData = file_get_content("php://input");
        $data = json_decode($rawData);
        $user = $this->getDoctrine()->getRepository('AppBundle:User')->findByMail($data->mail);

        if(count($user) == 0){
            $inf = $this->getDoctrine()->getRepository('AppBundle:UserInformation')->findByMail($data->mail);
            $user = $this->getDoctrine()->getRepository('AppBundle:User')->findById($inf->getIdUser());
            if(count($user) == 1){
                $user->getPassword == $data->password ? $reponse = true : $reponse = false;
                return new Reponse(json_encode(array("status" => 200)));
            }else{
                return new Response(json_encode(array("status" => 403)));
            }
        }else{
            if($user->getPassword() == md5($data->password) ){
                return new Response(json_encode(array("status" => 200)));
            }else{
                return new Response(json_encode(array("status" => 403)));
            }
        }
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
        $json = new JsonConverter();
        $questions = $this->getDoctrine()
                ->getRepository('AppBundle:Question')
                ->findByCatQuestion($category);
        
        array_map(function($item) use($json){
            $em = $this->getDoctrine()
                        ->getRepository('AppBundle:Reponse')
                        ->findByCatReponse($item->getCatReponse());
            $falsies = array();
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

            $json->addQuestion($item, $falsies);
        },$questions);

        return new Response($json->toJson());
    }
}
