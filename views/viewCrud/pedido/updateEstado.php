<?php

session_start();

use App\Http\Models\PedidoModel;

$pedido = new PedidoModel();

$pedido->updateEstado($_POST["estado"], $_POST["pedido"]);

?>