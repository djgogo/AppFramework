<?php

$app->get('/', ['Cart\Controllers\HomeController', 'execute'])->setName('home');
$app->get('/products/{slug}', ['Cart\Controllers\ProductController', 'get'])->setName('product.get');
