<?php

namespace SiteDI\Middleware;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Views\Twig;

class CsrfViewMiddleware extends Middleware
{
    public function __invoke(Request $request, Response $response, callable $next)
    {
        $this->container->get(Twig::class)->getEnvironment()->addGlobal('csrf', [
            'field' => '
                <input type="hidden" name="' . $this->container->csrf->getTokenNameKey() . '" value="' . $this->container->csrf->getTokenName() . '">
                <input type="hidden" name="' . $this->container->csrf->getTokenValueKey() . '" value="' . $this->container->csrf->getTokenValue() . '">
            ',
        ]);

        $response = $next($request, $response);
        return $response;
    }
}
