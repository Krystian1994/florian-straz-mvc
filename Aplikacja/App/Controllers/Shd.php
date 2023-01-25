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
        $categoriesCabinShd = getSHD::getCabinSHDcategories();
        $categoriesLeftShd = getSHD::getLeftSHDcategories();
        $categoriesRightShd = getSHD::getRightSHDcategories();

        $personIX = getModification::getLastModification('9');
        $personX = getModification::getLastModification('10');
        $personXI = getModification::getLastModification('11');

        $nameSHD = "SHD 23";
        View::renderTemplate('Equipment/equipment.html', [
            'user' => $this->user,
            'categoriesCabinShd' => $categoriesCabinShd,
            'categoriesLeftShd' => $categoriesLeftShd,
            'categoriesRightShd' => $categoriesRightShd,
            'personIX' => $personIX,
            'personX' => $personX,
            'personXI' => $personXI,
            'nameSHD' => $nameSHD
        ]);
    }

   
    public function cabinshdAction(){
        $setCabinShd = new setSHD($_POST);
        $setCabinMod = new setModification();
        
        if ($setCabinShd->setCabinCheckSHD()){
            if($setCabinMod->setLastModification($_POST['comment'],$_POST['usermod'],$_POST['idMod'])){
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

    public function leftshdAction(){
        $setLeftShd = new setSHD($_POST);
        $setLeftMod = new setModification();
        
        if ($setLeftShd->setLeftCheckSHD()){
            if($setLeftMod->setLastModification($_POST['comment'],$_POST['usermod'],$_POST['idMod'])){
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

    public function rightshdAction(){
        $setRightShd = new setSHD($_POST);
        $setRightMod = new setModification();
        
        if ($setRightShd->setRightCheckSHD()){
            if($setRightMod->setLastModification($_POST['comment'],$_POST['usermod'],$_POST['idMod'])){
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
