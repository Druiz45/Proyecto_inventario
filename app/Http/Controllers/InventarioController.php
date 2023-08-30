<?php

namespace App\Http\Controllers;

class InventarioController{

    public function consultar(){
        return view('consultarInventario');
    }

    public function create(){
        return view('viewCrud/inventario/create');
    }

    public function update(){
        return view('viewCrud/inventario/update');
    }

    public function agregarAStock(){
        return view('viewCrud/inventario/updateStock');
    }


}