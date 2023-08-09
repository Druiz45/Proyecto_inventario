<?php

use App\Http\Models\ProductoModel;

$producto = new ProductoModel();

$producto->getDataProductoForId($_POST['producto']);