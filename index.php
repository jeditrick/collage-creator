<?php

require "vendor/autoload.php";
use Symfony\Component\HttpFoundation\Request,
    Symfony\Component\HttpFoundation\Response,
    Home\Main;

ini_set('memory_limit', '200M');
ini_set('display_errors', 'On');
$router = new League\Route\RouteCollection;

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('src/views');
$twig = new Twig_Environment($loader);


$router->get('/', function (Request $request, Response $response) use ($twig) {
    $template = $twig->loadTemplate('home.php');
    echo $template->render([]);
    return $response;
});
$router->get('/result', function (Request $request, Response $response) use ($twig) {
    $login = $_GET['login'];
    $template = $twig->loadTemplate('result.php');
    $info = new Main($login);
    echo $template->render(['info' => $info->usersFeed]);
    return $response;
});


$dispatcher = $router->getDispatcher();
$request = Request::createFromGlobals();
$response = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());
$response->send();