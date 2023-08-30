<?php

session_start();

use App\Http\Models\InventarioModel;

$inventario = new InventarioModel();

$inventario->update($_POST['stockProducto'], $_POST['numStock']);