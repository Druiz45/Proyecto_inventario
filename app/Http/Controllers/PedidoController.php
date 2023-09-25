<?php

namespace App\Http\Controllers;

class PedidoController{

    public function registrar(){
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

    public function cambiarEstado(){
        return view('viewCrud/pedido/updateEstado');
    }

    public function cambiarAprobacion(){
        return view('viewCrud/pedido/updateAprobacion');
    }

    public function pagarComision(){
        return view('viewCrud/pedido/updatePagoComision');
    }

}