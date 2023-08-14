<?php

session_start();

use App\Http\Models\PedidoModel;

$pedido = new PedidoModel();

$pedido->validateDataEstado($_POST["estado"], $_POST["pedido"]);

$pedido->updateEstado($_POST["estado"], $_POST["pedido"]);

?>