<?php
declare(strict_types = 1);

namespace App {

    use App\Exceptions\MethodNotAllowedException;
    use App\Exceptions\RouteNotFoundException;

    class Router
    {
        /**
         * @var array
         */
        protected $routes = [];

        /**
         * @var string
         */
        private $path;

        /**
         * @var array
         */
        protected $methods = [];

        public function setPath($path = '/')
        {
            $this->path = $path;
        }

        public function addRoute($uri, $handler, array $methods = ['GET'])
        {
            $this->routes[$uri] = $handler;
            $this->methods[$uri] = $methods;
        }

        public function getResponse()
        {
            if (!isset($this->routes[$this->path])) {
                throw new RouteNotFoundException('No route registered for ' . $this->path);
            }

            if (!in_array($_SERVER['REQUEST_METHOD'], $this->methods[$this->path])) {
                throw new MethodNotAllowedException();
            }

            return $this->routes[$this->path];
        }
    }
}
