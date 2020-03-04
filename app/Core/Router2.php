<?php

namespace Core;

class Router2
{
    protected $container;
    protected $root;
    protected $language;
    protected $routes;
    protected $namespace;
    protected $data;
    protected $lang_alias;
    protected $exc = FALSE;
    // контроллер по умолчанию
    protected $controllerDefaul = 'index';

    public function __construct($container) {
        $this->container = $container;
        $this->root = $container['document_root'];
        $this->language = $container['language'];
        //Получить массив соответствия запроса и контроллера с действием
        $this->routes = $this->getRoutes();
        $this->namespace = '\\Controller\\';
    }

    public function start () {
        //Получить метод запроса
        $method = $_SERVER['REQUEST_METHOD'];
        //Получить uri запроса в виде массива
        $routes = $this->getUri($_SERVER['REQUEST_URI']);
        //Если  текущий язык есть в системе удаляем его из массива запроса для
        //получения правильного контроллера и действия
        $routesArray = explode('/', $routes);
        
        if($this->language->langValid($routesArray[0]))
                {
                    if ($routesArray[0] != DEFAULT_LANG) {
                        $this->lang_alias = array_shift($routesArray);
                        $routes = implode('/', $routesArray);
                    }                  
                }
        //Проверка  наличие дублей (301 редирект)
        $this->doubleUri($routes);
        //проверка uri на пустоту
        $routes = $this->uriEmpty($routes);

        try {
            foreach ($this->routes[$method] as $uriPattern => $path) {
                if (preg_match("~^$uriPattern$~", $routes)) {

                    //Получения контроллера и действия (название функции)
                    $controller_action = $this->getController($path);
                                $controllerName = $controller_action['Controller'];
                                $actionName = $controller_action['Action'];
                    //Присваем переменной значение TRUE, что говорит о том что маршрут найден и исключение 404 не надо
                    $this->exc = TRUE;
                    //Передача управления контроллеру
                    if (class_exists($controllerName)) {
                        //Создает объект контроллера
                        $data = new $controllerName($this->container);
                        if (method_exists($controllerName, $actionName)) {
                            //Метод объекта
                            $data->$actionName();
                            break;
                        } else throw new \Exception('NotAction');
                    } else throw new \Exception('NotController');
                }
            };
            //Если маршрут не найден бросаем исключение 404 not found
            if (!$this->exc) {
                throw new \CustomException\NotFoundException();
            }

        }catch (\CustomException\NotFoundException $e) {
            $controller = new \Controller\ErrorController ($this->container);
            $controller->NotFound();
        }catch (\PDOException $e) {
            echo $e->getMessage();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    protected function getUri($request){
            $url_path = parse_url($request, PHP_URL_PATH);
            $routes = trim($url_path, '/');
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

    protected function getController ($path) {
            $segments = explode('/', $path);
            $controllerName = array_shift($segments) . 'Controller';
            $controllerName = $this->namespace . ucfirst($controllerName);
            $actionName = (array_shift($segments));
        return
                    [
                        'Controller' => $controllerName,
                        'Action'    => $actionName
                    ];
    }

    protected function doubleUri ($routes) {       
        //Если в запросе указан контроллер по умолчанию делаем редирект на главную для борьбы с дублями страниц
        if (preg_match("~$this->controllerDefaul$~", $routes)) {            
            if (!empty($this->lang_alias)){
                return $this->redirect($this->lang_alias);
            }else {  
                return $this->redirect();
            }
        }
    }

    protected function uriEmpty ($routes) {
            //Если маршрут пустой Значит запрос на главную страницу
            if ($routes == '') {
                $routes = $this->controllerDefaul;
            }
        return $routes;
    }
}