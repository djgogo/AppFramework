<?php
declare(strict_types = 1);

use Respect\Validation\Validator as v;

session_start();
require_once __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true,
        'db' => [
            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => 'site',
            'username' => 'root',
            'password' => '1234',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]
    ],
]);

$container = $app->getContainer();

/**
 * Laravel Eloquent Model Configuration for Database Handling
 */
$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['view'] = function ($container) {
    $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
        'cache' => false,
    ]);

    $view->addExtension(new \Slim\Views\TwigExtension(
        $container->router,
        $container->request->getUri()
    ));

    $view->getEnvironment()->addGlobal('auth', [
        'check' => $container->auth->check(),
        'user' => $container->auth->user(),
    ]);

    $view->getEnvironment()->addGlobal('flash', $container->flash);

    return $view;
};

$container['csrf'] = function ($container) {
    return new \Slim\Csrf\Guard();
};

$container['auth'] = function () {
    return new \Site\Auth\Auth;
};

$container['db'] = function ($container) use ($capsule) {
    return $capsule;
};
//$container['db'] = function () {
//    $db = new PDO('mysql:host=localhost;dbname=suxx', 'root', '1234');
//    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    return $db;
//};

$container['HomeController'] = function ($container) {
    return new \Site\Controllers\HomeController($container);
};

$container['AuthController'] = function ($container) {
    return new \Site\Controllers\Auth\AuthController($container);
};

$container['PasswordController'] = function ($container) {
    return new \Site\Controllers\Auth\PasswordController($container);
};

$container['validator'] = function ($container) {
    return new \Site\Validation\Validator;
};

$container['flash'] = function ($container) {
    return new \Slim\Flash\Messages;
};

/**
 * Middleware
 */
$app->add(new \Site\Middleware\ValidationErrorsMiddleware($container));
$app->add(new \Site\Middleware\OldInputMiddleware($container));
$app->add(new \Site\Middleware\CsrfViewMiddleware($container));
$app->add($container->csrf);

/**
 * Custom Validation Rules
 */
v::with('Site\\Validation\\Rules\\');

require_once __DIR__ . '/../app/routes.php';
