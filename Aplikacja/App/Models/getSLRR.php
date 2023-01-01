<?php

namespace App\Models;

use PDO;
use \App\Token;

class getSLRR extends \Core\Model{
    public static function getSLRRcategories(){
        $sql = 'SELECT * FROM slrr ORDER BY space';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $categoryOfSLRR = $stmt->fetchAll();

        return $categoryOfSLRR;
    }
}

