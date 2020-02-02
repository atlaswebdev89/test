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
		$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$routes = explode('/', trim($url_path, '/')); 
                //Если  текущий язык есть в системе удаляем его из массива запроса для 
                //получения правильного контроллера и действия
                if($container['session']->langSession($routes[0])){
                    array_shift($routes);
                }; 
         
        $data = new \Controller\IndexController($container);
        $data->execute();
    }
}
