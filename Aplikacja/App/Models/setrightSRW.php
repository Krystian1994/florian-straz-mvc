<?php

namespace App\Models;

use PDO;
use \App\Token;

class setrightSRW extends \Core\Model{

    public function __construct($data = []){
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    public function setRightCheckSRW(){
        if($this->setRightAllLikeFalse()){
            foreach($this->checkbox as $value) {
                $idEquipment = $value;
                $this->addChangesSRW($idEquipment);
            }
            return true;
        }
        return false;
    }

    public function addChangesSRW($id){
        $status = "success";

        $sql = 'UPDATE srw SET status =:status WHERE id = :id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        
        $stmt->execute();

        return true;
    }


    public function setRightAllLikeFalse(){
        $status = "danger";
        $one = "Dach";
        $two = "Skrytka prawa I";
        $three = "Skrytka prawa II";

        $sql = 'UPDATE srw SET status =:status WHERE space = :one OR space = :two OR space = :three';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':one', $one, PDO::PARAM_STR);
        $stmt->bindValue(':two', $two, PDO::PARAM_STR);
        $stmt->bindValue(':three', $three, PDO::PARAM_STR);

        $stmt->execute();

        return true;
    }
}

