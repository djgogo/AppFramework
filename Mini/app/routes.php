<?php

$app->get('/', [new App\Controllers\HomeController, 'execute']);
$app->get('/home', [new App\Controllers\HomeController($container->db), 'home']);
$app->get('/users', [new App\Controllers\UserController($container->db), 'execute']);
$app->post('/test', [\App\Controllers\TestController::class, 'execute']);
$app->map('/test', [\App\Controllers\TestController::class, 'execute'], ['GET', 'POST']);

