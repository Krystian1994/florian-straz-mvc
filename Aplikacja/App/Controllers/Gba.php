<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;
use \App\Models\getGBA;
use \App\Models\getModification;
use \App\Models\setGBA;
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
        $categoriesRoofGba = getGBA::getRoofGBAcategories();

        $personI = getModification::getLastModification('1');
        $personII = getModification::getLastModification('2');
        $personIII = getModification::getLastModification('3');
        $personIV = getModification::getLastModification('4');

        $nameGBA = "GBA 2,5/24/4";

        View::renderTemplate('Equipment/equipment.html', [
            'user' => $this->user,
            'categoriesCabinGba' => $categoriesCabinGba,
            'categoriesLeftGba' => $categoriesLeftGba,
            'categoriesRightGba' => $categoriesRightGba,
            'categoriesRoofGba' => $categoriesRoofGba,
            'personI' => $personI,
            'personII' => $personII,
            'personIII' => $personIII,
            'personIV' => $personIV,
            'nameGBA' => $nameGBA
        ]);
    }

    public function cabingbaAction(){
        $setCabinGba = new setGBA($_POST);
        $setCabinMod = new setModification();

        
        if ($setCabinGba->setCabinCheckGBA()){
            if($setCabinMod->setLastModification($_POST['comment'],$_POST['usermod'],$_POST['idMod'])){
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
        $setLeftGba = new setGBA($_POST);
        $setLeftMod = new setModification();

        if ($setLeftGba->setLeftCheckGBA()){
            if($setLeftMod->setLastModification($_POST['comment'],$_POST['usermod'],$_POST['idMod'])){
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
        $setRightGba = new setGBA($_POST);
        $setRightMod = new setModification();

        if ($setRightGba->setRightCheckGBA()){
            if($setRightMod->setLastModification($_POST['comment'],$_POST['usermod'],$_POST['idMod'])){
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

    public function roofgbaAction(){
        $setRoofGba = new setGBA($_POST);
        $setRoofMod = new setModification();

        if ($setRoofGba->setRoofCheckGBA()){
            if($setRoofMod->setLastModification($_POST['comment'],$_POST['usermod'],$_POST['idMod'])){
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
