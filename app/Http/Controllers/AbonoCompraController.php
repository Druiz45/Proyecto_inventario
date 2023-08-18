<?php

namespace App\Http\Controllers;

class AbonoCompraController{

    public function create(){
        return view('viewCrud/abonoCompra/create');
    }

    public function consultar(){
        return view('consultarAbonosCompra');
    }

}