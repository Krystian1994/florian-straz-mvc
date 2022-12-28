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
        $categoriesGcba = getGCBA::getGCBAcategories();

        $personIV = getModification::getLastModification('4');

        $nameGCBA = "GCBA 5/32";
        View::renderTemplate('Equipment/equipment.html', [
            'user' => $this->user,
            'categoriesGcba' => $categoriesGcba,
            'personIV' => $personIV,
            'nameGCBA' => $nameGCBA
        ]);
    }
   
    public function gcbasetAction(){
        $setgcba = new setGCBA($_POST);
        $setMod = new setModification();

        
        if ($setgcba->setCheckGCBA()){
            if($setMod->setLastModification($_POST['comment'],$_POST['usermod'],$_POST['idMod'])){
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
