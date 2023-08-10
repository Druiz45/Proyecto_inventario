<?php

session_start();

use App\Http\Models\PedidoModel;

$pedido = new PedidoModel();

$pedido->getPedido($_POST["pedido"]);

?>