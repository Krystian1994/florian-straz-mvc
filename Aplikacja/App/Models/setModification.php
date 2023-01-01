<?php

namespace App\Models;

use PDO;
use \App\Token;

class setModification extends \Core\Model{
    public function __construct($data = []){
        foreach ($data as $key => $value) {
            $this->$key = $value;
        };
    }

    public static function setLastModification($comment, $user, $id){
        $comment = htmlentities($comment,ENT_QUOTES,"UTF-8");

        $date = date("Y-m-d"); 
        
        $sql = 'UPDATE modification SET comment = :comment, user = :user, date = :date WHERE id = :id';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
        $stmt->bindValue(':user', $user, PDO::PARAM_STR);
        $stmt->bindValue(':date', $date, PDO::PARAM_STR);
        $stmt->bindValue(':id', $id, PDO::PARAM_STR);

        $stmt->execute();
        
        return true;
    }
}

