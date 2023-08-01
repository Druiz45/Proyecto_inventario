<?php

use App\Http\Models\PedidoModel;

$pedido = new PedidoModel(
    isset($_POST["documento"]) ? $_POST["documento"]: "vacio",
    isset($_POST["nombreProducto"]) ? $_POST["nombreProducto"]: "vacio");

$pedido->getInfoFormCreate();

?>