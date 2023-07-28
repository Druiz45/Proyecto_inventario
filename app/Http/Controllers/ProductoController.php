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

    public function create(){
        // return new Response('home');
        return view('viewCrud/producto/create');
    }

    public function getCategorias(){
        // return new Response('home');
        return view('viewsModels/modelCategoria');
    }

     public function getProductos(){
        // return new Response('home');
        return view('viewCrud/producto/read');
    }


}