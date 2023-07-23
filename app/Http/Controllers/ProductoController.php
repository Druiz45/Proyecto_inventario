<?php

namespace App\Http\Controllers;
// use App\Http\Response;

class ProductoController{

    public function registrar(){
        // return new Response('home');
        return view('registrarProducto');
    }

    public function consultar(){
        // return new Response('home');
        return view('consultarProducto');
    }

}