<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;
use \App\Models\getSRW;
use \App\Models\getModification;

use \App\Models\setleftSRW;
use \App\Models\setrightSRW;
use \App\Models\setModification;

class Srw extends Authenticated{

    protected function before(){
        parent::before();
        $this->user = Auth::getUser();
    }

    public function srwAction(){
        $categoriesLeftSrw = getSRW::getLeftSRWcategories();
        $categoriesRightSrw = getSRW::getRightSRWcategories();

        $personVI = getModification::getLastModification('6');
        $personVII = getModification::getLastModification('7');

        $nameSRW = "SRW Iveco";
        View::renderTemplate('Equipment/equipment.html', [
            'user' => $this->user,
            'categoriesLeftSrw' => $categoriesLeftSrw,
            'categoriesRightSrw' => $categoriesRightSrw,
            'personVI' => $personVI,
            'personVII' => $personVII,
            'nameSRW' => $nameSRW
        ]);
    }

   
    public function leftsrwAction(){
        $setsrw = new setleftSRW($_POST);

        $setMod = new setModification();

        
        if ($setsrw->setLeftCheckSRW()){
            if($setMod->setLastModification($_POST['comment'],$_POST['usermod'],$_POST['idMod'])){
                Flash::addMessage('Przejęte.', Flash::INFO);
            
                $this->redirect('/Srw/srw');
            } else {
                Flash::addMessage('Błąd.', Flash::WARNING);
            
                $this->redirect('/Srw/srw');
            }
            
        } else {
            Flash::addMessage('Pierwszy Błąd.', Flash::WARNING);
            
            $this->redirect('/Srw/srw');
        }
    }

    public function rightsrwAction(){
        $setsrw = new setrightSRW($_POST);

        $setMod = new setModification();

        
        if ($setsrw->setRightCheckSRW()){
            if($setMod->setLastModification($_POST['comment'],$_POST['usermod'],$_POST['idMod'])){
                Flash::addMessage('Przejęte.', Flash::INFO);
            
                $this->redirect('/Srw/srw');
            } else {
                Flash::addMessage('Błąd.', Flash::WARNING);
            
                $this->redirect('/Srw/srw');
            }
            
        } else {
            Flash::addMessage('Pierwszy Błąd.', Flash::WARNING);
            
            $this->redirect('/Srw/srw');
        }
    }
}
