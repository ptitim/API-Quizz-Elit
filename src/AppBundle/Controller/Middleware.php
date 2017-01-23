<?php

namespace AppBundle\Controller;

use AppBundle\Interfaces\TokenAuthenticatedController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



class Middleware extends Controller implements TokenAuthenticatedController {


    /**
    *@Route("/testToken")
    */
    public function barAction(){

        return new Response('auth');
    }
    
}