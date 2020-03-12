<?php

namespace Controller;

class RegisterController extends DisplayController
{
    //Массив содержащий все ссылки на текущей странице
    public $uriArrayPage =  [
                                'register' => 'register',
                                'login' => 'login',
                                'registerUsers' => 'registerUsers',
                                'home' => ''
                            ];
    //массив для ошибок
    public $err = array();
    //Переменная для глобальной ошибки
    public $message_err = FALSE;
    //Массив данных нового пользователя
    protected $userData = array();

    //Путь к папке с загруженными изображениями
    protected $pathUpload;
    //Папка для изображений
    protected $dirImages = '/uploads/';
    protected $notAva  = 'notAva.jpg';

    public function __construct($container)
    {
        parent::__construct($container);
        //Получаем правильные ссылки для текущей странице с учетом локализации
        $this->uriArrayPage = $this->geturiPageCurrent($this->uriArrayPage);
        //Путь к папке с загруженными аватарками
        $this->pathUpload = $this->container['document_root']. '/public/templates'.$this->dirImages;
    }

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
        if (isset($_POST) && !empty($_POST) && isset($_FILES) && !empty($_FILES)) {
            $this->err = $this->validate->validateRegForm($_POST, $_FILES, $this->lang);
        }else{
            $this->message_err= $this->lang['error_post_data_register'];
        }

        //Если есть ошибки при валидации или ошибки получения данных, возращаем JSON ошибки
        if (count($this->err) != 0 || strlen($this->message_err)) {
            echo $this->returnErrorJSON($this->err, $this->message_err);
        }else {
            //Формируем массив данных пользователя
            foreach ($_POST as $key=>$item) {
                $this->userData[$key] = $this->clear_str($item);
            }
            //Загружаем файл аватарки и возвращаем путь к файлу
            if($avatarPath = $this->uploadFile($_FILES)) {
                //Добавляем путь к массиву данных нового пользователя
                $this->userData['avatar'] = $this->dirImages.$avatarPath;
            }
            //Добавлем нового пользователя в БД
            if ($result = $this->addNewUser($this->userData)) {
                    //Получаем данные пользователя если ошибок добавления в БД нет
                    $user = $this->user->getUserData ($result);
                    //Формируем данные сессии
                    $this->container['session']->CreateSessionData($user);
                echo $this->returnRegJSON();
            }else {
                //Удаляем файл
                $this->deleteFile($this->pathUpload.$avatarPath);
                //Возращаем ошибку
                echo $this->returnErrorJSON(null, $this->lang['error_register_new_user']);
            }
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
            return json_encode([
                'status'=> TRUE,
                'url'=>$this->uriArrayPage['home']
            ]);
    }

    //Функция загрузки файла и возвращение пути к файлу
    protected function uploadFile (array $file) {
        $key = 'file';
        $file = $file[$key];
        //Если файл не загружен устанавливаем заглушку для аватарки
        if (empty($file['name']) || empty($file['tmp_name'])){
            return $this->notAva;
        }
        //Путь к файлу
        $filePath  = $file['tmp_name'];
        $filename = $file['name'];
        // Результат функции запишем в переменную
        $image = getimagesize($filePath);
        // Сгенерируем новое имя файла на основе MD5-хеша
        $name = md5_file($filePath);
        // Сгенерируем расширение файла на основе типа картинки
        $extension = image_type_to_extension($image[2]);
        // Переместим картинку с новым именем и расширением в папку /uploads
        if (move_uploaded_file($filePath, $this->pathUpload.$name.$extension)) {
            return $name.$extension;
        } else
            return FALSE;
    }

    //Функция удаления файла из папке
    protected function deleteFile ($path) {
            return unlink($path);
    }

    //Функция добавления нового пользователя в БД
    protected function addNewUser (array $user) {
        //Формируем хеш пользователя
        $user['hash'] = $this->generateHash(microtime());
        //Добавлем значения в таблицу user_auth
        if($idNewUser = $this->model->addNewUserAuth($user)){
            $user['id_users'] = $idNewUser;
        };
        //Добавляем данные в таблицу users
        if($this->model->addNewUserdata($user)) {
            return $idNewUser;
        }else {
            return FALSE;
        }
    }
}