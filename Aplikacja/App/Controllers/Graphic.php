<?php

namespace App\Controllers;

use \Core\View;
use \App\Auth;
use \App\Flash;

class Graphic extends Authenticated{
    protected function before(){
        parent::before();
        $this->user = Auth::getUser();
    }

    public function newAction(){
        $graphicI = "https://docs.google.com/spreadsheets/d/e/2PACX-1vTzDnCtufCnJshjg0OYkc2xUmzw_KfPe-TlYX0A7ovtqpvumNj5AO_uBc3gD0a1uQ/pubhtml?widget=true&amp;headers=false";

        $graphicII = "https://docs.google.com/spreadsheets/d/e/2PACX-1vRF1eoqS8nZHi0IfHEt6I8SdrKkp0Be64MXJye_uqhTr7SBGiGD0iIynJD9-XwWlg/pubhtml?widget=true&amp;headers=false";

        $graphicIII = "https://docs.google.com/spreadsheets/d/e/2PACX-1vR5cqHG96NmpzMYRpRJlebSD67YDe0n5yrcf_x_zbQtCkg9NOt_evxVQO8Z95E6_Q/pubhtml?widget=true&amp;headers=false";

        View::renderTemplate('Graphic/graphic.html', [
            'user' => $this->user,
            'graphicI' => $graphicI,
            'graphicII' => $graphicII,
            'graphicIII' => $graphicIII
        ]);
    }
}
