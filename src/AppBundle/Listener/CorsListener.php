<?php

namespace AppBundle\Listener;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;


Class CorsListener{
     public function onKernelRequest(GetResponseEvent $event) {

        $method  = $_SERVER["REQUEST_METHOD"];
        if ('OPTIONS' == $method) {
            $response = new Response();
            $response->setStatusCode(204);
            $event->setResponse($response);
            // $response = new Response();
            // $event->setResponse($response);
        }
     }

     public function onKernelResponse(FilterResponseEvent $event) {
         $method  = $_SERVER["REQUEST_METHOD"];
         if ('OPTIONS' != $method) {
            $response = $event->getResponse();
            // $response->headers->set("Content-Type", "application/json");
            return $response;
        }
     }
}