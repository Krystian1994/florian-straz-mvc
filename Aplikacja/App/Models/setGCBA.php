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

    //set checked items
    public function setCabinCheckGCBA(){
        if($this->setCabinAllLikeFalse()){
            if(isset($this->checkbox)){
                foreach($this->checkbox as $value) {
                    $idEquipment = $value;
                    $this->addChangesGCBA($idEquipment);
                }
                return true;
            }
            return true;
        }
        return false;
    }

    public function setLeftCheckGCBA(){
        if($this->setLeftAllLikeFalse()){
            if(isset($this->checkbox)){
                foreach($this->checkbox as $value) {
                    $idEquipment = $value;
                    $this->addChangesGCBA($idEquipment);
                }
                return true;
            }
            return true;
        }
        return false;
    }

    public function setRightCheckGCBA(){
        if($this->setRightAllLikeFalse()){
            if(isset($this->checkbox)){
                foreach($this->checkbox as $value) {
                    $idEquipment = $value;
                    $this->addChangesGCBA($idEquipment);
                }
                return true;
            }
            return true;
        }
        return false;
    }

    public function setRoofCheckGCBA(){
        if($this->setRoofAllLikeFalse()){
            if(isset($this->checkbox)){
                foreach($this->checkbox as $value) {
                    $idEquipment = $value;
                    $this->addChangesGCBA($idEquipment);
                }
                return true;
            }
            return true;
        }
        return false;
    }



    //set all like false
    public function setCabinAllLikeFalse(){
        $status = "danger";
        $one = "Kabina";

        $sql = 'UPDATE gcba SET status =:status WHERE space = :one';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':one', $one, PDO::PARAM_STR);

        $stmt->execute();

        return true;
    }

    public function setLeftAllLikeFalse(){
        $status = "danger";
        $one = "Skrytka Lewa I";
        $two = "Skrytka Lewa II";
        $three = "Skrytka Lewa III";
        $four = "Skrytka lewa IV";

        $sql = 'UPDATE gcba SET status =:status WHERE space = :one OR space = :two OR space = :three OR space = :four';

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

    public function setRightAllLikeFalse(){
        $status = "danger";
        $one = "Skrytka Prawa I";
        $two = "Skrytka Prawa II";
        $three = "Skrytka Prawa III";
        $four = "Skrytka prawa IV";

        $sql = 'UPDATE gcba SET status =:status WHERE space = :one OR space = :two OR space = :three OR space = :four';

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

    public function setRoofAllLikeFalse(){
        $status = "danger";
        $one = "Bagażnik";
        $four = "Dach";

        $sql = 'UPDATE gcba SET status =:status WHERE space = :one OR space = :four';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':one', $one, PDO::PARAM_STR);
        $stmt->bindValue(':four', $four, PDO::PARAM_STR);

        $stmt->execute();

        return true;
    }

    //add changes
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
}

