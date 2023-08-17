<?php

session_start();

use App\Http\Models\CompraModel;

$compra = new CompraModel(
    isset($_POST["documento"]) ? $_POST["documento"]: "vacio",
    isset($_POST["nombreProducto"]) ? $_POST["nombreProducto"]: "vacio",
    isset($_POST["proveedor"]) ? $_POST["proveedor"]: "vacio",
    isset($_POST["producto"]) ? $_POST["producto"]: "vacio",
    isset($_POST["valorProducto"]) ? $_POST["valorProducto"]: "vacio",
    isset($_POST["abonoProducto"]) ? $_POST["abonoProducto"]: 1,
    isset($_POST["fecha-limite"]) ? $_POST["fecha-limite"]: "vacio",
    isset($_POST["anotacion"]) ? $_POST["anotacion"]: "vacio",
);

$compra->validateDataCompra();

$compra->updateCompra($_POST["compra"]);

?>