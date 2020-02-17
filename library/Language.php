<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Library;

/**
 * Description of Language
 *
 * @author root
 */
class Language {
    
    protected $aliasLang;
    
    public function __construct($container) {
        $this->container = $container;
    }
    
    //Проверка наличия языка в системе по указаному alias языка. 
    public function langValid ($urls) {       
        if (in_array($urls, LANG)){
                $_SESSION['lang'] = $urls;
            return TRUE;
        }else 
                $_SESSION['lang'] = DEFAULT_LANG;
            return FALSE;
    }
    
}
