<?php
declare(strict_types = 1);

namespace Site\Controllers
{
    use Slim\Http\Request;
    use Slim\Http\Response;

    class HomeController extends Controller
    {
        public function execute(Request $request, Response $response)
        {
            return $this->view->render($response, 'home.twig');
        }
    }
}
