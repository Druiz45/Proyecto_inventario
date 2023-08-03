<?php

namespace App\Http\Controllers;
// use App\Http\Response;

class PedidoController{

    public function registrar(){
        // return new Response('home');
        return view('registrarPedido');
    }

    public function getDataFormRegistrar(){
        return view('viewsModels/modelPedido/formCreate');
    }

    public function create(){
        return view('viewCrud/pedido/create');
    }

    public function consultar(){
        return view('consultarPedido');
    }

}