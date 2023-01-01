<?php

namespace App\Models;

use PDO;
use \App\Token;

class setEdit extends \Core\Model{
    public $errors = [];

    public function __construct($data = []){
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    public function addEquipmentGBA(){
        $this->validate();

        if(empty($this->errors)){
            $sql = 'INSERT INTO gba SET name = :name, quantity = :quantity, space = :space, date_modification = :date_modification, user = :user';

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindValue(':quantity', $this->quantity, PDO::PARAM_STR);
            $stmt->bindValue(':space', $this->space, PDO::PARAM_STR);
            $stmt->bindValue(':date_modification', $this->date, PDO::PARAM_STR);
            $stmt->bindValue(':user', $this->user, PDO::PARAM_STR);
            
            $stmt->execute();

            return true;
        } else {
            return false;
        }
    }

    public function addEquipmentGCBA(){
        $this->validate();

        if(empty($this->errors)){
            $sql = 'INSERT INTO gcba SET name = :name, quantity = :quantity, space = :space, date_modification = :date_modification, user = :user';

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindValue(':quantity', $this->quantity, PDO::PARAM_STR);
            $stmt->bindValue(':space', $this->space, PDO::PARAM_STR);
            $stmt->bindValue(':date_modification', $this->date, PDO::PARAM_STR);
            $stmt->bindValue(':user', $this->user, PDO::PARAM_STR);
            
            $stmt->execute();

            return true;
        } else {
            return false;
        }
    }

    public function addEquipmentSHD(){
        $this->validate();

        if(empty($this->errors)){
            $sql = 'INSERT INTO shd SET name = :name, quantity = :quantity, space = :space, date_modification = :date_modification, user = :user';

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindValue(':quantity', $this->quantity, PDO::PARAM_STR);
            $stmt->bindValue(':space', $this->space, PDO::PARAM_STR);
            $stmt->bindValue(':date_modification', $this->date, PDO::PARAM_STR);
            $stmt->bindValue(':user', $this->user, PDO::PARAM_STR);
            
            $stmt->execute();

            return true;
        } else {
            return false;
        }
    }

    public function addEquipmentSRW(){
        $this->validate();

        if(empty($this->errors)){
            $sql = 'INSERT INTO srw SET name = :name, quantity = :quantity, space = :space, date_modification = :date_modification, user = :user';

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindValue(':quantity', $this->quantity, PDO::PARAM_STR);
            $stmt->bindValue(':space', $this->space, PDO::PARAM_STR);
            $stmt->bindValue(':date_modification', $this->date, PDO::PARAM_STR);
            $stmt->bindValue(':user', $this->user, PDO::PARAM_STR);
            
            $stmt->execute();

            return true;
        } else {
            return false;
        }
    }

    public function addEquipmentSLRR(){
        $this->validate();
        
        if(empty($this->errors)){
            $sql = 'INSERT INTO slrr SET name = :name, quantity = :quantity, space = :space, date_modification = :date_modification, user = :user';

            $db = static::getDB();
            $stmt = $db->prepare($sql);

            $stmt->bindValue(':name', $this->name, PDO::PARAM_STR);
            $stmt->bindValue(':quantity', $this->quantity, PDO::PARAM_STR);
            $stmt->bindValue(':space', $this->space, PDO::PARAM_STR);
            $stmt->bindValue(':date_modification', $this->date, PDO::PARAM_STR);
            $stmt->bindValue(':user', $this->user, PDO::PARAM_STR);
            
            $stmt->execute();

            return true;
        } else {
            return false;
        }
    }

    public function validate(){
        if ((!isset($this->quantity)) || ($this->quantity <= 0)) {
            $this->errors[]  = "Nieprawidłowa ilość.";
        }

        $this->name = htmlentities($this->name,ENT_QUOTES,"UTF-8");

        $badDate = '';
        if($this->date == $badDate){
            $this->errors[] = "Nie podano daty dodania.";
        }
        
        if(!isset($this->space)){
            $this->errors[] = "Nie wybrano miejsca składowania.";
        }

        if(!isset($this->user)){
            $this->errors[] = "Brak danych osoby wprowadzającej.";
        }
    }
}

