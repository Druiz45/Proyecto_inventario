<?php

use App\Http\Models\BancoModel;

$banco = new BancoModel();

echo json_encode($banco->getBancos());