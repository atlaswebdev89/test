# Регистрация и авторизация пользователей
<hr>

## Описание:
Форма входа/регистрации нового пользователя, написанная с помощью PHP, MySQL, Javascript.
<hr>

## Используемые инструменты и технологии:
PHP, MVC, ООП, Mysql, Js, Jquery, Twig, Pimple, GIT, Composer, PhpStorm 
<hr>

## Установка: 
Для установки нужен веб сервер Apache (mod_php, mod_rewrite) и mysql server

1. Создать виртуальный хост на apache
1. Скачать репозитарий с git или клонировать удаленный репозитарий

  ```git clone https://github.com/doroshuk89/test.git```

2. Выставить права доступа на папку /uploads. Находиться папка в **/public/templates/**
Для Linux: 
  ```
  //Linux Bash
  sudo chmod -R 777 uploads/
  ```

3. Создать базу данных mysql 
4. Создать пользователя и назначить права к созданной базе
5. Импортировать файл из папке **/MysqlDataBase** в БД  
4. В файле **/config/config.php** настроить подключение к созданной базе данных (указать название базы, пользователя и пароль)
Пример файла *config.php*

```php
//Данные для подключения к БД
define('HOST', '127.0.0.1');
define('DBNAME', 'test');
define('USER', 'test');
define('PASSWORD', '**********');

//Время действия куки для авторизации при отсутствии сессии
define('TIMEOUT_USER_HASH', 50000);

//путь к папке с шаблонами для TWIG шаблонизатора
define('PATH_TEMPLATES', $_SERVER['DOCUMENT_ROOT'].'/public/templates');
//Поддерживаемые языки (алиас)
define ('LANG', ['en', 'ru']);
//Язык по умолчанию
define ('DEFAULT_LANG', 'ru');
```



