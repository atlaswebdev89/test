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
           
    }
}
