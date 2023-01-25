<?php

namespace App\Models;

use PDO;
use \App\Token;

class getGBA extends \Core\Model{
    public static function getCabinGBAcategories(){
        $one = "Kabina";

        $sql = 'SELECT * FROM gba WHERE space = :one ORDER BY space, name';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':one', $one, PDO::PARAM_STR);

        $stmt->execute();
        $categoryOfCabinGBA = $stmt->fetchAll();

        return $categoryOfCabinGBA;
    }
    public static function getLeftGBAcategories(){
        $one = "Skrytka lewa I";
        $two = "Skrytka lewa II";
        $three = "Skrytka lewa III";

        $sql = 'SELECT * FROM gba WHERE space = :one OR space = :two OR space = :three ORDER BY space, name';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':one', $one, PDO::PARAM_STR);
        $stmt->bindValue(':two', $two, PDO::PARAM_STR);
        $stmt->bindValue(':three', $three, PDO::PARAM_STR);

        $stmt->execute();
        $categoryOfLeftGBA = $stmt->fetchAll();

        return $categoryOfLeftGBA;
    }
    public static function getRightGBAcategories(){
        $one = "Skrytka prawa I";
        $two = "Skrytka prawa II";
        $three = "Skrytka prawa III";

        $sql = 'SELECT * FROM gba WHERE space = :one OR space = :two OR space = :three ORDER BY space, name';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':one', $one, PDO::PARAM_STR);
        $stmt->bindValue(':two', $two, PDO::PARAM_STR);
        $stmt->bindValue(':three', $three, PDO::PARAM_STR);

        $stmt->execute();
        $categoryOfRightGBA = $stmt->fetchAll();

        return $categoryOfRightGBA;
    }

    public static function getRoofGBAcategories(){
        $two = "Bagażnik";
        $roof = "Dach";

        $sql = 'SELECT * FROM gba WHERE space = :two OR space = :roof ORDER BY space, name';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':two', $two, PDO::PARAM_STR);
        $stmt->bindValue(':roof', $roof, PDO::PARAM_STR);

        $stmt->execute();
        $categoryOfRoofGBA = $stmt->fetchAll();

        return $categoryOfRoofGBA;
    }
    
}

