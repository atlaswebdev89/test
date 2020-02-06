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
}
