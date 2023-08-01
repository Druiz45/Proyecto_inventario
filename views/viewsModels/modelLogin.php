<?php

session_start();

use App\Http\Models\LoginModel;

$sesion = new LoginModel($_POST['email'], $_POST['pass']);
$sesion->getDataSesion();
$sesion->iniciarSesion();

?>