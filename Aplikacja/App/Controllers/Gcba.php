<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;
use \App\Models\getGCBA;
use \App\Models\getModification;
use \App\Models\setGCBA;
use \App\Models\setModification;

class Gcba extends Authenticated{

    protected function before(){
        parent::before();
        $this->user = Auth::getUser();
    }



    public function gcbaAction(){
        $categoriesCabinGcba = getGCBA::getCabinGCBAcategories();
        $categoriesLeftGcba = getGCBA::getLeftGCBAcategories();
        $categoriesRightGcba = getGCBA::getRightGCBAcategories();
        $categoriesRoofGcba = getGCBA::getRoofGCBAcategories();

        $personV = getModification::getLastModification('5');
        $personVI = getModification::getLastModification('6');
        $personVII = getModification::getLastModification('7');
        $personVIII = getModification::getLastModification('8');

        $nameGCBA = "GCBA 5/32";
        View::renderTemplate('Equipment/equipment.html', [
            'user' => $this->user,
            'categoriesCabinGcba' => $categoriesCabinGcba,
            'categoriesLeftGcba' => $categoriesLeftGcba,
            'categoriesRightGcba' => $categoriesRightGcba,
            'categoriesRoofGcba' => $categoriesRoofGcba,
            'personV' => $personV,
            'personVI' => $personVI,
            'personVII' => $personVII,
            'personVIII' => $personVIII,
            'nameGCBA' => $nameGCBA
        ]);
    }
   
    public function cabingcbaAction(){
        $setCabinGcba = new setGCBA($_POST);
        $setCabinMod = new setModification();

        
        if ($setCabinGcba->setCabinCheckGCBA()){
            if($setCabinMod->setLastModification($_POST['comment'],$_POST['usermod'],$_POST['idMod'])){
                Flash::addMessage('Przejęte.', Flash::INFO);
            
                $this->redirect('/Gcba/gcba');
            } else {
                Flash::addMessage('Błąd.', Flash::WARNING);
            
                $this->redirect('/Gcba/gcba');
            }
            
        } else {
            Flash::addMessage('Pierwszy Błąd.', Flash::WARNING);
            
            $this->redirect('/Gcba/gcba');
        }
    }

    public function leftgcbaAction(){
        $setLeftGcba = new setGCBA($_POST);
        $setLeftMod = new setModification();

        if ($setLeftGcba->setLeftCheckGCBA()){
            if($setLeftMod->setLastModification($_POST['comment'],$_POST['usermod'],$_POST['idMod'])){
                Flash::addMessage('Przejęte.', Flash::INFO);
            
                $this->redirect('/Gcba/gcba');
            } else {
                Flash::addMessage('Błąd.', Flash::WARNING);
            
                $this->redirect('/Gcba/gcba');
            }
            
        } else {
            Flash::addMessage('Pierwszy Błąd.', Flash::WARNING);
            
            $this->redirect('/Gcba/gcba');
        }

    }

    public function rightgcbaAction(){
        $setRightGcba = new setGCBA($_POST);
        $setRightMod = new setModification();

        if ($setRightGcba->setRightCheckGCBA()){
            if($setRightMod->setLastModification($_POST['comment'],$_POST['usermod'],$_POST['idMod'])){
                Flash::addMessage('Przejęte.', Flash::INFO);
            
                $this->redirect('/Gcba/gcba');
            } else {
                Flash::addMessage('Błąd.', Flash::WARNING);
            
                $this->redirect('/Gcba/gcba');
            }
            
        } else {
            Flash::addMessage('Pierwszy Błąd.', Flash::WARNING);
            
            $this->redirect('/Gcba/gcba');
        }
    }

    public function roofgcbaAction(){
        $setRoofGcba = new setGCBA($_POST);
        $setRoofMod = new setModification();

        if ($setRoofGcba->setRoofCheckGCBA()){
            if($setRoofMod->setLastModification($_POST['comment'],$_POST['usermod'],$_POST['idMod'])){
                Flash::addMessage('Przejęte.', Flash::INFO);
            
                $this->redirect('/Gcba/gcba');
            } else {
                Flash::addMessage('Błąd.', Flash::WARNING);
            
                $this->redirect('/Gcba/gcba');
            }
            
        } else {
            Flash::addMessage('Pierwszy Błąd.', Flash::WARNING);
            
            $this->redirect('/Gcba/gcba');
        }
    }
}
