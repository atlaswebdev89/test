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

        //массив для ошибок
        $err = array ();

        if (isset($_POST) && !empty($_POST)) {

                $err ['login']['message'] = 'Логин занят';
                $err ['login']['field'] = 'login';

        }
        if (isset($_POST) && !empty($_POST)) {

                $err ['email']['message'] = 'Такой email уже зарегистрирован';
                $err ['email']['field'] = 'email';

        }

        if ($_POST['name'] ) {
            $err ['name']['message'] = 'Запрещенный символы';
            $err ['name']['field'] = 'name';
        }
        if(count($err) !=0) {
            echo $this->returnErrorJSON($err);
        }


    }
    public function returnErrorJSON ($field) {
        return json_encode([
            'status' => false,
            'error' => $field
        ]);
    }
    //Функция проверки наличия логина в БД
    public function checkLogin ($login) {
        if ($login) {
                $result = $this->model->checkLogin($login);
            if (isset($result['id']) && !empty($result['id'])) {
                echo TRUE;
            }else
                echo FALSE;
        }
    }
}