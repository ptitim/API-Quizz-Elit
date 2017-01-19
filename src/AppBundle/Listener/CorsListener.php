<?php

namespace AppBundle\Listener;

Class CorsListener{
     public function onKernelRequest(GetResponseEvent $event) {

             // Don't do anything if it's not the master request.
        if (!$event->isMasterRequest()) {
            return;
        }
        $request = $event->getRequest();
        $method  = $request->getRealMethod();
        if ('OPTIONS' == $method) {
            $response = new Response();
            $event->setResponse($response);
            return $reponse;
        }
     }

}