<?php

namespace App\Http\Controllers;

class GastoController{

    public function registrar(){
        return view('registrarGasto');
    }

    public function consultar(){
        return view('consultarGasto');
    }

    public function editar(){
        return view('editarGasto');
    }

    public function dataFormCreate(){
        return view('viewsModels/modelGasto/formCreate');
    }

    public function dataFormUpdate(){
        return view('viewsModels/modelGasto/formUpdate');
    }

    public function create(){
        return view('viewCrud/gasto/create');
    }

    public function update(){
        return view('viewCrud/gasto/update');
    }

}