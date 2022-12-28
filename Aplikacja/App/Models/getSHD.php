<?php

namespace App\Models;

use PDO;
use \App\Token;

class getSHD extends \Core\Model{
    public static function getSHDcategories(){
        $sql = 'SELECT * FROM shd';

        $db = static::getDB();
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $categoryOfSHD = $stmt->fetchAll();

        return $categoryOfSHD;
    }
}

