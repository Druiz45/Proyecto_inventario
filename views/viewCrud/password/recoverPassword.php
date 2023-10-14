<?php

session_start();

use App\Http\Models\UsuarioModel;

$user = new UsuarioModel();

$dataUser = $user->validateRecoverPass($_POST['email']);

$idUserDecryp = $dataUser[0]['id'];

$idUserEncrypt = $user->getIdUserEncryp($user, $dataUser);

$token = $user->getTokenPass($dataUser);

$user->recoverPass($_POST['email'], $idUserEncrypt, $token);

// echo json_encode($idUserDecryp);