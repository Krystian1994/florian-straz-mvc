<?php

namespace App\Models;

use PDO;
use \App\Token;

class setGCBA extends \Core\Model{

    public function __construct($data = []){
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    public function setCheckGCBA(){
        if($this->setAllLikeFalse()){
            foreach($this->checkbox as $value) {
                $idEquipment = $value;
                $this->addChangesGCBA($idEquipment);
            }
            return true;
        }
        return false;
    }

    public function addChangesGCBA($id){
        $status = "success";

        $sql = 'UPDATE gcba SET status =:status WHERE id = :id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        
        $stmt->execute();

        return true;
    }

    public function setAllLikeFalse(){
        $status = "danger";

        $sql = 'UPDATE gcba SET status =:status';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':status', $status, PDO::PARAM_STR);

        $stmt->execute();

        return true;
    }
}

