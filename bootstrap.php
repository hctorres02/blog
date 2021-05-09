<?php

require __DIR__ . 'vendor/autoload.php';

$_ENV = parse_ini_file('.env', true);

require 'routes.php';

date_default_timezone_set($_ENV['app']['timezone']);
session_start();
