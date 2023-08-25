<?php

session_start();

use App\Http\Models\GastoModel;

$gasto = new GastoModel(
    isset($_POST["valorGasto"]) ? $_POST["valorGasto"]: "",
    isset($_POST["tipoGasto"]) ? $_POST["tipoGasto"]: "",
    isset($_POST["descripcion"]) ? $_POST["descripcion"]: "",
);

$gasto->createGasto();

?>