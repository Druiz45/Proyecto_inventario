<?php

namespace App\Http\Controllers;
// use App\Http\Response;

class UsuarioController{

    public function registrar(){
        // return new Response('home');
        return view('registrarUsuario');
    }

    public function dataFormRegistar(){
        return view('viewsModels/modelFormRegistar');
    }

}