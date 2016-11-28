<?php
declare(strict_types = 1);

namespace Site\Controllers
{
    class HomeController extends Controller
    {
        public function execute($request, $response, $args)
        {
            return $this->c->view->render($response, 'home.twig');
        }
    }
}
