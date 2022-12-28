<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;
use \App\Models\getSLRR;
use \App\Models\getModification;

use \App\Models\setSLRR;
use \App\Models\setModification;

class Slrr extends Authenticated{

    protected function before(){
        parent::before();
        $this->user = Auth::getUser();
    }



    public function slrrAction(){
        $categoriesSlrr = getSLRR::getSLRRcategories();

        $personVIII = getModification::getLastModification('8');

        $nameSlrr = "SLRr Hilux";
        View::renderTemplate('Equipment/equipment.html', [
            'user' => $this->user,
            'categoriesSlrr' => $categoriesSlrr,
            'personVIII' => $personVIII,
            'nameSlrr' => $nameSlrr
        ]);
    }


    public function slrrsetAction(){
        $setslrr = new setSLRR($_POST);
        $setMod = new setModification();

        
        if ($setslrr->setCheckSLRR()){
            if($setMod->setLastModification($_POST['comment'],$_POST['usermod'],$_POST['idMod'])){
                Flash::addMessage('Przejęte.', Flash::INFO);
            
                $this->redirect('/Slrr/slrr');
            } else {
                Flash::addMessage('Błąd.', Flash::WARNING);
            
                $this->redirect('/Slrr/slrr');
            }
            
        } else {
            Flash::addMessage('Pierwszy Błąd.', Flash::WARNING);
            
            $this->redirect('/Slrr/slrr');
        }
    }
}
