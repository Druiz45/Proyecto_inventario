<?php

namespace App\Http\Controllers;

class CompraController{

    public function registrar(){
        return view('registrarCompra');
    }

    public function getDataFormRegistrar(){
        return view('viewsModels/modelCompra/formCreate');
    }

    public function create(){
        return view('viewCrud/compra/create');
    }

}