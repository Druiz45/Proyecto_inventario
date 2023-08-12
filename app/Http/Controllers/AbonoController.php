<?php

namespace App\Http\Controllers;

class AbonoController{

    public function consultar(){
        return view('consultarAbonos');
    }

    public function abonarPedido(){
        return view('viewCrud/abono/createAbono');
    }

}

