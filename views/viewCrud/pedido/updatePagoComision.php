<?php

session_start();

use App\Http\Models\PedidoModel;

$pedido = new PedidoModel();

$pedido->updatePagoComision($_POST["pedido"]);

?>