<?php

namespace App\Models;

use PDO;
use \App\Token;

class setGBA extends \Core\Model{

    public function __construct($data = []){
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    public function setCabinCheckGBA(){
        if($this->setCabinAllLikeFalse()){
            if(isset($this->checkbox)){
                foreach($this->checkbox as $value) {
                    $idEquipment = $value;
                    $this->addChangesGBA($idEquipment);
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

        $sql = 'UPDATE gba SET status =:status WHERE space = :one';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':one', $one, PDO::PARAM_STR);

        $stmt->execute();

        return true;
    }

    public function setLeftCheckGBA(){
        if($this->setLeftAllLikeFalse()){
            if(isset($this->checkbox)){
                foreach($this->checkbox as $value) {
                    $idEquipment = $value;
                    $this->addChangesGBA($idEquipment);
                }
                return true;
            }
            return true;
        }
        return false;
    }

    public function setLeftAllLikeFalse(){
        $status = "danger";
        $one = "Skrytka Lewa I";
        $two = "Skrytka Lewa II";
        $three = "Skrytka Lewa III";

        $sql = 'UPDATE gba SET status =:status WHERE space = :one OR space = :two OR space = :three';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':one', $one, PDO::PARAM_STR);
        $stmt->bindValue(':two', $two, PDO::PARAM_STR);
        $stmt->bindValue(':three', $three, PDO::PARAM_STR);

        $stmt->execute();

        return true;
    }
    
    public function addChangesGBA($id){
        $status = "success";

        $sql = 'UPDATE gba SET status =:status WHERE id = :id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);
        
        $stmt->execute();

        return true;
    }

    public function setRightCheckGBA(){
        if($this->setRightAllLikeFalse()){
            if(isset($this->checkbox)){
                foreach($this->checkbox as $value) {
                    $idEquipment = $value;
                    $this->addChangesGBA($idEquipment);
                }
                return true;
            }
            return true;
        }
        return false;
    }

    public function setRightAllLikeFalse(){
        $status = "danger";
        $one = "Skrytka Prawa I";
        $two = "Skrytka Prawa II";
        $three = "Skrytka Prawa III";
        $four = "Dach";

        $sql = 'UPDATE gba SET status =:status WHERE space = :one OR space = :two OR space = :three OR space = :four';

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

    public function setRoofCheckGBA(){
        if($this->setRoofAllLikeFalse()){
            if(isset($this->checkbox)){
                foreach($this->checkbox as $value) {
                    $idEquipment = $value;
                    $this->addChangesGBA($idEquipment);
                }
                return true;
            }
            return true;
        }
        return false;
    }

    public function setRoofAllLikeFalse(){
        $status = "danger";
        $one = "Bagażnik";
        $four = "Dach";

        $sql = 'UPDATE gba SET status =:status WHERE space = :one OR space = :four';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':one', $one, PDO::PARAM_STR);
        $stmt->bindValue(':four', $four, PDO::PARAM_STR);

        $stmt->execute();

        return true;
    }

}

