<?php

session_start();

use App\Http\Models\PedidoModel;
use App\Http\Models\ComisionModel;

$comision = new ComisionModel(
    $_POST['numVendedor'],
    $_SESSION['idUser'],
    $_POST['valorComision'],
    $_POST['pedido'],
    $_POST['banco'],
);

$comision->validateDates();

$pedido = new PedidoModel();

$pedido->updatePagoComision($_POST["pedido"], $comision);

?>