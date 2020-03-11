<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Core;

/**
 * Description of DriverDB
 *
 * @author root
 */
class DriverDB {
    protected static $db;

    public function __construct($pdo) {
        if (isset ($pdo)){
            self::$db = $pdo;
        }else 
            throw new \PDOException ("Нет подключения к БД");
    }
    
    public function query ($sql, $type, array $data = NULL){     
        switch ($type){
            case 'arraydata':                
                    $row =  self::$db->prepare($sql);
                    $row->execute($data);
                return $row->fetchAll();
                break;
            case 'count':                
                    $row =  self::$db->prepare($sql);
                    $row->execute($data);
                return $row->rowCount();
                break;
            case 'insert':
                    $row = self::$db->prepare($sql);
                    $row->execute($data);
                return self::$db->lastInsertId();
                break;
        }
    }
}
