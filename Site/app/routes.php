<?php

use Site\Controllers\HomeController;
use Site\Controllers\UserController;

$app->get('/', HomeController::class . ':execute');

$app->group('/users', function () {
    $this->get('', UserController::class . ':execute');
    $this->get('/{id}', UserController::class . ':show');
    $this->post('', UserController::class . ':store');
    $this->map(['PUT', 'PATCH'], '/{id}', UserController::class . ':update');
    $this->delete('/{id}', UserController::class . ':delete');
});
