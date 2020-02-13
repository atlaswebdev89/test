<?php


namespace Model;

class Model {
    
    protected $driver;
    
    public function __construct($driver) {
        $this->driver = $driver;     
    }

    public function getData ($id) {        
            $type = 'arraydata';
            $sql = "select * from users where `id` = :id"; 
            $data_array=array(
                        'id' => $id
                    );
             $result =  $this->driver->query($sql, $type, $data_array); 
        return $result;      
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
}
