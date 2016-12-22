<?php
declare(strict_types = 1);

namespace Cart\Controllers {

    use Cart\Basket\Basket;
    use Cart\Basket\Exceptions\QuantityExceededException;
    use Cart\Models\Product;
    use Slim\Router;
    use Slim\Views\Twig;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    class CartController
    {
        /**
         * @var Basket
         */
        protected $basket;

        /**
         * @var Product
         */
        protected $product;

        /**
         * @var Twig
         */
        protected $view;

        public function __construct(Basket $basket, Product $product, Twig $view)
        {
            $this->basket = $basket;
            $this->product = $product;
            $this->view = $view;
        }

        public function execute(Request $request, Response $response)
        {
            return $this->view->render($response, 'cart/index.twig');
        }

        public function add($slug, $quantity, Request $request, Response $response, Router $router)
        {
            $product = $this->product->where('slug', $slug)->first();

            if (!$product) {
                return $response->withRedirect($router->pathFor('home'));
            }

            try {
                $this->basket->add($product, $quantity);
            } catch (QuantityExceededException $e) {
                //TODO Set some log or message in the Session
            }

            return $response->withRedirect($router->pathFor('cart.index'));
        }
    }
}
