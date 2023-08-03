<?php

use App\Http\Models\UsuarioModel;

session_start();

$usuario = new UsuarioModel(
    isset($_POST["nombre"]) ? $_POST["nombre"]: "",
    isset($_POST["apellidos"]) ? $_POST["apellidos"]: "",
    isset($_POST["documento"]) ? $_POST["documento"]: $_SESSION["documento"],
    isset($_POST["email"]) ? $_POST["email"]: "",
    isset($_POST["celular"]) ? $_POST["celular"]: "",
    isset($_POST["direccion"]) ? $_POST["direccion"]: "",
    isset($_POST["idPerfil"]) ? $_POST["idPerfil"]: "",
    $_SESSION["pass"], 
    $_POST["newPass"],
    $_POST["newPassConfirm"],
    $_POST["passActual"]
);

$usuario->validateNewPass();

$usuario->updatePass();

?>