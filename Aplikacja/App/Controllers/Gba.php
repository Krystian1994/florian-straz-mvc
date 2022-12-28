<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;
use \App\Models\getGBA;
use \App\Models\getModification;

use \App\Models\setcabinGBA;
use \App\Models\setleftGBA;
use \App\Models\setrightGBA;
use \App\Models\setModification;

class Gba extends Authenticated{

    protected function before(){
        parent::before();
        $this->user = Auth::getUser();
    }

    public function gbaAction(){
        $categoriesCabinGba = getGBA::getCabinGBAcategories();
        $categoriesLeftGba = getGBA::getLeftGBAcategories();
        $categoriesRightGba = getGBA::getRightGBAcategories();

        $personI = getModification::getLastModification('1');
        $personII = getModification::getLastModification('2');
        $personIII = getModification::getLastModification('3');

        $nameGBA = "GBA 2,5/24/4";

        View::renderTemplate('Equipment/equipment.html', [
            'user' => $this->user,
            'categoriesCabinGba' => $categoriesCabinGba,
            'categoriesLeftGba' => $categoriesLeftGba,
            'categoriesRightGba' => $categoriesRightGba,
            'personI' => $personI,
            'personII' => $personII,
            'personIII' => $personIII,
            'nameGBA' => $nameGBA
        ]);
    }

    public function gbasetAction(){
        $setgba = new setcabinGBA($_POST);
        $setMod = new setModification();

        
        if ($setgba->setCabinCheckGBA()){
            if($setMod->setLastModification($_POST['comment'],$_POST['usermod'],$_POST['idMod'])){
                Flash::addMessage('Przejęte.', Flash::INFO);
            
                $this->redirect('/Gba/gba');
            } else {
                Flash::addMessage('Błąd.', Flash::WARNING);
            
                $this->redirect('/Gba/gba');
            }
            
        } else {
            Flash::addMessage('Pierwszy Błąd.', Flash::WARNING);
            
            $this->redirect('/Gba/gba');
        }
    }

    public function leftgbaAction(){
        $setgba = new setleftGBA($_POST);
        $setMod = new setModification();

        if ($setgba->setLeftCheckGBA()){
            if($setMod->setLastModification($_POST['comment'],$_POST['usermod'],$_POST['idMod'])){
                Flash::addMessage('Przejęte.', Flash::INFO);
            
                $this->redirect('/Gba/gba');
            } else {
                Flash::addMessage('Błąd.', Flash::WARNING);
            
                $this->redirect('/Gba/gba');
            }
            
        } else {
            Flash::addMessage('Pierwszy Błąd.', Flash::WARNING);
            
            $this->redirect('/Gba/gba');
        }

    }

    public function rightgbaAction(){
        $setgba = new setRightGBA($_POST);
        $setMod = new setModification();

        if ($setgba->setRightCheckGBA()){
            if($setMod->setLastModification($_POST['comment'],$_POST['usermod'],$_POST['idMod'])){
                Flash::addMessage('Przejęte.', Flash::INFO);
            
                $this->redirect('/Gba/gba');
            } else {
                Flash::addMessage('Błąd.', Flash::WARNING);
            
                $this->redirect('/Gba/gba');
            }
            
        } else {
            Flash::addMessage('Pierwszy Błąd.', Flash::WARNING);
            
            $this->redirect('/Gba/gba');
        }
    }
    
}
