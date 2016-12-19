<?php
declare(strict_types = 1);

namespace Cart\Controllers
{

    use Cart\Models\Product;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;
    use Slim\Router;
    use Slim\Views\Twig;

    class ProductController
    {
        /**
         * @var Twig
         */
        private $view;

        /**
         * @var Product
         */
        private $product;

        /**
         * @var Router
         */
        private $router;

        public function __construct(Router $router, Twig $view, Product $product)
        {
            $this->view = $view;
            $this->product = $product;
            $this->router = $router;
        }

        public function get(Request $request, Response $response,string $slug)
        {
            $product = $this->product->where('slug', $slug)->first();

            if (!$product) {
                return $response->withRedirect($this->router->pathFor('home'));
            }

            return $this->view->render($response, 'products\product.twig', [
                'product' => $product,
            ]);
        }
    }
}
