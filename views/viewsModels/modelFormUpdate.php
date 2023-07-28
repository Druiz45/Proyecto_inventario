<?php

use App\Http\Models\UsuarioModel;

session_start();

$data = new UsuarioModel();

$data->getDataUserLog();