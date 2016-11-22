<?php
declare(strict_types = 1);

namespace App\Controllers {

    use App\Response;

    class HomeController
    {
        /**
         * @var \PDO
         */
        private $db;

        public function __construct(\PDO $db)
        {
            $this->db = $db;
        }

        public function execute()
        {
            echo 'Home';
        }

        public function home(Response $response)
        {
            return $response->setBody('Home');
        }
    }
}
