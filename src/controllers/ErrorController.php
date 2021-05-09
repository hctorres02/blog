<?php

namespace src\controllers;

use src\lib\Page;
use src\lib\http\Session;

class ErrorController
{
    /**
     * @return void
     */
    public function unauthorized(): void
    {
        $user = Session::getUser();
        $message = Session::getMessage();
        $data = compact('user', 'message');

        http_response_code(401);
        Page::view('Unauthorized', 'error/401', $data, true);
    }

    /**
     * @param string $path
     * @return void
     */
    public function notFound($path = null): void
    {
        $user = Session::getUser();
        $message = Session::getMessage();
        $data = compact('user', 'message', 'path');

        http_response_code(404);
        Page::view('Not found', 'error/404', $data, true);
    }

    /**
     * @return void
     */
    public function notAllowed(): void
    {
        $user = Session::getUser();
        $message = Session::getMessage();
        $data = compact('user', 'message');

        http_response_code(405);
        Page::view('Not allowed', 'error/405', $data, true);
    }
}
