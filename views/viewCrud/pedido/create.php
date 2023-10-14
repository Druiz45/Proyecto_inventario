<?php

session_start();

use App\Http\Models\PedidoModel;

$pedido = new PedidoModel(
    isset($_POST["remision"]) ? $_POST["remision"]: "",
    isset($_POST["orden"]) ? $_POST["orden"]: "",
    isset($_POST['pedido']) ? $_POST['pedido'] : "", 
    isset($_POST['factura']) ? $_POST['factura'] : "",
    isset($_POST['fecha']) ? $_POST['fecha'] : "",
    isset($_POST['actaEntrega']) ? $_POST['actaEntrega'] : "",
    isset($_POST['nombreCliente']) ? $_POST['nombreCliente'] : "",
    isset($_POST["doc"]) ? $_POST["doc"]: "",
    isset($_POST['direccion']) ? $_POST['direccion'] : "", 
    isset($_POST['telefono']) ? $_POST['telefono'] : "",
    isset($_POST['ciudad']) ? $_POST['ciudad'] : "",
    isset($_POST["celular"]) ? $_POST["celular"]: "",
    isset($_POST['email']) ? $_POST['email'] : "", 
    isset($_POST['codigoVendedor']) ? $_POST['codigoVendedor'] : "",
    isset($_POST['anotacion']) ? $_POST['anotacion'] : "",
);

$pedido->validateData();

$pedido->savePedido();

?>