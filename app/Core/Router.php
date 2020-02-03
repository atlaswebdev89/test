<?php

namespace Core;
/**
 * Description of Router
 *
 * @author root
 */
class Router {
    
    protected $container;
    protected $root;
    protected $language;
    protected $routes;
    protected $namespace;


    public function __construct($container) {
        $this->container = $container;
        $this->root = $container['document_root'];
        $this->language = $container['language'];
        //Получить массив соответствия запроса и контроллера с действием
        $this->routes = $this->getRoutes();
        $this->namespace = '\\Controller\\';
    }

    public function start () {      
                // контроллер по умолчанию
		$controller_name = 'index';		
		//Получить метод запроса
                $method = $_SERVER['REQUEST_METHOD'];
                //Получить uri запроса в виде массива
		$routes = $this->getUri($_SERVER['REQUEST_URI']);
 
                //Если  текущий язык есть в системе удаляем его из массива запроса для
                //получения правильного контроллера и действия
                if($this->language->langValid($routes)){
                    unset($routes);                    
                };              
                if (!empty($routes) && $routes == $controller_name){
                    header("HTTP/1.1 301 Moved Permanently");
                    header('Location: http://'.$_SERVER['HTTP_HOST']);                    
                }
                //Если массив пуст значит запрос на главную страницу. 
                if (empty($routes)) {
                        $routes = $controller_name;
                }
                               
                if (array_key_exists($routes, $this->routes[$method]))
                {
                    $segments = explode('/', $this->routes[$method][$routes]);
                    $controllerName = array_shift($segments).'Controller';
                    $controllerName = $this->namespace.ucfirst($controllerName);                           
                    $actionName = (array_shift($segments));
                    if (class_exists($controllerName))  {      
                        $data = new $controllerName($this->container);
                        $data->$actionName();  
                    }
                    
                    
                }else {
                    
                    //Исключения для 404 ошибки
                    echo "BAD";
                }                  
    }

    protected function getUri($request){
            $url_path = parse_url($request, PHP_URL_PATH);
            $routes = explode('/', trim($url_path, '/'));               
        return $routes[0];
    }

    protected function getRoutes () {
            $data = require_once $this->root.'/config/routes.php';
        return $data;
    }
}
