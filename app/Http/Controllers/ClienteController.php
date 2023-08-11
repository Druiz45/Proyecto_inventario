<?php

namespace App\Http\Controllers;

class ClienteController{

    public function registrar(){
        return view('registrarCliente');
    }

    public function create(){
        return view('viewCrud/cliente/create');
    }

}