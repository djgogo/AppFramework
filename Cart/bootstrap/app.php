<?php

use Cart\App;
use Illuminate\Database\Capsule\Manager as Capsule;

session_start();
require_once __DIR__ . '/../vendor/autoload.php';

$app = new App;

$capsule = new Capsule;
$capsule->addConnection([
    'driver' => 'mysql',
    'host' => 'localhost',
    'database' => 'Cart',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

require __DIR__ . '/../app/routes.php';
