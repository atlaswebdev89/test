<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Core;
/**
 * Description of Router
 *
 * @author root
 */
class Router {
    static function start ($container) {      
        // контроллер и действие по умолчанию
		$controller_name = 'Main';
		$action_name = 'index';

		//Получить метод запроса
        $method = $_SERVER['REQUEST_METHOD'];
        //Получить uri запроса в виде массива
		$routes = self::getUri($_SERVER['REQUEST_URI']);
        //Получить массив соответствия запроса и контроллера с действием
		$dataRoutes = self::getRoutes();

		//Делаем редирект, если выбран язык по умолчанию. В url запроса язык по умолчанию не будет отображаться
		//if ($routes[0] == DEFAULT_LANG) {
         //   $url = str_replace('/'.$routes[0], '', $url_path);
         //           header("HTTP/1.1 301 Moved Permanently");
         //           header('Location: http://'.$_SERVER['HTTP_HOST'].$url);
        //}

                //Если  текущий язык есть в системе удаляем его из массива запроса для
                //получения правильного контроллера и действия
                if($container['language']->langValid($routes[0])){
                    array_shift($routes);
                };
                //Если массив пуст значит запрос на главную страницу. Поэтому добаляем '/' для правильного получение контроллера и действия
                if (empty($routes[0])) {
                        $routes[0] = '/';
                }
        //
        foreach ($dataRoutes[$method] as $uriPattern => $path) {
            //if(preg_match("~$uriPattern~", $routes)) {
            if ($uriPattern == $routes[0]) {
                            $segments = explode('/', $path);
                            $data = new \Controller\IndexController($container);
                            $data->execute();
                            print_r($segments);
                    }
                }


    }

    static protected function getUri($request){
            $url_path = parse_url($request, PHP_URL_PATH);
            $routes = explode('/', trim($url_path, '/'));
                //if (empty($routes[0])) {
                  //  $routes[0] = '/';
                //}
        return $routes;
    }

    static public function getRoutes () {
            $data = require_once $_SERVER['DOCUMENT_ROOT'].'/config/routes.php';
        return $data;
    }
}
