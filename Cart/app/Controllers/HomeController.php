<?php

namespace Cart\Controllers {

    use Cart\Models\Product;
    use Slim\Views\Twig;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    class HomeController
    {
        /**
         * @var Request
         */
        protected $request;

        /**
         * @var Response
         */
        protected $response;

        /**
         * @var Twig
         */
        protected $view;

        public function execute(Request $request, Response $response, Twig $view, Product $product)
        {
            $products = $product->all();

            return $view->render($response, 'home.twig', [
                'products' => $products
            ]);
        }
    }
}
