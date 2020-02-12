<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controller;

/**
 * Description of IndexController
 *
 * @author root
 */
class IndexController extends DisplayController {
    protected $driver;
    protected $user;

    public function __construct($container) { 
            parent::__construct($container);
    }
    
    public function execute () {
            //Запускам класс постредник для проверки авторизован ли пользователь
            $this->middle->isUserLogin();            
        return $this->display();
    }
 
    protected function display() {
                $this->title .= 'HOME';
                $this->user = $this->getData(1);
                $this->mainbar = $this->mainBar();
            parent::display();
    }

    public function getData ($id) {
        return $this->model->getData($id);                  
    }

    public function mainBar () {
                $data = $this->view->render('login.php',
                            [
                                'title' => $this->lang['title'],
                                'user'  => $this->user,
                                'lang' =>  $this->lang
                            ]);
                return $data;   
        }        
   
}
