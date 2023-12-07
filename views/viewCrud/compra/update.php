<?php

session_start();

use App\Http\Models\CompraModel;

// $compra = new CompraModel(
//     isset($_POST["documento"]) ? $_POST["documento"]: "vacio",
//     isset($_POST["nombreProducto"]) ? $_POST["nombreProducto"]: "vacio",
//     isset($_POST["proveedor"]) ? $_POST["proveedor"]: "vacio",
//     isset($_POST["producto"]) ? $_POST["producto"]: "vacio",
//     isset($_POST["valorProducto"]) ? $_POST["valorProducto"]: "vacio",
//     isset($_POST["abonoProducto"]) ? $_POST["abonoProducto"]: 1,
//     isset($_POST["fecha-limite"]) ? $_POST["fecha-limite"]: "vacio",
//     isset($_POST["anotacion"]) ? $_POST["anotacion"]: "vacio",
//     "",
//     isset($_POST["compra"]) ? $_POST["compra"]: "vacio",
//     isset($_POST["banco"]) ? $_POST["banco"]: "vacio",
// );

$compra = new CompraModel(
    isset($_POST["pedido"]) ? $_POST["pedido"]: "vacio",
    isset($_POST["fecha"]) ? $_POST["fecha"]: "vacio",
    isset($_POST["fecha-entrega"]) ? $_POST["fecha-entrega"]: "vacio",

    isset($_POST["acta-entrega"]) ? $_POST["acta-entrega"]: "vacio",
    isset($_POST["fabricante"]) ? $_POST["fabricante"]: "vacio",
    isset($_POST["remision"]) ? $_POST["remision"]: "vacio",

    isset($_POST["direccion"]) ? $_POST["direccion"]: "vacio",
    isset($_POST["telefono"]) ? $_POST["telefono"]: "vacio",
    isset($_POST["ciudad"]) ? $_POST["ciudad"]: "vacio",

    isset($_POST["celular"]) ? $_POST["celular"]: "vacio",
    isset($_POST["email"]) ? $_POST["email"]: "vacio",
    isset($_POST["vendedor-codigo"]) ? $_POST["vendedor-codigo"]: "vacio",

    isset($_POST["anotacion"]) ? $_POST["anotacion"]: "vacio",
    isset($_POST["banco"]) ? $_POST["banco"]: "vacio",
    isset($_POST["total"]) ? $_POST["total"]: "vacio",

    isset($_POST["abono"]) ? $_POST["abono"]: "vacio",
    isset($_POST["saldo"]) ? $_POST["saldo"]: "vacio",
    isset($_POST["observacion"]) ? $_POST["observacion"]: "vacio",

    isset($_POST["Fabricante2"]) ? $_POST["Fabricante2"]: "vacio",
    isset($_POST["vendedor"]) ? $_POST["vendedor"]: "vacio",
    isset($_POST["recibe"]) ? $_POST["recibe"]: "vacio",

    isset($_POST["despacho"]) ? $_POST["despacho"]: "vacio",
    isset($_POST["autorizo"]) ? $_POST["autorizo"]: "vacio",
    
);

// $compra->validateDataCompra();

$compra->updateCompra($_POST['compra']);

?>