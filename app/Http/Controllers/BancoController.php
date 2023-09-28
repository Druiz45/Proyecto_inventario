<?php

namespace App\Http\Controllers;

class BancoController{

    public function consultar(){
        return view('consultarBancos');
    }

    public function create(){
        return view('viewCrud/banco/create');
    }

    public function update(){
        return view('viewCrud/banco/update');
    }

    public function updateEstate(){
        return view('viewCrud/banco/updateEstate');
    }

    public function getDataFormCreate(){
        return view('viewsModels/modelBanco/formCreate');
    }

}