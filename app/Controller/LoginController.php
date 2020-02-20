<?php

namespace Controller;

class LoginController extends DisplayController
{
    //Массив содержащий все ссылки на текущей странице 
    public $uriArrayPage = [
        'register' => 'register',
        'checkUsers' => 'checkUsers',
        'home' => '',
        'logout' => 'logout',
        'login' => 'login'
    ];

    public function __construct($container)
    {
        parent::__construct($container);
        //Получаем правильные ссылки для текущей странице с учетом локализации
        $this->uriArrayPage = $this->geturiPageCurrent($this->uriArrayPage);

    }

    public function logout () {
        if (isset($_POST['logout']) && !empty($_POST['logout']) ) {
            $this->container['session']->deleteSession();
                setcookie("hash", "", time() - 3600, '/');
            echo json_encode([
                'status' => true,
                'url' => $this->uriArrayPage['login']
            ]);

        }
    }

    public function login () {
            //Подключение нужного шаблона в зависимости авторизирован 
            //ли пользователь на сайте или нет
            if($this->auth->isLogin()){
                $this->templates = 'logout.php';
            }else {
                $this->templates = 'login.php';
            };                 
            //Задаем заголовок странице
            $this->title = $this->lang['title_page_login'];
            //Формируем основной блок для отображения
            $this->mainbar = $this->mainBarLogin();
        parent::display();
    }

    public function mainBarLogin () {
            $data = $this->view->render($this->templates,
                [                   
                    'lang' =>  $this->lang,
                    'uriPage' => $this->uriArrayPage
                ]);
            return $data;
    }

    //Функция авторизиции пользователя на сайте
    public function checkUsers () {
        if (isset($_POST) && !empty($_POST)) {
            //Обработка данных запроса POST
            $login      =     trim($_POST['login']);
            $password   =     trim($_POST['password']);

            if (empty($login) || empty($password)){
                echo json_encode(array('url' => FALSE, 'status'=> FALSE, 'message' => 'Не все обязательные поля заполнены'));
            }
        }

        //Проверка существования указананого в форме пользователя
        $result = $this->model->getUsersLoginPass($login);
        if ($result) {
            $result = $result[0];
            if ($result['password'] == md5($password)) {
                //Генерируем случайное число
                $hash = $this->generateHash($result['id']);
                //Записываем в БД новый хеш
                $this->HashAdd($result['id'], $hash);
                //Получаем данные пользователя
                $user = $this->model->getUserData ($result['id']);
                //Формируем данные сессии
                $this->container['session']->CreateSessionData($user);
                echo json_encode(['status' => TRUE, 'url' => $this->uriArrayPage['home']]);
            }else {
                echo json_encode(['status' => FALSE, 'message' => $this->lang['message_no_auth']]);
            }
        }else {
            echo json_encode(['status' => FALSE, 'message' =>  $this->lang['message_no_login'] ]);
        }
    }

    //Функция генерации Хеша для передачи в куки и сохранения в БД
    public function generateHash ($str) {
        return md5(microtime().$str);
    }

    //Функция добавления хеша в БД и выставление куки
    public function HashAdd ($id,$hash) {
        //Записываем в БД новый хеш
        $this->model->updateHashUser ($id,$hash);
        //Установливаем куки
        setcookie("hash", $hash, time() + TIMEOUT_USER_HASH, '/');
    }
}