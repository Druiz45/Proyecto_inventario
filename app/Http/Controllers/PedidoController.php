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

    public function editar(){
        return view('editarPedido');
    }

    public function getDataFormUpdate(){
        return view('viewsModels/modelPedido/formUpdate');
    }

    public function update(){
        return view('viewCrud/pedido/update');
    }

}