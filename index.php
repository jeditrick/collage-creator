<?php

require "vendor/autoload.php";
require 'cfg.php';

use Home\Main;

ini_set('memory_limit', '200M');
ini_set('display_errors', 'On');

$app = new \Slim\Slim();
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('src/views');
$twig = new Twig_Environment($loader);


$app->get('/', function () use ($twig){
    $template = $twig->loadTemplate('home.php');
    echo $template->render([]);
});

$app->get('/result', function () use ($twig){
    $login = $_GET['login'];

    if(!isset($_GET['size']) || $_GET['size'] == '' || $_GET['size'] == 0){
        $size = 800;
    }else{
        $size = $_GET['size'];
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
});
$app->run();