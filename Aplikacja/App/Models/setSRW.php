<?php

namespace App\Models;

use PDO;
use \App\Token;

class setSRW extends \Core\Model{

    public function __construct($data = []){
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    public function setCabinCheckSRW(){
        if($this->setCabinAllLikeFalse()){
            if(isset($this->checkbox)){
                foreach($this->checkbox as $value) {
                    $idEquipment = $value;
                    $this->addChangesSRW($idEquipment);
                }
                return true;
            }
            return true;
        }
        return false;
    }

    public function setLeftCheckSRW(){
        if($this->setLeftAllLikeFalse()){
            if(isset($this->checkbox)){
                foreach($this->checkbox as $value) {
                    $idEquipment = $value;
                    $this->addChangesSRW($idEquipment);
                }
                return true;
            }
            return true;
        }
        return false;
    }

    public function setRightCheckSRW(){
        if($this->setRightAllLikeFalse()){
            if(isset($this->checkbox)){
                foreach($this->checkbox as $value) {
                    $idEquipment = $value;
                    $this->addChangesSRW($idEquipment);
                }
                return true;
            }
            return true;
        }
        return false;
    }

    public function setRoofCheckSRW(){
        if($this->setRoofAllLikeFalse()){
            if(isset($this->checkbox)){
                foreach($this->checkbox as $value) {
                    $idEquipment = $value;
                    $this->addChangesSRW($idEquipment);
                }
                return true;
            }
            return true;
        }
        return false;
    }

    
    public function setCabinAllLikeFalse(){
        $status = "danger";
        $one = "Kabina";

        $sql = 'UPDATE srw SET status =:status WHERE space = :one';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':one', $one, PDO::PARAM_STR);

        $stmt->execute();

        return true;
    }

    public function setLeftAllLikeFalse(){
        $status = "danger";
        $two = "Podest lewy";
        $three = "Skrytka lewa I";
        $four = "Skrytka lewa II";

        $sql = 'UPDATE srw SET status =:status WHERE space = :two OR space = :three OR space = :four';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':two', $two, PDO::PARAM_STR);
        $stmt->bindValue(':three', $three, PDO::PARAM_STR);
        $stmt->bindValue(':four', $four, PDO::PARAM_STR);

        $stmt->execute();

        return true;
    }

    public function setRightAllLikeFalse(){
        $status = "danger";
        $two = "Skrytka prawa I";
        $three = "Skrytka prawa II";

        $sql = 'UPDATE srw SET status =:status WHERE space = :two OR space = :three';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':two', $two, PDO::PARAM_STR);
        $stmt->bindValue(':three', $three, PDO::PARAM_STR);

        $stmt->execute();

        return true;
    }

    public function setRoofAllLikeFalse(){
        $status = "danger";
        $one = "Dach";

        $sql = 'UPDATE srw SET status =:status WHERE space = :one';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':one', $one, PDO::PARAM_STR);

        $stmt->execute();

        return true;
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
}

