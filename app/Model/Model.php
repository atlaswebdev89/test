<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Model;

/**
 * Description of Model
 *
 * @author root
 */
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
}
