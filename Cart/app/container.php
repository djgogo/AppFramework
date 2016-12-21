<?php

use Cart\Basket\Basket;
use Interop\Container\ContainerInterface;
use Slim\Views\Twig;
use Cart\Models\Product;
use Slim\Views\TwigExtension;
use function Di\get;
use Cart\Support\Storage\Contracts\StorageInterface;
use Cart\Support\Storage\Session;

return array(

    'router' => get(Slim\Router::class),

    StorageInterface::class => function (ContainerInterface $c) {
        return new Session('cart');
    },

    Twig::class => function (ContainerInterface $c) {

        $twig = new Twig(__DIR__ . '/../resources/views', array(
            'cache' => false
        ));

        $twig->addExtension(new TwigExtension(
            $c->get('router'),
            $c->get('request')->getURi()
        ));

        return $twig;
    },

    Product::class => function (ContainerInterface $c) {
        return new Product;
    },

    Basket::class => function (ContainerInterface $c) {
        return new Basket(
            $c->get(Session::class),
            $c->get(Product::class)
        );
    }

);
