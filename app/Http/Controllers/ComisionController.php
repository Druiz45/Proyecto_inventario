<?php

namespace App\Http\Controllers;
// use App\Http\Response;

class ComisionController{

    public function consultar(){
        // return new Response('public');
        return view('consultarComision');
    }

}