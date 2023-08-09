<?php

use App\Http\Models\ProductoModel;

$producto = new ProductoModel(
    $_POST["producto"],
    $_POST["categoria"],
    $_POST["descripcion"],
    $_POST["valorProducto"],
);

$producto->validateData();

$producto->updateProducto($_POST['numProducto']);