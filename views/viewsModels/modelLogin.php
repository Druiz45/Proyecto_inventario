<?php

use App\Http\Models\LoginModel;
session_start();
$sesion = new LoginModel($_POST['email']);
$sesion->getDataSesion();
$sesion->iniciarSesion($_POST['pass']);

?>