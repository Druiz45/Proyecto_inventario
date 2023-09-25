<?php

use App\Http\Models\BancoModel;

$banco = new BancoModel($_POST["banco"]);
$banco->validateData();
$banco->createBanco();
