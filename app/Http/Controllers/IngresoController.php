<?php

namespace App\Http\Controllers;

class IngresoController{

    public function registrar(){
        return view('registrarIngreso');
    }

    public function consultar(){
        return view('consultarIngreso');
    }

    public function dataFormCreate(){
        return view('viewsModels/modelIngreso/formCreate');
    }

    public function create(){
        return view('viewCrud/ingreso/create');
    }

}