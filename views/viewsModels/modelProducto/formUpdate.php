<?php

use App\Http\Models\ProductoModel;

$producto = new ProductoModel();

$producto->getDataProductoForId($_GET['producto']);