<?php

namespace AppBundle\EventListener;

use AppBundle\Interfaces\TokenAuthenticatedController;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpFoundation\Request;

use Doctrine\Common\Util\Debug;

class TokenListener{

    /**
    *@var array
    */
    private $tokens;

    public function __construct($tokens){
        $this->tokens = $tokens;
    }

    public function addToken($token){
        array_push($this->tokens,$token);
        return $this;
    }
    public function deleteToken($token){
        $key = array_search($token, $this->tokens);
        if($key != null){
            unset($key);
            array_values($this->tokens);
        }else{
            return ;
        }
    }

    public function OnKernelController(FilterControllerEvent $event){
        $controller = $event->getController();
        $request = Request::createFromGlobals();

        /*
         * $controller passed can be either a class or a Closure.
         * If it is a class, it comes in array format
         */
        if (!is_array($controller)) {
            return;
        }

        if ($controller[0] instanceof TokenAuthenticatedController) {
            $token = $request->headers->get('authorization');

            if (!in_array($token, $this->tokens)) {
                throw new AccessDeniedHttpException('This action needs a valid token!');
            }
            throw new AccessDeniedHttpException('bijour');
            
            $event->getRequest()->attributes->set('auth_token', $token);
        }
        
    }


    public function onKernelResponse(FilterResponseEvent $event)
    {
        // check to see if onKernelController marked this as a token "auth'ed" request
        if (!$token = $event->getRequest()->attributes->get('auth_token')) {
            return;
        }

        $response = $event->getResponse();

        // create a hash and set it as a response header
        $hash = sha1($response->getContent().$token);
        $response->headers->set('X-CONTENT-HASH', $hash);
    }

}