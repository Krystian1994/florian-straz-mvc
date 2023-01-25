<?php

namespace App\Models;

use PDO;
use \App\Token;

class getGCBA extends \Core\Model{

    public static function getCabinGCBAcategories(){
        $one = "Kabina";

        $sql = 'SELECT * FROM gcba WHERE space = :one ORDER BY space, name';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':one', $one, PDO::PARAM_STR);

        $stmt->execute();
        $categoryOfCabinGCBA = $stmt->fetchAll();

        return $categoryOfCabinGCBA;
    }

    public static function getLeftGCBAcategories(){
        $one = "Skrytka lewa I";
        $two = "Skrytka lewa II";
        $three = "Skrytka lewa III";
        $four = "Skrytka lewa IV";

        $sql = 'SELECT * FROM gcba WHERE space = :one OR space = :two OR space = :three OR space = :four ORDER BY space, name';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':one', $one, PDO::PARAM_STR);
        $stmt->bindValue(':two', $two, PDO::PARAM_STR);
        $stmt->bindValue(':three', $three, PDO::PARAM_STR);
        $stmt->bindValue(':four', $four, PDO::PARAM_STR);

        $stmt->execute();
        $categoryOfLeftGCBA = $stmt->fetchAll();

        return $categoryOfLeftGCBA;
    }

    public static function getRightGCBAcategories(){
        $one = "Skrytka prawa I";
        $two = "Skrytka prawa II";
        $three = "Skrytka prawa III";
        $four = "Skrytka prawa IV";

        $sql = 'SELECT * FROM gcba WHERE space = :one OR space = :two OR space = :three OR space = :four ORDER BY space, name';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':one', $one, PDO::PARAM_STR);
        $stmt->bindValue(':two', $two, PDO::PARAM_STR);
        $stmt->bindValue(':three', $three, PDO::PARAM_STR);
        $stmt->bindValue(':four', $four, PDO::PARAM_STR);

        $stmt->execute();
        $categoryOfRightGCBA = $stmt->fetchAll();

        return $categoryOfRightGCBA;
    }

    public static function getRoofGCBAcategories(){
        $two = "Bagażnik";
        $roof = "Dach";

        $sql = 'SELECT * FROM gcba WHERE space = :two OR space = :roof ORDER BY space, name';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':two', $two, PDO::PARAM_STR);
        $stmt->bindValue(':roof', $roof, PDO::PARAM_STR);

        $stmt->execute();
        $categoryOfRoofGCBA = $stmt->fetchAll();

        return $categoryOfRoofGCBA;
    }

}

