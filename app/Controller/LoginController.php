<?php

namespace Controller;

class LoginController extends DisplayController
{
    //Массив содержащий все ссылки на текущей странице 
    public $uriArrayPage = [
        'register' => 'register'
    ];
    public function login () {
            //Задаем заголовок странице
            $this->title = $this->lang['title_page_login'];
            //Получаем правильные ссылки для текущей странице с учетом локализации
            $this->uriArrayPage = $this->geturiPageCurrent($this->uriArrayPage);  
            //Формируем основной блок для отображения
            $this->mainbar = $this->mainBarLogin();
        parent::display();
    }

    public function mainBarLogin () {
            $data = $this->view->render('login.php',
                [                   
                    'lang' =>  $this->lang,
                    'uriPage' => $this->uriArrayPage                
                ]);
            return $data;
    }
}