<?php


namespace Middleware;


class Auth
{
    protected $container;
    public function __construct($container)
    {
        $this->container = $container;
    }

    public function isLogin() {
        if ($_SESSION['auth']) {
            return TRUE;
        }else {
            return FALSE;
        }
    }


}