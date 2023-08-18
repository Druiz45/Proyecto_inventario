<?php

session_start();

use App\Http\Models\AbonoCompraModel;

$abonoCompra = new AbonoCompraModel($_POST["abono"], $_POST["compra"]);

$abonoCompra->validateData();

$abonoCompra->create($_POST["restante"]);

?>