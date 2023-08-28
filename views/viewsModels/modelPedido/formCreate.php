<?php

use App\Http\Models\PedidoModel;

$pedido = new PedidoModel(
    isset($_POST["docCliente"]) ? $_POST["docCliente"]: "vacio",
    isset($_POST["nombreProducto"]) ? $_POST["nombreProducto"]: "vacio",
);

$pedido->getInfoFormCreate();

?>