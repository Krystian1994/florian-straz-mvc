<?php

namespace App\Controllers;

use \Core\View;
use \App\DateValidator;
use \App\Auth;
use \App\Flash;

class Education extends Authenticated
{

    protected function before(){
        parent::before();
        $this->user = Auth::getUser();
    }

    public function newAction(){
        View::renderTemplate('Education/education.html', [
            'user' => $this->user
        ]);
    }
}
