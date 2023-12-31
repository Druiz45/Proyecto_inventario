<?php

use App\Http\Models\UsuarioModel;

$usuario = new UsuarioModel(
    $_POST['nombres'],
    $_POST['apellidos'],
    $_POST['documento'],
    $_POST['email'],
    $_POST['celular'],
    $_POST['direccion'],
    $_POST['select-perfiles'],
    $_POST['documento'],
    isset($_POST['nombre-empresa']) ? $_POST['nombre-empresa'] : null,
    isset($_POST['nit-empresa']) ? $_POST['nit-empresa'] : null,
    // $_POST['pass'],
    // $_POST['confirmPass'],
);

$usuario->validateData();
$usuario->encryptPass();
$usuario->createUser();
