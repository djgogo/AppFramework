<?php

$app->get('/', ['Cart\Controllers\HomeController', 'execute'])->setName('home');

$app->get('/products/{slug}', ['Cart\Controllers\ProductController', 'get'])->setName('product.get');

$app->get('/cart', ['Cart\Controllers\CartController', 'execute'])->setName('cart.index');
$app->get('/cart/add/{slug}/{quantity}', ['Cart\Controllers\CartController', 'add'])->setName('cart.add');
$app->post('/cart/update/{slug}', ['Cart\Controllers\CartController', 'update'])->setName('cart.update');
