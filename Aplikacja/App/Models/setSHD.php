<?php

namespace App\Models;

use PDO;
use \App\Token;

class setSHD extends \Core\Model{

    public function __construct($data = []){
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    public function setCheckSHD(){
        if($this->setAllLikeFalse()){
            foreach($this->checkbox as $value) {
                $idEquipment = $value;
                $this->addChangesSHD($idEquipment);
            }
            return true;
        }
        return false;
    }

    public function addChangesSHD($id){
        $status = "success";

        $sql = 'UPDATE shd SET status =:status WHERE id = :id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        
        $stmt->execute();

        return true;
    }

    public function setAllLikeFalse(){
        $status = "danger";

        $sql = 'UPDATE shd SET status =:status';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':status', $status, PDO::PARAM_STR);

        $stmt->execute();

        return true;
    }
}

