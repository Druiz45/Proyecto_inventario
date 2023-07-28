<?php

namespace App\Http\Controllers;
// use App\Http\Response;

class UsuarioController{

    public function registrar(){
        return view('registrarUsuario');
    }

    public function consultar(){
        return view('consultarUsuario');
    }

    public function dataFormRegistrar(){
        return view('viewsModels/modelFormRegistrar');
    }

    public function create(){
        return view('viewCrud/usuario/create');
    }

    public function dataFormUpdate(){
        return view('viewsModels/modelFormUpdate');
    }

    public function update(){
        return view('viewCrud/usuario/update');
    }

    public function logOut(){
        return view('viewsModels/modelLogOut');
    }

    public function getUsers(){
        return view('viewCrud/usuario/read');
    }

    public function perfil(){
        return view('perfil');
    }
}