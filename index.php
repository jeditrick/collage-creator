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
    $size = $_GET['size'];
    if($size == '' || $size == 0){
        $size = 800;
    }
    $template = $twig->loadTemplate('result.php');
    try{
        $info = new Main($login);
        if(count($info->usersFeed)){
            shuffle($info->usersFeed);
            echo $template->render(['info' => $info->usersFeed, 'size' => $size]);
            //var_dump($info->usersFeed,$info->tweetsCount);
        }else{
            echo '<h1>Empty User</h1><br/><a href="/uwc8">Go back</a>';
        }

    }catch (SSX\EpiTwitterException $e){
        if($e->getCode() == 404){
            echo '<h1>There is no info about this user ! Does he exist ????</h1><br/><a href="/uwc8">Go back</a>';
        }elseif($e->getCode() == 429){
            echo '<h1>Rate limit exceeded!!! Please try again later</h1><br/><a href="/uwc8">Go back</a>';
        }
    }

    return $response;
});


$dispatcher = $router->getDispatcher();
$request = Request::createFromGlobals();
$response = $dispatcher->dispatch($request->getMethod(), $request->getPathInfo());
$response->send();