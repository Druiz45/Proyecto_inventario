<?php

namespace App\Http\Controllers;
// use App\Http\Response;

class CategoriaController{

    public function consultar(){
        // return new Response('public');
        return view('consultarCategoria');
    }

    public function update(){
        // return new Response('public');
        return view('viewCrud/categoria/update');
    }

}