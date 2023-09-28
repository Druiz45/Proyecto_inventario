<?php

session_start();

use App\Http\Models\GastoModel;

$gasto = new GastoModel(
    isset($_POST["valorGasto"]) ? $_POST["valorGasto"]: "",
    isset($_POST["tipoGasto"]) ? $_POST["tipoGasto"]: "",
    isset($_POST["descripcion"]) ? $_POST["descripcion"]: "",
    isset($_POST["banco"]) ? $_POST["banco"]: "",
);

$gasto->validateData();

$gasto->updateGasto($_POST['gasto']);