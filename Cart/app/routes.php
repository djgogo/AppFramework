<?php

$app->get('/', ['Cart\Controllers\HomeController', 'execute'])->setName('home');
