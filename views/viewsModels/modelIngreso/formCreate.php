<?php

session_start();

use App\Http\Models\IngresoModel;

$ingreso = new IngresoModel();

$ingreso->getInfoFormCreate();

?>