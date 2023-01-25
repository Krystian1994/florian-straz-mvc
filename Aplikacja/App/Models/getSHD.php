<?php

namespace App\Models;

use PDO;
use \App\Token;

class getSHD extends \Core\Model{
  
    public static function getCabinSHDcategories(){
        $one = "Kabina";
        $roof = "Dach";

        $sql = 'SELECT * FROM shd WHERE space = :one OR space = :roof ORDER BY space, name';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':one', $one, PDO::PARAM_STR);
        $stmt->bindValue(':roof', $roof, PDO::PARAM_STR);

        $stmt->execute();
        $categoryOfCabinSHD = $stmt->fetchAll();

        return $categoryOfCabinSHD;
    }

    public static function getLeftSHDcategories(){
        $one = "Skrytka lewa I";
        $two = "Skrytka lewa II";

        $sql = 'SELECT * FROM shd WHERE space = :one OR space = :two ORDER BY space, name';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':one', $one, PDO::PARAM_STR);
        $stmt->bindValue(':two', $two, PDO::PARAM_STR);

        $stmt->execute();
        $categoryOfLeftSHD = $stmt->fetchAll();

        return $categoryOfLeftSHD;
    }

    public static function getRightSHDcategories(){
        $one = "Skrytka prawa I";
        $two = "Skrytka prawa II";

        $sql = 'SELECT * FROM shd WHERE space = :one OR space = :two ORDER BY space, name';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':one', $one, PDO::PARAM_STR);
        $stmt->bindValue(':two', $two, PDO::PARAM_STR);

        $stmt->execute();
        $categoryOfRightSHD = $stmt->fetchAll();

        return $categoryOfRightSHD;
    }
}

