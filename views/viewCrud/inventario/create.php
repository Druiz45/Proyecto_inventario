<?php

session_start();

use App\Http\Models\InventarioModel;

$inventario = new InventarioModel($_POST["stock"], $_POST["producto"]);

$inventario->validateData();

$inventario->create();

$inventario->updateEstateInventario();

?>