<?php

namespace App\Http\Controllers;

class ClienteController{

    public function registrar(){
        return view('registrarCliente');
    }

    public function create(){
        return view('viewCrud/cliente/create');
    }

    public function consultar(){
        return view('consultarClientes');
    }

    public function delete(){
        return view('viewCrud/cliente/delete');
    }

}