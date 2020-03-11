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
    
    public function CreateSessionData (array $data) {
                $_SESSION['hash']               =   $data['hash'];
                $_SESSION['name']               =   $data['name'];
                $_SESSION['login']              =   $data['login'];
                $_SESSION['user_id']            =   $data['id'];
                $_SESSION['auth']               =   TRUE;              
    }
    
    public function deleteSession (){
                unset($_SESSION['auth']);
            session_destroy();
    }
}
