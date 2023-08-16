<?php

use App\Http\Models\CompraModel;

$compra = new CompraModel();

$compra->getCompra($_POST["compra"]);

?>