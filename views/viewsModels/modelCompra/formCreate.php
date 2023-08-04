<?php

use App\Http\Models\CompraModel;

$compra = new CompraModel(
    isset($_POST["documento"]) ? $_POST["documento"]: "vacio",
    isset($_POST["nombreProducto"]) ? $_POST["nombreProducto"]: "vacio");

$compra->getInfoFormCreate();

?>