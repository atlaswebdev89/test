<?php

namespace Controller;

class RegisterController extends DisplayController
{
    //Массив содержащий все ссылки на текущей странице
    public $uriArrayPage = [
        'register' => 'register',
        'login' => 'login',
        'registerUsers' => 'registerUsers'
    ];

    //массив для ошибок
    public $err = array();
    //Переменная для глобальной ошибки
    public $message_err = FALSE;

    public function register()
    {
        //Подключение нужного шаблона в зависимости авторизирован
        //ли пользователь на сайте или нет
        if ($this->auth->isLogin()) {
            $this->templates = 'logout.php';
        } else {
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

    public function mainBar()
    {
        $data = $this->view->render($this->templates,
            [
                'lang' => $this->lang,
                'uriPage' => $this->uriArrayPage
            ]);
        return $data;
    }

    public function registerUsers()
    {
        //Валидация полей формы регистрации
        if (isset($_POST) && !empty($_POST) && isset($_FILES)) {
            $this->err = $this->validate->validateRegForm($_POST, $_FILES, $this->lang);
        }else{
            $this->message_err= 'Ошибка. Попробуйте позже';
        }

        //Если есть ошибки при валидации или ошибки получения данных, возращаем JSON ошибки
        if (count($this->err) != 0 || strlen($this->message_err)) {
            echo $this->returnErrorJSON($this->err, $this->message_err);
        }
    }

    //Передача json с ошибками валидации
    public function returnErrorJSON($field = null, $message =null)
    {
        return json_encode([
            'status' => false,
            'message' =>$message,
            'error' => $field
        ]);
    }

    //Передача json при успешной регистрации
    public function returnRegJSON () {

    }


}