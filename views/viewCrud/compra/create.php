<?php

session_start();

use App\Http\Models\CompraModel;

$compra = new CompraModel(
    isset($_POST["docProveedor"]) ? $_POST["docProveedor"]: "vacio",
    isset($_POST["nombreProducto"]) ? $_POST["nombreProducto"]: "vacio",
    isset($_POST["proveedor"]) ? $_POST["proveedor"]: "vacio",
    isset($_POST["producto"]) ? $_POST["producto"]: "vacio",
    isset($_POST["valorProducto"]) ? $_POST["valorProducto"]: "vacio",
    isset($_POST["abonoProducto"]) ? $_POST["abonoProducto"]: "vacio",
    isset($_POST["fechaLimite"]) ? $_POST["fechaLimite"]: "vacio",
    isset($_POST["anotacion"]) ? $_POST["anotacion"]: "vacio",
    isset($_POST["cliente"]) ? $_POST["cliente"]: "vacio",
    "",
    isset($_POST["banco"]) ? $_POST["banco"]: "vacio",
);

$compra->validateDataCompra();

$compra->saveCompra();

?>