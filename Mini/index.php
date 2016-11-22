<?php
require __DIR__ . '/app/autoload.php';

$app = new App\App;

$container = $app->getContainer();

$container['errorHandler'] = function () {
  die('404 Error - Not Found');
};

$container['config'] = function () {
    return [
        'db_driver' => 'mysql',
        'db_host' => 'localhost',
        'db_name' => 'suxx',
        'db_user' => 'root',
        'db_pass' => '1234',
    ];
};

$container['db'] = function ($c) {
    return new PDO(
        $c->config['db_driver'] . ':host=' . $c->config['db_host'] . ';dbname=' . $c->config['db_name'],
        $c->config['db_user'],
        $c->config['db_pass']
    );
};

$app->get('/', function() {
    echo 'Home';
});

$app->map('/users', function() {
    echo 'Users';
}, ['GET', 'POST']);

$app->post('/signup', function() {
    echo 'Sign up';
});

$app->run();

