<?php


namespace Controller;


class RegisterController extends DisplayController
{
    //Массив содержащий все ссылки на текущей странице 
    public $uriArrayPage = [
        'login' => 'login'
    ];
    
    public function register () {
            //Задаем заголовок странице
            $this->title = $this->lang['title_page_register'];
            //Получаем правильные ссылки для текущей странице с учетом локализации
            $this->uriArrayPage = $this->geturiPageCurrent($this->uriArrayPage);  
            //Формируем основной блок для отображения
            $this->mainbar = $this->mainBar();
        parent::display();
    }

    public function mainBar () {
        $data = $this->view->render('register.php',
            [               
                'lang' =>  $this->lang,
                'uriPage' => $this->uriArrayPage      
            ]);
        return $data;
    }
    
     
}