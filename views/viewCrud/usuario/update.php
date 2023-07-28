<?php

use App\Http\Models\UsuarioModel;

session_start();

$usuario = new UsuarioModel(
    $_POST['nombres'],
    $_POST['apellidos'],
    $_POST['documento'],
    $_POST['email'],
    $_POST['celular'],
    $_POST['direccion'],
    $_SESSION['idPerfil'],   
);
$usuario->validateData();
$usuario->updateUser();

?>