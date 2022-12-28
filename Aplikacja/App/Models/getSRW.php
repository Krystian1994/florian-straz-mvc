<?php

namespace App\Models;

use PDO;
use \App\Token;

class getSRW extends \Core\Model{
    public static function getLeftSRWcategories(){
        $one = "Kabina";
        $two = "Podest lewy";
        $three = "Skrytka lewa I";
        $four = "Skrytka lewa II";

        $sql = 'SELECT * FROM srw WHERE space = :one OR space = :two OR space = :three OR space = :four';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':one', $one, PDO::PARAM_STR);
        $stmt->bindValue(':two', $two, PDO::PARAM_STR);
        $stmt->bindValue(':three', $three, PDO::PARAM_STR);
        $stmt->bindValue(':four', $four, PDO::PARAM_STR);

        $stmt->execute();
        $categoryLeftOfSRW = $stmt->fetchAll();

        return $categoryLeftOfSRW;
    }

    public static function getRightSRWcategories(){
        $one = "Dach";
        $two = "Skrytka prawa I";
        $three = "Skrytka prawa II";

        $sql = 'SELECT * FROM srw WHERE space = :one OR space = :two OR space = :three';

        $db = static::getDB();
        $stmt = $db->prepare($sql);

        $stmt->bindValue(':one', $one, PDO::PARAM_STR);
        $stmt->bindValue(':two', $two, PDO::PARAM_STR);
        $stmt->bindValue(':three', $three, PDO::PARAM_STR);

        $stmt->execute();
        $categoryRightOfSRW = $stmt->fetchAll();

        return $categoryRightOfSRW;
    }
    
}

