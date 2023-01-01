<?php

namespace App\Models;

use PDO;
use \App\Token;

class getGCBA extends \Core\Model{
    public static function getGCBAcategories(){
        $sql = 'SELECT * FROM gcba ORDER BY space';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $categoryOfGCBA = $stmt->fetchAll();

        return $categoryOfGCBA;
    }
}

