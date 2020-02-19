<?php


namespace Library;


class Users
{
   public function __construct($container)
   {
       $this->container = $container;    
   }
   
   public function getUserData ($id) {
       return $this->container['model']->getUserData($id);
   }
}