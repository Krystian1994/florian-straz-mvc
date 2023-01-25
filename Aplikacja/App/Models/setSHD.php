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

    //set checked items
    public function setCabinCheckSHD(){
        if($this->setCabinAllLikeFalse()){
            if(isset($this->checkbox)){
                foreach($this->checkbox as $value) {
                    $idEquipment = $value;
                    $this->addChangesSHD($idEquipment);
                }
                return true;
            }
            return true;
        }
        return false;
    }

    public function setLeftCheckSHD(){
        if($this->setLeftAllLikeFalse()){
            if(isset($this->checkbox)){
                foreach($this->checkbox as $value) {
                    $idEquipment = $value;
                    $this->addChangesSHD($idEquipment);
                }
                return true;
            }
            return true;
        }
        return false;
    }

    public function setRightCheckSHD(){
        if($this->setRightAllLikeFalse()){
            if(isset($this->checkbox)){
                foreach($this->checkbox as $value) {
                    $idEquipment = $value;
                    $this->addChangesSHD($idEquipment);
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
        $two = "Dach";

        $sql = 'UPDATE shd SET status =:status WHERE space = :one OR space = :two';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':one', $one, PDO::PARAM_STR);
        $stmt->bindValue(':two', $two, PDO::PARAM_STR);

        $stmt->execute();

        return true;
    }

    public function setLeftAllLikeFalse(){
        $status = "danger";
        $one = "Skrytka Lewa I";
        $two = "Skrytka Lewa II";

        $sql = 'UPDATE shd SET status =:status WHERE space = :one OR space = :two';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':one', $one, PDO::PARAM_STR);
        $stmt->bindValue(':two', $two, PDO::PARAM_STR);

        $stmt->execute();

        return true;
    }

    public function setRightAllLikeFalse(){
        $status = "danger";
        $one = "Skrytka Prawa I";
        $two = "Skrytka Prawa II";

        $sql = 'UPDATE shd SET status =:status WHERE space = :one OR space = :two';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':one', $one, PDO::PARAM_STR);
        $stmt->bindValue(':two', $two, PDO::PARAM_STR);

        $stmt->execute();

        return true;
    }

    //add changes
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

}

