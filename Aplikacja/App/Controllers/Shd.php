<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;
use \App\Models\getSHD;
use \App\Models\getModification;

use \App\Models\setSHD;
use \App\Models\setModification;

class Shd extends Authenticated{

    protected function before(){
        parent::before();
        $this->user = Auth::getUser();
    }

    public function shdAction(){
        $categoriesShd = getSHD::getSHDcategories();

        $personV = getModification::getLastModification('5');

        $nameSHD = "SHD 23";
        View::renderTemplate('Equipment/equipment.html', [
            'user' => $this->user,
            'categoriesShd' => $categoriesShd,
            'personV' => $personV,
            'nameSHD' => $nameSHD
        ]);
    }

   
    public function shdsetAction(){
        $setshd = new setSHD($_POST);

        $setMod = new setModification();

        
        if ($setshd->setCheckSHD()){
            if($setMod->setLastModification($_POST['comment'],$_POST['usermod'],$_POST['idMod'])){
                Flash::addMessage('Przejęte.', Flash::INFO);
            
                $this->redirect('/Shd/shd');
            } else {
                Flash::addMessage('Błąd.', Flash::WARNING);
            
                $this->redirect('/Shd/shd');
            }
            
        } else {
            Flash::addMessage('Pierwszy Błąd.', Flash::WARNING);
            
            $this->redirect('/Shd/shd');
        }
    }
}
