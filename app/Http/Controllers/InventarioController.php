<?php

namespace App\Http\Controllers;

class InventarioController{

    public function consultar(){
        return view('consultarInventario');
    }

    public function create(){
        return view('viewCrud/inventario/create');
    }


}