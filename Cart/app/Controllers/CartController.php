<?php

namespace Cart\Controllers {

    use Slim\Router;
    use Slim\Views\Twig;
    use Cart\Models\Product;
    use Psr\Http\Message\ResponseInterface as Response;
    use Psr\Http\Message\ServerRequestInterface as Request;

    class CartController
    {
        /**
         * @var Product
         */
        private $product;

        public function __construct(Product $product)
        {
            $this->product = $product;
        }

        public function execute(Request $request, Response $response, Twig $view)
        {
            return $view->render($response, 'cart/index.twig');
        }

        public function add($slug, $quantity, Request $request, Response $response, Router $router)
        {

        }

        public function update($slug, Request $request, Response $response, Router $router)
        {

        }
    }
}
