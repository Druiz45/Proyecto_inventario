<?php

session_start();

use App\Http\Models\PedidoModel;
use App\Http\Models\InventarioModel;

$pedido = new PedidoModel();

$inventario = new InventarioModel(null, isset($_POST['producto']) ? $_POST['producto'] : "");

$pedido->validateDataEstado($_POST["estado"], $_POST["pedido"]);

$pedido->updateEstado($_POST["estado"], $_POST["pedido"], $inventario);

?>