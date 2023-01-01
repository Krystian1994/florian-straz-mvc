<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;

use \App\Models\setEdit;

class Edit extends Authenticated{

    protected function before(){
        parent::before();
        $this->user = Auth::getUser();
    }

    public function editAction(){
        
        $setMod = new setEdit($_POST);

        if($_POST['engine'] == 'gba'){
            if ($setMod->addEquipmentGBA()){
                Flash::addMessage('Wyposażenie zostało dodane.', Flash::INFO);
            
                View::renderTemplate('Profile/edit.html', [
                    'user' => $this->user
                ]);
               
            } else {
                Flash::addMessage('Błąd.', Flash::WARNING);
                
                View::renderTemplate('Profile/edit.html', [
                    'user' => $this->user
                ]);
            }
        }

        if($_POST['engine'] == 'gcba'){
            if ($setMod->addEquipmentGCBA()){
                Flash::addMessage('Wyposażenie zostało dodane.', Flash::INFO);
            
                View::renderTemplate('Profile/edit.html', [
                    'user' => $this->user
                ]);
               
            } else {
                Flash::addMessage('Błąd.', Flash::WARNING);
                
                View::renderTemplate('Profile/edit.html', [
                    'user' => $this->user
                ]);
            }
        }

        if($_POST['engine'] == 'shd'){
            if ($setMod->addEquipmentSHD()){
                Flash::addMessage('Wyposażenie zostało dodane.', Flash::INFO);
            
                View::renderTemplate('Profile/edit.html', [
                    'user' => $this->user
                ]);
               
            } else {
                Flash::addMessage('Błąd.', Flash::WARNING);
                
                View::renderTemplate('Profile/edit.html', [
                    'user' => $this->user
                ]);
            }
        }

        if($_POST['engine'] == 'srw'){
            if ($setMod->addEquipmentSRW()){
                Flash::addMessage('Wyposażenie zostało dodane.', Flash::INFO);
            
                View::renderTemplate('Profile/edit.html', [
                    'user' => $this->user
                ]);
               
            } else {
                Flash::addMessage('Błąd.', Flash::WARNING);
                
                View::renderTemplate('Profile/edit.html', [
                    'user' => $this->user
                ]);
            }
        }
        
        if($_POST['engine'] == 'slrr'){
            if ($setMod->addEquipmentSLRR()){
                Flash::addMessage('Wyposażenie zostało dodane.', Flash::INFO);
            
                View::renderTemplate('Profile/edit.html', [
                    'user' => $this->user
                ]);
               
            } else {
                Flash::addMessage('Błąd.', Flash::WARNING);
                
                View::renderTemplate('Profile/edit.html', [
                    'user' => $this->user
                ]);
            }
        }  
    }
}
