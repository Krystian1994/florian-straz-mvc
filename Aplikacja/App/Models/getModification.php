<?php

namespace App\Models;

use PDO;
use \App\Token;

class getModification extends \Core\Model{
    public static function getLastModification($id){
        $sql = 'SELECT * FROM modification WHERE id = :id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':id', $id, PDO::PARAM_STR);

        $stmt->execute();
        $lastModification = $stmt->fetch();

        return $lastModification;
    }
    
}

