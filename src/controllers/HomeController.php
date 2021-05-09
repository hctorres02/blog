<?php

namespace src\controllers;

use src\lib\Page;
use src\lib\http\Session;
use src\models\Dashboard;

class HomeController
{
    public function index(): void
    {
        $user = Session::getUser();
        $message = Session::getMessage();

        if ($user) {
            $stats = Dashboard::all();
            $data = compact('user', 'message', 'stats');

            Page::view(null, 'admin/home', $data);
        }

        Page::view(null, 'home', compact('user', 'message'));
    }
}
