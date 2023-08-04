<?php

session_start();

use App\Http\Models\ProductoModel;

$usuario = new ProductoModel();

$usuario->actualizarEstadoProducto($_POST['estado'], $_POST['producto']);