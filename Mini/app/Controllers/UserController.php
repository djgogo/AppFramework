<?php
declare(strict_types = 1);

namespace App\Controllers {

    use App\Models\User;
    use App\Response;

    class UserController
    {
        /**
         * @var \PDO
         */
        private $db;

        public function __construct(\PDO $db)
        {
            $this->db = $db;
        }

        public function execute(Response $response)
        {
            $users = $this->db->query('SELECT * FROM user')->fetchAll(\PDO::FETCH_CLASS, User::class);

            return $response->withJson($users);
        }
    }
}
