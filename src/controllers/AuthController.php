<?php

namespace src\controllers;

use src\lib\Page;
use src\lib\http\Request;
use src\lib\http\Session;
use src\lib\http\Message;
use src\lib\Utils;
use src\models\User;

class AuthController
{
    /**
     * @return void
     */
    public function logIn(): void
    {
        if (Session::hasUser()) {
            Request::redirectTo('home');
        }

        $message = Session::getMessage();
        $bag = Session::getBag();

        Page::view('Log in', 'auth/login', compact('message', 'bag'));
    }

    /**
     * @return void
     */
    public function doLogIn(): void
    {
        $fields = Request::getBody('email', 'password');

        if (Utils::hasEmpty($fields)) {
            Request::redirectTo('auth/login', Message::emptyFields(), $fields);
        }

        $user = User::findBy('u.email', $fields['email'], false);

        if (!$user || !$user->checkPassword($fields['password'])) {
            Request::redirectTo('auth/login', Message::invalidCredentials(), $fields);
        }

        Session::setUser($user);
        Request::redirectTo('home');
    }

    /**
     * @return void
     */
    public function logOut(): void
    {
        Session::setUser(null);
        Request::redirectTo('auth/login');
    }

    public static function checkSession()
    {
        if (!Session::hasUser()) {
            Request::unauthorized();
        }
    }
}
