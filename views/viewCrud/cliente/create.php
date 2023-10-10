<?php

use App\Http\Models\ClienteModel;

$cliente = new ClienteModel(
    $_POST['nombres'],
    $_POST['apellidos'],
    $_POST['documento'],
    $_POST['email'],
    $_POST['celular'],
    $_POST['direccion'],
    $_POST['celularSecundario'],
);

$cliente->validateData();
$cliente->createCliente();