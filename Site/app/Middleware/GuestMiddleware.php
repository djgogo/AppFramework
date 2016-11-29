<?php

namespace Site\Middleware;

use Slim\Http\Request;
use Slim\Http\Response;

class GuestMiddleware extends Middleware
{
    public function __invoke(Request $request, Response $response, $next)
    {
        if ($this->container->auth->check()) {
            $this->container->flash->addMessage('info', 'You are already signed in.');
            return $response->withRedirect($this->container->router->pathFor('home'));
        }

        $response = $next($request, $response);
        return $response;
    }
}
