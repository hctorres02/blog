<?php

use HCTorres02\Router\Router;
use src\controllers\AuthController;
use src\controllers\CategoryController;
use src\controllers\ErrorController;
use src\controllers\HomeController;
use src\controllers\PostController;
use src\lib\http\Request;

// HOME
Router::get('(/|/home)', HomeController::class, 'index');

// POSTS
Router::get('/posts', PostController::class, 'index');
Router::get('/posts/([0-9]+)', PostController::class, 'view');

Router::addMiddleware('\\src\\controllers\\AuthController::checkSession', function () {
    Router::mix('/posts/create', PostController::class, ['create', 'doCreate']);
    Router::mix('/posts/edit/([0-9]+)', PostController::class, ['edit', 'doEdit']);
    Router::get('/posts/destroy/([0-9]+)', PostController::class, 'destroy');
});

// CATEGORIES
Router::get('/posts/categories', CategoryController::class, 'index');
Router::get('/posts/categories/([0-9]+)', CategoryController::class, 'view');

// AUTH
Router::mix('/auth/login', AuthController::class, ['logIn', 'doLogIn']);
Router::get('/auth/logout', AuthController::class, 'logOut');

// ERRORS
Router::get('/error/401', ErrorController::class, 'unauthorized');
Router::get('/error/404', ErrorController::class, 'notFound');
Router::get('/error/405', ErrorController::class, 'notAllowed');
Router::pathNotFound(Request::class, 'notFound');
Router::methodNotAllowed(Request::class, 'notAllowed');
