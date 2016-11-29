<?php

use Site\Middleware\AuthMiddleware;
use Site\Middleware\GuestMiddleware;

$app->get('/', 'HomeController:execute')->setName('home');

// PDO-Variante
//$app->group('/users', function () {
//    $this->get('', UserController::class . ':execute');
//    $this->get('/{id}', UserController::class . ':show');
//    $this->post('', UserController::class . ':store');
//    $this->map(['PUT', 'PATCH'], '/{id}', UserController::class . ':update');
//    $this->delete('/{id}', UserController::class . ':delete');
//});


/**
 * Protected Middleware Group - only
 */
$app->group('', function () {
    $this->get('/auth/signup', 'AuthController:getSignUp')->setName('auth.signup');
    $this->post('/auth/signup', 'AuthController:postSignUp');

    $this->get('/auth/signin', 'AuthController:getSignIn')->setName('auth.signin');
    $this->post('/auth/signin', 'AuthController:postSignIn');
})->add(new GuestMiddleware($container));

$app->group('', function () {
    $this->get('/auth/signout', 'AuthController:getSignOut')->setName('auth.signout');

    $this->get('/auth/password/change', 'PasswordController:getChangePassword')->setName('auth.password.change');
    $this->post('/auth/password/change', 'PasswordController:postChangePassword');
})->add(new AuthMiddleware($container));
