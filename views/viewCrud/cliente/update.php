<?php

session_start();

use App\Http\Models\ClienteModel;

$cliente = new ClienteModel(
    $_POST['nombres'],
    $_POST['apellidos'],
    $_POST['documento'],
    $_POST['email'],
    $_POST['celular'],
    $_POST['direccion'],
);
$cliente->validateData();
$cliente->updateCliente($_POST['cliente']);