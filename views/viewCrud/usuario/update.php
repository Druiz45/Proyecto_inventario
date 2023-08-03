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
    $_SESSION["idPerfil"],
    isset($_POST["pass"]) ? $_POST["pass"]: "",   
);
$usuario->validateData();
$usuario->updateUser();

?>