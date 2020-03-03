<?php


namespace Model;

class Model {
    
    protected $driver;
    
    public function __construct($driver) {
        $this->driver = $driver;     
    }

    //Функция получения хеш пользователя по id 
    public function getHashUser ($id) {
            $type = 'arraydata';
            $sql = "select hash from user_auth where `id` =:id"; 
            $data_array=array(
                        'id' => $id
                    );
             $result =  $this->driver->query($sql, $type, $data_array); 
        return $result[0];       
    }
    //Функция получения данных пользователя по хеш, хранимой в куки
    public function getUsers ($hash) {
            $type = 'arraydata';
            $sql = "select * from `user_auth` "
                       ." LEFT JOIN `users` ON `user_auth`.`id` = `users`.`id_users` " 
                       ." where `user_auth`.`hash` =:hash"; 
            $data_array=array(
                        'hash' => $hash
                    );
            $result =  $this->driver->query($sql, $type, $data_array); 
        return $result[0];   
    }

    //Функция получения используемых языков сайта
    public function getLang () {
            $type = 'arraydata';
            $sql = "select * from `lang`";
            $result =  $this->driver->query($sql, $type);
        return $result;
    }

    //Проверка наличия логина в бд
    public function getUsersLoginPass ($login) {
        $type = 'arraydata';
        $sql = "select id, password from `user_auth` where `login` =:login";
        $data_array=array(
            'login' => $login
        );
        $result =  $this->driver->query($sql, $type, $data_array);
        return $result;
    }
    //Обновляем хеш пользователя
    public function updateHashUser ($id, $hash) {
            $type = 'count';
            $sql = "UPDATE `user_auth` SET `hash` = :hash WHERE `id` = :id";
            $data_array=array(
                'hash'  => $hash,
                'id'  => $id
            );
            $result =  $this->driver->query($sql, $type, $data_array);
    }

    //Получение данных пользователя
    public  function getUserData ($id) {
        $type = 'arraydata';
        $sql =  "select * from `user_auth` "
                ." LEFT JOIN `users` ON `user_auth`.`id` = `users`.`id_users` "
                ."  where `user_auth`.`id` =:id";
        $data_array=array(
            'id' => $id
        );
        $result =  $this->driver->query($sql, $type, $data_array);
        return $result[0];
    }

    //Функция проверки наличия логина в БД
    public function checkLogin ($login) {
            $type = 'arraydata';
            $sql =  "select `id` from `user_auth` where `user_auth`.`login` =:login";
            $data_array=array(
                'login' => $login
            );
            $result =  $this->driver->query($sql, $type, $data_array);
        return $result;
    }


    public function checkMail ($mail) {
        $type = 'arraydata';
            $sql =  "select `id` from `users` where `users`.`email` =:mail";
            $data_array=array(
                'mail' => $mail
            );
            $result =  $this->driver->query($sql, $type, $data_array);
        return $result;
    }

    //Добавление в таблицу user_auth данные авторизации нового пользователя
    public function addNewUserAuth (array $user) {
        $type = "insert";
        $sql = "INSERT INTO `user_auth` (login, password, hash) values (:login, :password, :hash)";
        $data_array = array(
            'login' => $user['login'],
            'password' => md5($user['password']),
            'hash' => $user['hash']
        );
        $result = $this->driver->query($sql, $type, $data_array);
        return $result;

    }
    //Добавление в таблицу users данных пользователя
    public function addNewUserdata (array $user) {
        $type = "count";
        $sql = "INSERT INTO `users` (name,  foto, email, id_users) values (:name, :foto, :email, :id_users)";
        $data_array = array(
            'name' => $user['name'],
            'foto' => $user['avatar'],
            'email' => $user['email'],
            'id_users' => $user['id_users'],
        );
        $result = $this->driver->query($sql, $type, $data_array);
        return $result;

    }
    
}
