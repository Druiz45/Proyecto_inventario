<?php

namespace App\Http\Controllers;

class AbonoController{

    public function consultar(){
        return view('consultarAbonos');
    }

    public function create(){
        return view('viewCrud/abono/create');
    }

}

