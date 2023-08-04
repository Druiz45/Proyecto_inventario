<?php

use App\Http\Models\ProductoModel;

$producto = new ProductoModel();

$producto->validateData();

$producto->updateProducto();