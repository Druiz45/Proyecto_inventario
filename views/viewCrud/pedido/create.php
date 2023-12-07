<?php

session_start();

use App\Http\Models\PedidoModel;

$pedido = new PedidoModel(
    isset($_POST["remision"]) ? $_POST["remision"]: "",
    isset($_POST["orden"]) ? $_POST["orden"]: "",
    isset($_POST['pedido']) ? $_POST['pedido'] : "", 
    isset($_POST['factura']) ? $_POST['factura'] : "",
    isset($_POST['fecha']) ? $_POST['fecha'] : "",
    isset($_POST['fechaEntrega']) ? $_POST['fechaEntrega'] : "",
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
    isset($_POST['stock']) ? $_POST['stock'] : "",
    isset($_POST['almacen']) ? $_POST['almacen'] : "",
    isset($_POST['fabrica']) ? $_POST['fabrica'] : "",
    isset($_POST['bandeja']) ? $_POST['bandeja'] : "",
    isset($_POST['braker']) ? $_POST['braker'] : "",
    isset($_POST['otros']) ? $_POST['otros'] : "",
    isset($_POST['efectivo']) ? $_POST['efectivo'] : "",
    isset($_POST['cheque']) ? $_POST['cheque'] : "",
    isset($_POST['iva']) ? $_POST['iva'] : "",
    isset($_POST['total']) ? $_POST['total'] : "",
    isset($_POST['banco']) ? $_POST['banco'] : "",
    isset($_POST['abono']) ? $_POST['abono'] : "",
    isset($_POST['saldo']) ? $_POST['saldo'] : "",
    isset($_POST['vendedor']) ? $_POST['vendedor'] : "",
    isset($_POST['autorizo']) ? $_POST['autorizo'] : "",
    isset($_POST['verifico']) ? $_POST['verifico'] : "",
);

$pedido->validateData();

$pedido->savePedido();

?>