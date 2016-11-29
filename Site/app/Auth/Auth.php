<?php

namespace Site\Auth;

use Site\Models\User;

class Auth
{
    public function user()
    {
        if (isset($_SESSION['user'])) {
            return User::find($_SESSION['user']);
        }
    }

    public function check() : bool
    {
        return isset($_SESSION['user']);
    }

    public function attempt($email, $password) : bool
    {
        $user = User::where('email', $email)->first();

        if (!$user) {
            return false;
        }

        if (password_verify($password, $user->password)) {
            $_SESSION['user'] = $user->id;
            return true;
        }

        return false;
    }

    public function logout()
    {
        unset($_SESSION['user']);
    }
}
