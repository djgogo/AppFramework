<?php
declare(strict_types = 1);

namespace App {

    use App\Exceptions\RouteNotFoundException;

    class App
    {
        /**
         * @var Container
         */
        protected $container;

        public function __construct()
        {
            $this->container = new Container([
                'router' => function() {
                return new Router();
                }
            ]);
        }

        public function getContainer() : Container
        {
            return $this->container;
        }

        public function get($uri, $handler)
        {
            $this->container->router->addRoute($uri, $handler, ['GET']);
        }

        public function post($uri, $handler)
        {
            $this->container->router->addRoute($uri, $handler, ['POST']);
        }

        public function map($uri, $handler, array $methods = ['GET'])
        {
            $this->container->router->addRoute($uri, $handler, $methods);
        }

        public function run()
        {
            $router = $this->container->router;
            $router->setPath($_SERVER['REQUEST_URI'] ?? '/');

            try {
                $response = $router->getResponse();
            } catch (RouteNotFoundException $e) {
                if ($this->container->has('errorHandler')) {
                    $response = $this->container->errorHandler;
                } else {
                    return;
                }
            }

            return $this->process($response);
        }

        protected function process($callable)
        {
            return $callable();
        }
    }
}
