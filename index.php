<?php

require "vendor/autoload.php";
require 'cfg.php';

use Home\Twitter;

ini_set('memory_limit', '200M');
ini_set('display_errors', 'On');

$app = new \Slim\Slim();
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('src/views');
$twig = new Twig_Environment($loader);


$app->get('/', function () use ($twig) {
    $template = $twig->loadTemplate('home.php');
    echo $template->render([]);
});

$app->post('/result', function () use ($twig, $app) {
    $login = $app->request->post('login');
    $size = $app->request->post('size');
    $go_back = $_SERVER['HTTP_REFERER'];
    if (in_array($size, [null, '']) || $size < 1) {
        $size = DEFAULT_SIZE;
    }
    try {
        $template = $twig->loadTemplate('result.php');
        $info = new Twitter($login);
        $empty = (count($info->getUsersFeed()) == 0);
        $data = $info->getUsersFeed();
        if (!$empty) {
            shuffle($data);
        }
        echo $template->render([
            'info' => $data,
            'size' => $size,
            'empty' => $empty,
            'go_back' => $go_back
        ]);
    } catch (SSX\EpiTwitterException $e) {
        $template = $twig->loadTemplate('error.php');
        echo $template->render(['error_code' => $e->getCode(), 'go_back' => $go_back]);
    }
});
$app->run();
