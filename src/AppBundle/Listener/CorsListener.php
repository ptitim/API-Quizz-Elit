<?php
namespace AppBundle\Listener;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

class CorsListener {
    public function onKernelResponse(FilterResponseEvent $event){
        $responseHeader = $event->getResponse()->headers;
        $responseHeader->set('Access-Control-Allow-Headers', 'origin, content-type, accept');
        $responseHeader->set('Access-Control-Allow-Origin', '*');
        $responseHeader->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, OPTIONS, PATCH');
        $responseHeader->set('Content-Type', 'application/json');
    }
}