<?php

session_start();

use App\Http\Models\IngresoModel;

$ingreso = new IngresoModel(
    isset($_POST["valorIngreso"]) ? $_POST["valorIngreso"]: "",
    isset($_POST["tipoIngreso"]) ? $_POST["tipoIngreso"]: "",
    isset($_POST["descripcion"]) ? $_POST["descripcion"]: "",
);

$ingreso->validateData();

$ingreso->updateIngreso($_POST['ingreso']);