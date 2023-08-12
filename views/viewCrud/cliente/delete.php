<?php

session_start();

use App\Http\Models\ClienteModel;

$cliente = new ClienteModel();
$cliente->actualizarEstadoCliente($_POST['cliente'], $_POST['estado']);