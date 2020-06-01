<?php

//Данные для подключения к БД
define('HOST', getenv('HOST'));
define('DBNAME', getenv('DBNAME'));
define('USER', getenv('USER'));
define('PASSWORD', getenv('PASSWORD'));

//Время действия куки для авторизации при отсутствии сессии
define('TIMEOUT_USER_HASH', 50000);

//путь к папке с шаблонами для TWIG шаблонизатора
define('PATH_TEMPLATES', $_SERVER['DOCUMENT_ROOT'].'/public/templates');
//Поддерживаемые языки (алиас)
define ('LANG', ['en', 'ru']);
//Язык по умолчанию
define ('DEFAULT_LANG', 'ru');
