<?php

namespace App\Http\Controllers;

class CompraController
{

    public function registrar()
    {
        return view('registrarCompra');
    }

    public function getDataFormRegistrar()
    {
        return view('viewsModels/modelCompra/formCreate');
    }

    public function create()
    {
        return view('viewCrud/compra/create');
    }

    public function update()
    {
        return view('viewCrud/compra/update');
    }

    public function consultar()
    {
        return view('consultarCompra');
    }

    public function resumen()
    {
        return view('resumenCompra');
    }

    public function updateEstate()
    {
        return view('viewCrud/compra/updateEstado');
    }

    // public function edit(){
    //     return view('editarCompra');
    // }

    public function edit()
    {
        return view('editarOrdenCompra');
    }

    public function getDataFormUpdate()
    {
        return view('viewsModels/modelCompra/formUpdate');
    }
}
