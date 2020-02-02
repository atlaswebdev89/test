<?php

error_reporting(E_ALL);

//Вывод ошибок
ini_set('display_errors', 1);
//Время жизни сесии в секундах
ini_set('session.gc_maxlifetime', 1440);

//Включение лога ошибок и указания файла для записи. Работает при выключенно внутреннем обработчике Slim
ini_set('log_errors', 'On');
ini_set('error_log', '/var/log/php/php_errors.log');

require_once 'vendor/autoload.php';
require_once 'config/config.php';

session_start(); //Start Session 
//DI Dependency Injection 
$container = \Core\Bootstrap::registerFabrica();
\Core\Router::start($container);




