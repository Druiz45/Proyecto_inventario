<?php

use App\Http\Models\BancoModel;

$banco = new BancoModel();
$banco->updateEstate($_POST["idBanco"], $_POST["estado"]);
