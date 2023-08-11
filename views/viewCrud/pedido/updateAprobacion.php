<?php

session_start();

use App\Http\Models\PedidoModel;

$pedido = new PedidoModel();

$pedido->updateAprobacion($_POST["aprobacion"], $_POST["pedido"]);

?>