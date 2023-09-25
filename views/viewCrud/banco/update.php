<?php

use App\Http\Models\BancoModel;

$banco = new BancoModel($_POST["banco"]);
$banco->validateData();
$banco->updateBanco($_POST["idBanco"]);
