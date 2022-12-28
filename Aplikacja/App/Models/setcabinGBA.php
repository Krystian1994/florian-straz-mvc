<?php

namespace App\Models;

use PDO;
use \App\Token;

class setcabinGBA extends \Core\Model{

    public function __construct($data = []){
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    public function setCabinCheckGBA(){
        if($this->setCabinAllLikeFalse()){
            foreach($this->checkbox as $value) {
                $idEquipment = $value;
                $this->addChangesGBA($idEquipment);
            }
            return true;
        }
        return false;
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

    public function setCabinAllLikeFalse(){
        $status = "danger";
        $one = "Kabina";
        $two = "Bagażnik";

        $sql = 'UPDATE gba SET status =:status WHERE space = :one OR space = :two';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':one', $one, PDO::PARAM_STR);
        $stmt->bindValue(':two', $two, PDO::PARAM_STR);

        $stmt->execute();

        return true;
    }
}

