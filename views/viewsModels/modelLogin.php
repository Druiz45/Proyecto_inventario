<?php

use App\Http\Models\LoginModel;

$sesion = new LoginModel($_POST['email']);
$sesion->getDataSesion();
$sesion->iniciarSesion($_POST['pass']);

?>