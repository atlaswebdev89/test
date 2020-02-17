<?php


namespace Middleware;


class Middleware
{
        protected $auth;
        protected $redirect = 'login';
        
        public function __construct($container)
        {
            $this->auth = $container['auth'];
            
        }

        public function isUserLogin ($prefix) {
            if ($prefix){
                    $this->redirect = $prefix.'/login';
            }
            
            if (!$this->auth->isLogin()) {
                $this->redirect();
            }
        }

    protected function redirect () {
        header("HTTP/1.1 401 Unauthorized");
        header('Location: http://'.$_SERVER['HTTP_HOST'] .'/'. $this->redirect);
    }
}