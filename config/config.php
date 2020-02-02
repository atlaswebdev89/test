<?php

//Данные для подключения к БД
define('HOST', '127.0.0.1');
define('DBNAME', 'test');
define('USER', 'test');
define('PASSWORD', 'coredallas89');

//путь к папке с шаблонами для TWIG шаблонизатора
define('PATH_TEMPLATES', 'public/templates');
//Поддерживаемые языки (алиас)
define ('LANG', 
                [
                            'ru',
                            'en'
                ]
        );

//Язык по умолчанию
define ('DEFAULT_LANG', 'ru');