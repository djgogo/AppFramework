<?php

use Interop\Container\ContainerInterface;
use SiteDI\Auth\Auth;
use SiteDI\Auth\AuthInterface;
use Slim\Views\Twig;
use function Di\get;

return [

    'router' => get(Slim\Router::class),

    /**
     * View - Twig
     */
    Twig::class => function (ContainerInterface $container) {
        $twig = new Twig(__DIR__ . '/../resources/views', [
            'cache' => false
        ]);

        $twig->addExtension(new \Slim\Views\TwigExtension(
            $container->get('router'),
            $container->get('request')->getUri()
        ));

        $twig->getEnvironment()->addGlobal('auth', [
            'check' => $container->get(AuthInterface::class)->check(),
            'user' => $container->get(AuthInterface::class)->user(),
        ]);

        //$twig->getEnvironment()->addGlobal('flash', $container->get('flash'));

        return $twig;
    },

    AuthInterface::class => function (ContainerInterface $container) {
        return new Auth;
    },

//                'flash' => function (ContainerInterface $container) {
//                  return new Messages;
//                },
//
//                'csrf' => function (ContainerInterface $container) {
//                    return new Guard();
//                },
//
//                'validator' => function (ContainerInterface $container) {
//                    return new Validator;
//                },
//
//    /**
//     * DB - Laravel's Eloquent Model on MySql
//     */
//    DatabaseInterface::class => function (ContainerInterface $container) {
//        $capsule = new EloquentDatabase();
//
//        $capsule->addConnection([
//            'driver' => 'mysql',
//            'host' => 'localhost',
//            'database' => 'site',
//            'username' => 'root',
//            'password' => '1234',
//            'charset' => 'utf8',
//            'collation' => 'utf8_unicode_ci',
//            'prefix' => '',
//        ]);
//
//        $capsule->setAsGlobal();
//        $capsule->bootEloquent();
//
//        return $capsule;
//    },
//
//    /**
//     * DB - PDO
//     */
//    DatabaseInterface::class => function (ContainerInterface $container) {
//
//        return new PdoDatabase('mysql:host=localhost;dbname=suxx', 'root', '1234');
//    },

];
