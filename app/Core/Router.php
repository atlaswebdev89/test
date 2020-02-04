<?php

namespace Core;

class Router {
    
    protected $container;
    protected $root;
    protected $language;
    protected $routes;
    protected $namespace;
    protected $data;
    protected $lang_alias;

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
                if($this->language->langValid($routes[0])){
                    $this->lang_alias = array_shift($routes);
                };
        try {


                            if (count($routes) <= 1) {
                               if (!empty($routes[0]) && $routes[0] == $controller_name){
                                    if (!empty($this->lang_alias))
                                            {
                                                    $routes[0] = $this->lang_alias;
                                                    return $this->redirect(implode('/', $routes));
                                    }else   {
                                        array_shift($routes);
                                        $this->redirect(implode('/', $routes));
                                    }
                                }
                                //Если массив пуст значит запрос на главную страницу.
                                if (empty($routes[0]))
                                               {
                                                   $routes[0] = $controller_name;
                                               }
                            }else {
                                throw new \CustomException\NotFoundException();
                            }
                                    //Получение контроллера по полученному uri
                                    if (array_key_exists($routes[0], $this->routes[$method])) {
                                        $segments = explode('/', $this->routes[$method][$routes[0]]);
                                        $controllerName = array_shift($segments) . 'Controller';
                                        $controllerName = $this->namespace . ucfirst($controllerName);
                                        $actionName = (array_shift($segments));
                                        if (class_exists($controllerName)) {
                                            //Создает объект контроллера
                                            $data = new $controllerName($this->container);
                                            if (method_exists($controllerName, $actionName)) {
                                                //Метод объекта
                                                $data->$actionName();
                                            } else
                                                throw new \Exception('NotAction');
                                        } else
                                            throw new \Exception('NotController');
                                    } else {
                                        throw new \CustomException\NotFoundException();
                                    }


                }catch (\CustomException\NotFoundException $e) {
                    $controller = new \Controller\ErrorController ($this->container);
                    $controller->NotFound();
                }
                catch (\PDOException $e) {
                    echo $e->getMessage();
                }
                catch (\Exception $e) {
                    echo $e->getMessage();
                }
    }

    protected function getUri($request){
            $url_path = parse_url($request, PHP_URL_PATH);
            $routes = explode('/', trim($url_path, '/'));               
        return $routes;
    }

    protected function getRoutes () {
            $data = require_once $this->root.'/config/routes.php';
        return $data;
    }

    protected function redirect ($uri = null) {
            header("HTTP/1.1 301 Moved Permanently");
            header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.$uri);
    }
}

