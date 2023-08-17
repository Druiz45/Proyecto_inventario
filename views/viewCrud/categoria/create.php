<?php

// session_start();

use App\Http\Models\CategoriaModel;

$categoria = new CategoriaModel(
    $_POST['nombre-categoria'],
);
$categoria->validateData();
$categoria->createCategoria();
// echo json_encode($_POST['nombre-categoria']);