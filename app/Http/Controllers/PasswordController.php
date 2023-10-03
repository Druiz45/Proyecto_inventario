<?php

namespace App\Http\Controllers;
// use App\Http\Response;

class PasswordController{

    public function recover(){

        return view('recuperarPass'); 
    }

    public function change(){

        return view('cambiarPass');
    }

    public function recoverPassword(){

        return view('viewCrud/password/recoverPassword');
    }

}