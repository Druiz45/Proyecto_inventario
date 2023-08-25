<?php

namespace App\Http\Controllers;

class GastoController{

    public function registrar(){
        return view('registrarGasto');
    }

    public function consultar(){
        return view('consultarGasto');
    }

    public function dataFormCreate(){
        return view('viewsModels/modelGasto/formCreate');
    }

    public function create(){
        return view('viewCrud/gasto/create');
    }

}