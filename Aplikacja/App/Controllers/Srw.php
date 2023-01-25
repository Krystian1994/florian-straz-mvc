<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;
use \App\Models\getSRW;
use \App\Models\getModification;
use \App\Models\setSRW;
use \App\Models\setModification;

class Srw extends Authenticated{

    protected function before(){
        parent::before();
        $this->user = Auth::getUser();
    }

    public function srwAction(){
        $categoriesCabinSrw = getSRW::getCabinSRWcategories();
        $categoriesLeftSrw = getSRW::getLeftSRWcategories();
        $categoriesRightSrw = getSRW::getRightSRWcategories();
        $categoriesRoofSrw = getSRW::getRoofSRWcategories();

        $personXII = getModification::getLastModification('12');
        $personXIII = getModification::getLastModification('13');
        $personXIV = getModification::getLastModification('14');
        $personXV = getModification::getLastModification('15');

        $nameSRW = "SRW Iveco";
        View::renderTemplate('Equipment/equipment.html', [
            'user' => $this->user,
            'categoriesCabinSrw' => $categoriesCabinSrw,
            'categoriesLeftSrw' => $categoriesLeftSrw,
            'categoriesRightSrw' => $categoriesRightSrw,
            'categoriesRoofSrw' => $categoriesRoofSrw,
            'personXII' => $personXII,
            'personXIII' => $personXIII,
            'personXIV' => $personXIV,
            'personXV' => $personXV,
            'nameSRW' => $nameSRW
        ]);
    }

    public function cabinsrwAction(){
        $setCabinSrw = new setSRW($_POST);
        $setCabinMod = new setModification();

        
        if ($setCabinSrw->setCabinCheckSRW()){
            if($setCabinMod->setLastModification($_POST['comment'],$_POST['usermod'],$_POST['idMod'])){
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

    public function leftsrwAction(){
        $setLeftSrw = new setSRW($_POST);
        $setLeftMod = new setModification();

        
        if ($setLeftSrw->setLeftCheckSRW()){
            if($setLeftMod->setLastModification($_POST['comment'],$_POST['usermod'],$_POST['idMod'])){
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
        $setRightSrw = new setSRW($_POST);

        $setRightMod = new setModification();

        
        if ($setRightSrw->setRightCheckSRW()){
            if($setRightMod->setLastModification($_POST['comment'],$_POST['usermod'],$_POST['idMod'])){
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

    public function roofsrwAction(){
        $setRoofSrw = new setSRW($_POST);

        $setRoofMod = new setModification();

        
        if ($setRoofSrw->setRoofCheckSRW()){
            if($setRoofMod->setLastModification($_POST['comment'],$_POST['usermod'],$_POST['idMod'])){
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
