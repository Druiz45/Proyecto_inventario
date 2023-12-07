<?php

use App\Http\Models\UsuarioModel;

$usuario = new UsuarioModel();
$usuario->getProvedoresForDocOrName($_POST['nameOrDocProveedor']);
// echo json_encode($_POST);
