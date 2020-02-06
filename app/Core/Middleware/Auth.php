<?php


namespace Middleware;


class Auth
{
    protected $container;
    public function __construct($container)
    {
        $this->container = $container;
        $this->redirect = 'login';
    }

    public function isLogin() {
        if (!$_SESSION['auth']) {
            $this->redirect();
        }
    }

    protected function redirect () {
        header("HTTP/1.1 401 Unauthorized");
        header('Location: http://'.$_SERVER['HTTP_HOST'] .'/'. $this->redirect);
    }
}