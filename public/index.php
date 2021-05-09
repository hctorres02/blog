<?php

use hctorres02\router\Router;
use src\lib\http\Request;

try {
    require __DIR__ . '/../vendor/autoload.php';
    require __DIR__ . '/../routes.php';

    $_ENV = parse_ini_file(__DIR__ . '/../.env', true);
    $method = Request::getMethod();
    $path = Request::getPath();

    date_default_timezone_set($_ENV['app']['timezone']);
    session_start();

    Router::run($method, $path);
} catch (PDOException $e) {
    echo '<pre>';
    die($e->getMessage());
} catch (Exception $e) {
    echo '<pre>';
    die($e->getMessage());
}
