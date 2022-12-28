<?php

namespace App\Models;

use PDO;
use \App\Token;

class setleftSRW extends \Core\Model{

    public function __construct($data = []){
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    public function setLeftCheckSRW(){
        if($this->setLeftAllLikeFalse()){
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


    public function setLeftAllLikeFalse(){
        $status = "danger";
        $one = "Kabina";
        $two = "Podest lewy";
        $three = "Skrytka lewa I";
        $four = "Skrytka lewa II";

        $sql = 'UPDATE srw SET status =:status WHERE space = :one OR space = :two OR space = :three OR space = :four';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':one', $one, PDO::PARAM_STR);
        $stmt->bindValue(':two', $two, PDO::PARAM_STR);
        $stmt->bindValue(':three', $three, PDO::PARAM_STR);
        $stmt->bindValue(':four', $four, PDO::PARAM_STR);

        $stmt->execute();

        return true;
    }
}

