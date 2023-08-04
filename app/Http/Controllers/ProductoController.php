<?php

namespace App\Http\Controllers;
// use App\Http\Response;

class ProductoController{

    public function registrar(){
        // return new Response('home');
        return view('registrarProducto');
    }

    public function consultar(){
        return view('consultarProducto');
    }

    public function create(){
        return view('viewCrud/producto/create');
    }

    public function delete(){
        return view('viewCrud/producto/delete');
    }

    public function getCategorias(){
        return view('viewsModels/modelProducto/formCreate');
    }

     public function getProductos(){
        return view('viewCrud/producto/read');
    }


}