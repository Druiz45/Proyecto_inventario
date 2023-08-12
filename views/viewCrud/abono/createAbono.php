<?php

session_start();

use App\Http\Models\AbonoModel;

$abono = new AbonoModel($_POST["abono"], $_POST["pedido"]);

$abono->createAbono();

?>