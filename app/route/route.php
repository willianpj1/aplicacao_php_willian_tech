<?php

use app\controller\Home;
use app\controller\User;
use app\controller\Cliente;


$app->get('/', Home::class . ':home');

$app->get('/home', Home::class . ':home');

use Slim\Routing\RouteCollectorProxy;

$app->group('/usuario', function (RouteCollectorProxy $group) {

    $group->get('/lista', User::class . ':lista');
    $group->get('/cadastro', User::class . ':cadastro');
});

$app->group('/cliente', function (RouteCollectorProxy $group) {

    $group->get('/lista', Cliente::class . ':lista');
    $group->get('/cadastro', Cliente::class . ':cadastro');
});