<?php

session_start();

use App\Http\Models\GastoModel;

$gasto = new GastoModel();
$gasto->getInfoFormUpdate($_POST['gasto']);