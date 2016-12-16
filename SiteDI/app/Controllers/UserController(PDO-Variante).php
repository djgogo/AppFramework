<?php
declare(strict_types = 1);

namespace SiteDI\Controllers
{
    use PDO;
    use Slim\Http\Response;
    use Slim\Http\Request;

    class UserController extends Controller
    {
        public function execute(Request $request, Response $response, array $args)
        {
            $users = $this->c->db->query("SELECT * FROM user")->fetchAll(\PDO::FETCH_ASSOC);

            return $response->withJson($users);
        }

        public function show(Request $request, Response $response, array $args)
        {
            $user = $this->getUserById($args['id']);

            if ($user === null) {
                return $response->withStatus(404);
            }

            return $response->withJson($user);
        }

        public function store($request, $response, $args)
        {
            $statement = $this->c->db->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");

            try {
                $statement->execute([
                    'name' => $request->getParam('name'),
                    'email' => $request->getParam('email'),
                ]);
            } catch (PDOException $e) {
                return $response->withStatus(500);
            }

            return $response->withJson($this->getUserById($this->c->db->lastInsertId()));
        }

        public function update($request, $response, $args)
        {
            $statement = $this->c->db->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");

            try {
                $statement->execute([
                    'name' => $request->getParam('name'),
                    'email' => $request->getParam('email'),
                    'id' => $args['id']
                ]);
            } catch (PDOException $e) {
                return $response->withStatus(500);
            }

            return $response->withJson($this->getUserById($args['id']));
        }

        public function delete($request, $response, $args)
        {
            if ($this->getUserById($args['id']) === null) {
                return $response->withStatus(404);
            }

            $statement = $this->c->db->prepare("DELETE FROM users WHERE id = :id");

            try {
                $statement->execute(['id' => $args['id']]);
            } catch (PDOException $e) {
                return $response->withStatus(500);
            }

            return $response->withStatus(204);
        }

        private function getUserById($id)
        {
            $statement = $this->c->db->prepare("SELECT * FROM user WHERE uid = :uid");
            $statement->execute(['uid' => $id]);

            if ($statement->rowCount() === 0) {
                return null;
            }

            return $statement->fetch(PDO::FETCH_ASSOC);
        }
    }
}
