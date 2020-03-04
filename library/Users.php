<?php


namespace Library;


class Users
{
   public function __construct($container)
   {
       $this->container = $container;    
   }

   //Функция получения данных пользователя
   public function getUserData ($id) {
       if ($id) {
           $result = $this->container['model']->getUserData($id);
           if (isset($result[0])) {
               return $result[0];
           }else
               return $result;
       }else
           return $result = FALSE;


   }
}