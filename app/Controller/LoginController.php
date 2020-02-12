<?php


namespace Controller;


class LoginController extends DisplayController
{
    public function login () {
        echo "Пройдите авторизацию на сайте";
    }
    public function register () {
        $this->mainbar = $this->mainBar();
            parent::display();
    }
    
    public function mainBar () {
                $data = $this->view->render('register.php',
                            [
                                'title' => $this->lang['title'],
                                'lang' =>  $this->lang
                            ]);
                return $data;   
        }      
}