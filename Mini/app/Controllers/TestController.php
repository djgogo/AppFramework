<?php
declare(strict_types = 1);

namespace App\Controllers {

    use App\Response;

    class TestController
    {
        public function execute()
        {
            echo 'Test';
        }

        public function home(Response $response)
        {
            return $response->setBody('Test');
        }
    }
}
