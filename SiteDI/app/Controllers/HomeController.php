<?php
declare(strict_types = 1);

namespace SiteDI\Controllers
{
    use Slim\Views\Twig as View;
    use Psr\Http\Message\ServerRequestInterface as Request;
    use Psr\Http\Message\ResponseInterface as Response;

    class HomeController extends Controller
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
         * @var View
         */
        protected $view;

        public function execute(Request $request, Response $response, View $view)
        {
            return $view->render($response, 'home.twig');
        }
    }
}
