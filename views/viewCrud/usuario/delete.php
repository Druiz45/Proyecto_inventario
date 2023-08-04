<?php

session_start();

use App\Http\Models\UsuarioModel;

$usuario = new UsuarioModel();

$usuario->actualizarEstadoUser($_POST['usuario'], $_POST['estado']);