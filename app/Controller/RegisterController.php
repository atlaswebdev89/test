<?php

namespace Controller;

class RegisterController extends DisplayController
{
    //Массив содержащий все ссылки на текущей странице 
    public $uriArrayPage = [
        'login' => 'login',
        'home' => '',
        'logout' => 'logout',
        'registerUsers' => 'registerUsers'
    ];
    
    public function register () {
            //Подключение нужного шаблона в зависимости авторизирован 
            //ли пользователь на сайте или нет
           if($this->auth->isLogin()){
                $this->templates = 'logout.php';
            }else {
                $this->templates = 'register.php';
            };        
            //Задаем заголовок странице
            $this->title = $this->lang['title_page_register'];
            //Получаем правильные ссылки для текущей странице с учетом локализации
            $this->uriArrayPage = $this->geturiPageCurrent($this->uriArrayPage);  
            //Формируем основной блок для отображения
            $this->mainbar = $this->mainBar();
        parent::display();
    }

    public function mainBar () {
        $data = $this->view->render($this->templates,
            [               
                'lang' =>  $this->lang,
                'uriPage' => $this->uriArrayPage      
            ]);
        return $data;
    }

    public function registerUsers () {
        print_r($_POST);
        print_r($_FILES);exit;
    }

    public function checkLogin () {
        if ($_POST['login']) {
                $result = $this->model->checkLogin(trim($_POST['login']));
            if (isset($result['id']) && !empty($result['id'])) {
                echo TRUE;
            }else
                echo FALSE;
        }
    }
}