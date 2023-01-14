<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;

class Profile extends Authenticated{

    protected function before(){
        parent::before();
        $this->user = Auth::getUser();
    }

    public function menuAction(){
        View::renderTemplate('Profile/menu.html', [
            'user' => $this->user
        ]);
    }

    public function editAction(){

        View::renderTemplate('Profile/edit.html', [
            'user' => $this->user
        ]);
    }

    public function updateAction(){
        if(isset($_POST['saveChanges'])){
            if ($this->user->updateProfile($_POST)){

                Flash::addMessage('Zapisano zmiany', Flash::INFO);
    
                $this->redirect('/profile/menu');
    
            }else{
    
                Flash::addMessage('Nie zapisano zmian',Flash::WARNING);
    
                View::renderTemplate('Profile/edit.html', [
                    'user' => $this->user
                ]);
            }     
        }
    }
}
