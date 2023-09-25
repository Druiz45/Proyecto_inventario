<?php

session_start();

use App\Http\Models\PedidoModel;

$pedido = new PedidoModel(
    isset($_POST["documento"]) ? $_POST["documento"]: "vacio",
    isset($_POST["nombreProducto"]) ? $_POST["nombreProducto"]: "vacio",
    isset($_POST['cliente']) ? $_POST['cliente'] : "", 
    isset($_POST['producto']) ? $_POST['producto'] : "",
    isset($_POST['abonoProducto']) ? $_POST['abonoProducto'] : 1,
    isset($_POST['anotacion']) ? $_POST['anotacion'] : "",
    isset($_POST['fecha-limite']) ? $_POST['fecha-limite'] : "",
    isset($_POST['pedido']) ? $_POST['pedido'] : "",
    isset($_POST['banco']) ? $_POST['banco'] : "",
);

$pedido->validateData();

$pedido->updatePedido();

?>