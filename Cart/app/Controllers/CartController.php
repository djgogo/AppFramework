<?php
declare(strict_types = 1);

namespace Cart\Controllers {

    use Cart\Models\Product;
    use Slim\Views\Twig;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    class CartController
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

        public function execute(Request $request, Response $response, Twig $view)
        {
            return $view->render($response, 'cart/index.twig');
        }

        public function add()
        {

        }
    }
}
