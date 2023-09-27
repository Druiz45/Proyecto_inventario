<?php

namespace App\Http\Controllers;

class IngresoController{

    public function registrar(){
        return view('registrarIngreso');
    }

    public function consultar(){
        return view('consultarIngreso');
    }

    public function editar(){
        return view('editarIngreso');
    }

    public function dataFormCreate(){
        return view('viewsModels/modelIngreso/formCreate');
    }

    public function dataFormUpdate(){
        return view('viewsModels/modelIngreso/formUpdate');
    }

    public function create(){
        return view('viewCrud/ingreso/create');
    }

    public function update(){
        return view('viewCrud/ingreso/update');
    }

}