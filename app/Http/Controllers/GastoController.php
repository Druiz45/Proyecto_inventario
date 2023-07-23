<?php

namespace App\Http\Controllers;
// use App\Http\Response;

class GastoController{

    public function registrar(){
        // return new Response('public');
        return view('registrarGasto');
    }

    public function consultar(){
        // return new Response('public');
        return view('consultarGasto');
    }

}