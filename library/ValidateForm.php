<?php


namespace Library;


class ValidateForm
{
    //массив ошибок
    public $err = array();
    public $model;
    protected $lang;

    public function __construct($container)
    {
        $this->model=$container['model'];
    }

    //Функция удаления тегов и пробелов в начале и конце
    public function clearStr($str) {
        return strip_tags(trim($str));
    }

    public function validateRegForm (array $form, array $files, array $lang = null) {
        //Массив с текущем языком
        if ($lang) {
            $this->lang = $lang;
        }
                //Проверка поля формы имя (name)
                if (isset($form['name'])) {
                    $this->ValidateName($this->clearStr($form['name']), $key = 'name');
                }
                //Проверка формы логина
                if (isset($form['login'])){
                    $this->validateLogin($this->clearStr($form['login']),$key = 'login');
                }
                //Проверка поля email
                if (isset($form['email'])) {
                    $this->ValidateEmail($this->clearStr($form['email']), $key = 'email');
                }
                //Проверка поля password
                if (isset($form['password']) ) {
                    $this->ValidatePassword($this->clearStr($form['password']),$key = 'password');
                }
                //Проверка поля подтверждения password
                if (isset($form['password_confirm'])) {
                    $this->ValidatePassword($this->clearStr($form['password_confirm']), $key = 'password_confirm');
                }

                //Проверка файла на соответствие

        //Возвращаем массив с возможными ошибками валидации
        return $this->err;
}
    protected function addErrorArray ($nameInput,$message ) {
        $this->err [$nameInput]['message'] = $message;
        $this->err [$nameInput]['field'] = $nameInput;
    }

    //Функция валидации поля Имя (Name)
    protected function ValidateName ($name, $key) {
        //Проверка на пустоту
        if (strlen($name) == 0) {
            $this->addErrorArray($key, 'Не заполнено поле Логина');
            return true;
        }
        //Проверка длины логина
        if (strlen($name) < 3) {
            $this->addErrorArray($key, 'Длина должна быть больше 3 символов');
            return true;
        }
        //Запрет специальных символов в имени пользователя
        if (preg_match("/[\~`!@#$%\^&*()+=\-\[\]\\';,{}|\\\":<>\?]+/", $name)) {
            $this->addErrorArray($key, 'Запрещенные символы');
        }
    }
    //Функция валидации Логина
    public function validateLogin($login, $key)
    {
        //Проверка на пустоту
        if (strlen($login) == 0) {
                $this->addErrorArray($key, 'Не заполнено поле Логина');
            return true;
        }
        //Проверка длины логина
        if (strlen($login) < 3) {
                $this->addErrorArray($key, 'Длина логина должна быть больше 3 символов');
            return true;
        }
        //Проверка разрешенных симоволов
        if (!preg_match("/^[a-zA-Z0-9_]+$/", $login)) {
                $this->addErrorArray($key, 'Введенный логин не соответствует шаблону');
            return true;
        }
        //Проверка наличия указанного логина в БД
        if ($this->checkLogin($login)) {
                $this->addErrorArray($key, 'Логин занят');
            return true;
        }
    }

    //Функция проверки поля email
    protected function ValidateEmail ($email, $key) {
        //Проверка на пустоту
        if (strlen($email) == 0) {
                $this->addErrorArray($key, 'Не заполнено поле email');
            return true;
        }
        //Соответствие шаблону
        if (!preg_match("/^[a-z0-9_-]+@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i", $email)) {
                $this->addErrorArray($key, 'Не правильный формат почтового ящика');
            return true;
        }

        //Проверка на наличие в БД email
        if ($this->checkMail($email)){
                $this->addErrorArray($key, 'Почта уже есть в БД');
            return true;
        }
    }


    //Функция проверки пароля
    public function ValidatePassword ($pass, $key) {
        //Поверка на пустоту
        if (strlen($pass) == 0) {
                $this->addErrorArray($key, 'Обязательно для заполнения');
            return true;
        }
        //Проверка длины пароля
        if (strlen($pass) < 6 ) {
                $this->addErrorArray($key, 'Пароль не менее 6 символов');
            return true;
        }
        //Запрет русских букв
        if (preg_match("~[а-яА-Я]+~", $pass)) {
                $this->addErrorArray($key, 'Нельзя русские буквы в пароле');
            return true;
        }
    }

    //Функция проверки наличия логина в БД
    public function checkLogin ($login) {
        if ($login) {
            $result = $this->model->checkLogin($login);
            if (isset($result[0]['id']) && !empty($result[0]['id'])) {
                return TRUE;
            }else
                return FALSE;
        }
    }

    //Функция проверки наличия email в БД
    public function checkMail ($email) {
        $result = $this->model->checkMail($email);
        if (isset($result[0]['id']) && !empty($result[0]['id'])) {
            return TRUE;
        }else
            return FALSE;
    }

}