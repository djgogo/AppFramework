<?php

use SiteDI\Middleware\AuthMiddleware;
use SiteDI\Middleware\GuestMiddleware;

$app->get('/', ['\SiteDI\Controllers\HomeController', 'execute'])->setName('home');

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
    $this->get('/auth/signup', ['\SiteDI\Controllers\Auth\AuthController:getSignUp'])->setName('auth.signup');
    $this->post('/auth/signup', ['\SiteDI\Controllers\Auth\AuthController:postSignUp']);

    $this->get('/auth/signin', ['\SiteDI\Controllers\Auth\AuthController:getSignIn'])->setName('auth.signin');
    $this->post('/auth/signin', ['\SiteDI\Controllers\Auth\AuthController:postSignIn']);
})->add(new GuestMiddleware($container));

$app->group('', function () {
    $this->get('/auth/signout', ['\SiteDI\Controllers\Auth\AuthController:getSignOut'])->setName('auth.signout');

    $this->get('/auth/password/change', ['\SiteDI\Controllers\Auth\PasswordController:getChangePassword'])->setName('auth.password.change');
    $this->post('/auth/password/change', ['\SiteDI\Controllers\Auth\PasswordController:postChangePassword']);
})->add(new AuthMiddleware($container));
