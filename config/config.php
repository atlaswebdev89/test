<?php

//Данные для подключения к БД
define('HOST', '127.0.0.1');
define('DBNAME', 'test');
define('USER', 'test');
define('PASSWORD', 'coredallas89');

//Время действия куки для авторизации при отсутствии сессии
define('TIMEOUT_USER_HASH', 50000);

//путь к папке с шаблонами для TWIG шаблонизатора
define('PATH_TEMPLATES', $_SERVER['DOCUMENT_ROOT'].'/public/templates');
//Поддерживаемые языки (алиас)
define ('LANG', ['en']);
//Язык по умолчанию
define ('DEFAULT_LANG', 'ru');