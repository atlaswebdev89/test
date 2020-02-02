<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Library;

/**
 * Description of Session
 *
 * @author root
 */
class Session {
    public function __construct($container) {
        $this->container = $container;
    }

    public function langSession ($uriLang) {
        if (isset($_SESSION['lang']) && !empty($_SESSION['lang']) && ($_SESSION['lang'] == $uriLang)) {
            return TRUE;
        }else {
            return $this->container['language']->langValid($uriLang);
        }
    }
}
