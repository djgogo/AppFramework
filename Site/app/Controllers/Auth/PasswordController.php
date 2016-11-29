<?php

namespace Site\Controllers\Auth;

use Site\Models\User;
use Site\Controllers\Controller;
use Respect\Validation\Validator as v;
use Slim\Http\Request;
use Slim\Http\Response;

class PasswordController extends Controller
{
    public function getChangePassword(Request $request, Response $response)
    {
        return $this->view->render($response, 'auth/password/change.twig');
    }

    public function postChangePassword(Request $request, Response $response)
    {
        $validation = $this->validator->validate($request, [
            'password_old' => v::noWhitespace()->notEmpty()->matchesPassword($this->auth->user()->password),
            'password' => v::noWhitespace()->notEmpty(),
        ]);

        if ($validation->failed()) {
            return $response->withRedirect($this->router->pathFor('auth.password.change'));
        }

        $this->auth->user()->setPassword($request->getParam('password'));

        $this->flash->addMessage('info', 'Your password was changed.');
        return $response->withRedirect($this->router->pathFor('home'));
    }
}
