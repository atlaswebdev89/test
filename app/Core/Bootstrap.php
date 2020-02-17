<?php

namespace Core;

class Bootstrap {
    static public function registerFabrica () {
        //DI Dependency Injection 
        $container = new \Pimple\Container();        
                //Данные для подключения к базе данных
                $container['db'] = [
                            'host' =>       HOST,
                            'dbname' =>     DBNAME,
                            'user' =>       USER,
                            'password' =>   PASSWORD    
                ];
                //Корень приложения
                $container['document_root'] = $_SERVER['DOCUMENT_ROOT'];              

                //Класс проверки url языка
                $container['language'] = function ($container){
                            return new \Library\Language($container);
                };
                //Класс для работы cессий
                $container['session'] = function ($container){
                            return new \Library\Session($container);
                };
                //Класс посредник
                $container['middle'] = function ($container) {
                            return new \Middleware\Middleware($container);
                };
                //Класс  для проверки авторизации пользователя
                $container['auth'] = function ($container){
                            return new \Middleware\Auth($container);
                };
                //класс для работы с пользователями
                $container['user'] = function ($container) {
                            return new \Library\Users($container);
                };
                //Register dataBase connection (PDO) Singleton
                $container['pdo'] = function ($container) {
                        $connect = ConnectDB::getInstance($container ['db']);
                    return $connect->getConnect();
                };
                //Driver DB
                $container ['driver'] = function ($container) {
                    return new DriverDB($container['pdo']);
                };
                //Model MVC
                $container ['model'] = function ($container) {
                    return new \Model\Model($container['driver']);
                };
                //view TWIG шаблонизатор
                $container ['view'] = function ($container) { 
                    $loader = new \Twig\Loader\FilesystemLoader(PATH_TEMPLATES);
                    return new \Twig\Environment($loader);
                };                       
        return $container;
    }
}
