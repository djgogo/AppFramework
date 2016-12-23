<?php

use function Di\get;
use Cart\Basket\Basket;
use Cart\Models\Product;
use Interop\Container\ContainerInterface;
use Slim\Views\Twig;
use Slim\Views\TwigExtension;
use Cart\Support\Storage\Contracts\StorageInterface;
use Cart\Support\Storage\Session;

return array(
    'router' => get(Slim\Router::class),

    StorageInterface::class => function (ContainerInterface $c) {
        return new Session('cart');
    },

    Twig::class => function (ContainerInterface $c) {
        $twig = new Twig(__DIR__ . '/../resources/views', [
            'cache' => false
        ]);

        $twig->addExtension(new TwigExtension(
            $c->get('router'),
            $c->get('request')->getUri()
        ));

        $twig->getEnvironment()->addGlobal('basket', $c->get(Basket::class));

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
