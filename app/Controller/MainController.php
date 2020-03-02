<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controller;

/**
 * Description of MainController
 *
 * @author root
 */
class MainController {
    public function __construct($container) { 
            $this->container = $container;
            $this->model = $container['model'];
            $this->view=$container['view'];
            $this->user = $container['user'];
            $this->middle = $container['middle'];
            $this->auth = $container['auth'];
            $this->validate = $container['validate'];
    }

    public function clear_str($str) {
            $str =  strip_tags(trim($str));
        return ($str);
    }
}
