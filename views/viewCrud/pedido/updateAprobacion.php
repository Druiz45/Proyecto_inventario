<?php

session_start();

use App\Http\Models\PedidoModel;

$pedido = new PedidoModel();

$pedido->validateDataEstado($_POST["aprobacion"], $_POST["pedido"]);

$pedido->updateAprobacion($_POST["aprobacion"], $_POST["pedido"]);

?>