<?php

namespace App\Http\Controllers;
// use App\Http\Response;

class UsuarioController{

    public function registrar(){
        return view('registrarUsuario');
    }

    public function dataFormRegistrar(){
        return view('viewsModels/modelFormRegistrar');
    }

}