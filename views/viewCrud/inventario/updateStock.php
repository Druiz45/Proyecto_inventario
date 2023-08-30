<?php

session_start();

use App\Http\Models\InventarioModel;

$inventario = new InventarioModel(0, $_POST['producto']);

$inventario->updateStock($_POST['ordenCompra']);