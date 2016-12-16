<?php
declare(strict_types = 1);

use SiteDI\App;
use DI\ContainerBuilder;
use Respect\Validation\Validator;

session_start();
require_once __DIR__ . '/../vendor/autoload.php';

$app = new App;

$container = ContainerBuilder::buildDevContainer();

/**
 * Middleware (ValidationErrors, Repopulating Fields and CSRF Protection)
 */
$app->add(new \SiteDI\Middleware\ValidationErrorsMiddleware($container));
$app->add(new \SiteDI\Middleware\OldInputMiddleware($container));
$app->add(new \SiteDI\Middleware\CsrfViewMiddleware($container));

/**
 * Custom Validation Rules
 */
Validator::with('SiteDI\\Validation\\Rules\\');

require __DIR__ . '/../app/routes.php';
