<?php

session_start();

use App\Http\Models\IngresoModel;

$ingreso = new IngresoModel(
    isset($_POST["valorIngreso"]) ? $_POST["valorIngreso"]: "",
    isset($_POST["tipoIngreso"]) ? $_POST["tipoIngreso"]: "",
    isset($_POST["descripcion"]) ? $_POST["descripcion"]: "",
    isset($_POST["banco"]) ? $_POST["banco"]: "",
);

$ingreso->validateData();

$ingreso->createIngreso();

?>