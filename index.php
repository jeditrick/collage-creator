<?php

require "vendor/autoload.php";
use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Home\Main;

ini_set('memory_limit', '200M');
ini_set('display_errors', 'On');
$router = new League\Route\RouteCollection;


$router->get('/', function (Request $request, Response $response) {
    new Main('byteUA');
    return $response;
});


$dispatcher = $router->getDispatcher();
$request = Request::createFromGlobals();
$response = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());
$response->send();