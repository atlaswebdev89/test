<?php


namespace Library;


class Users
{
   public function __construct($container)
   {
       $this->container = $container;
       $this->model = $container['model'];
   }

   //Функция получения данных пользователя
   public function getUserData ($id) {
       if ($id) {
           $result = $this->model->getUserData($id);
           if (isset($result[0])) {
               return $result[0];
           }else
               return $result;
       }else
           return $result = FALSE;
   }

    //Функция добавления хеша в БД и выставление куки
    public function HashAdd ($id,$hash) {
        //Записываем в БД новый хеш
        $this->model->updateHashUser ($id,$hash);
        //Установливаем куки
        setcookie("hash", $hash, time() + TIMEOUT_USER_HASH, '/');
    }

    //Получение данных пользоваля по хеш
    public function getUsers($hash) {
       $result = $this->model->getUsers($hash);
       if (isset($result[0])) {
           return $result[0];
       }
    }

    //Получение значения хеша пользователя из БД
    public function getHashUser ($id) {
       return $this->model->getHashUser($id);
    }
}