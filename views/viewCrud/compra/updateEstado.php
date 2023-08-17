<?php

session_start();

use App\Http\Models\CompraModel;

$compra = new CompraModel();

$compra->updateEstate($_POST["estado"], $_POST["compra"]);

?>