<?php

namespace App\Models;

use PDO;
use \App\Token;

class setSLRR extends \Core\Model{

    public function __construct($data = []){
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    public function setCheckSLRR(){
        if($this->setAllLikeFalse()){
            foreach($this->checkbox as $value) {
                $idEquipment = $value;
                $this->addChangesSLRR($idEquipment);
            }
            return true;
        }
        return false;
    }

    public function addChangesSLRR($id){
        $status = "success";

        $sql = 'UPDATE slrr SET status =:status WHERE id = :id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        
        $stmt->execute();

        return true;
    }

    public function setAllLikeFalse(){
        $status = "danger";

        $sql = 'UPDATE slrr SET status =:status';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':status', $status, PDO::PARAM_STR);

        $stmt->execute();

        return true;
    }
}

