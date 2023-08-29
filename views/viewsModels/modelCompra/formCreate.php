<?php

use App\Http\Models\CompraModel;

$compra = new CompraModel(
    isset($_POST["docProveedor"]) ? $_POST["docProveedor"]: "vacio",
    isset($_POST["nombreProducto"]) ? $_POST["nombreProducto"]: "vacio"
);

$compra->getInfoFormCreate();

?>