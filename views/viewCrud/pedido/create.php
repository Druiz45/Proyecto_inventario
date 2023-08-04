<?php

session_start();

use App\Http\Models\PedidoModel;

$pedido = new PedidoModel(
    isset($_POST["documento"]) ? $_POST["documento"]: "vacio",
    isset($_POST["nombreProducto"]) ? $_POST["nombreProducto"]: "vacio",
    isset($_POST['cliente']) ? $_POST['cliente'] : "", 
    isset($_POST['producto']) ? $_POST['producto'] : "",
    isset($_POST['abonoProducto']) ? $_POST['abonoProducto'] : "",
    isset($_POST['anotacion']) ? $_POST['anotacion'] : "",
    isset($_POST['fecha-limite']) ? $_POST['fecha-limite'] : "",
);

$pedido->validateData();

$pedido->savePedido();

?>