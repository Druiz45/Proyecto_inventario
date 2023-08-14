<?php

use App\Http\Models\ClienteModel;

session_start();

$data = new ClienteModel();

$data->getDataClienteToUpdate($_POST['cliente']);