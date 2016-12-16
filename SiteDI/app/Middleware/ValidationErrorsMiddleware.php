<?php

namespace SiteDI\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class ValidationErrorsMiddleware extends Middleware
{
    public function __invoke(Request $request, Response $response, $next)
    {
        if (isset($_SESSION['errors'])) {
            $this->container->get('view')->getEnvironment()->addGlobal('errors', $_SESSION['errors']);
            unset($_SESSION['errors']);
        }

        $response = $next($request, $response);
        return $response;
    }
}
