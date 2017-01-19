<?php

use Symfony\Component\HttpFoundation\Request;

    header("Access-Control-Allow-Origin: *");

    header("Access-Control-Allow-Credentials: true");

    header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");

    header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS, PUT');

    header("Content-Type: application/json");
    
/** @var \Composer\Autoload\ClassLoader $loader */
$loader = require __DIR__.'/../app/autoload.php';
// include_once __DIR__.'/../var/bootstrap.php.cache';

$kernel = new AppKernel("prod", true);
// $kernel->loadClassCache();
//$kernel = new AppCache($kernel);

// When using the HttpCache, you need to call the method in your front controller instead of relying on the configuration parameter
//Request::enableHttpMethodParameterOverride();
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);

/*
*ajoutez cors listener
*ecoutez l'evenement requestMethod options
*renvoyer Response
*/