<?php

namespace App\Models;

use PDO;
use \App\Token;

class getSRW extends \Core\Model{
    public static function getCabinSRWcategories(){
        $one = "Kabina";

        $sql = 'SELECT * FROM srw WHERE space = :one ORDER BY space, name';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':one', $one, PDO::PARAM_STR);

        $stmt->execute();
        $categoryCabinOfSRW = $stmt->fetchAll();

        return $categoryCabinOfSRW;
    }

    public static function getLeftSRWcategories(){
        $two = "Podest lewy";
        $three = "Skrytka lewa I";
        $four = "Skrytka lewa II";

        $sql = 'SELECT * FROM srw WHERE space = :two OR space = :three OR space = :four ORDER BY space, name';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':two', $two, PDO::PARAM_STR);
        $stmt->bindValue(':three', $three, PDO::PARAM_STR);
        $stmt->bindValue(':four', $four, PDO::PARAM_STR);

        $stmt->execute();
        $categoryLeftOfSRW = $stmt->fetchAll();

        return $categoryLeftOfSRW;
    }

    public static function getRightSRWcategories(){
        $two = "Skrytka prawa I";
        $three = "Skrytka prawa II";

        $sql = 'SELECT * FROM srw WHERE space = :two OR space = :three ORDER BY space, name';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':two', $two, PDO::PARAM_STR);
        $stmt->bindValue(':three', $three, PDO::PARAM_STR);

        $stmt->execute();
        $categoryRightOfSRW = $stmt->fetchAll();

        return $categoryRightOfSRW;
    }

    public static function getRoofSRWcategories(){
        $one = "Dach";

        $sql = 'SELECT * FROM srw WHERE space = :one ORDER BY space, name';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':one', $one, PDO::PARAM_STR);

        $stmt->execute();
        $categoryRoofOfSRW = $stmt->fetchAll();

        return $categoryRoofOfSRW;
    }
    
}

