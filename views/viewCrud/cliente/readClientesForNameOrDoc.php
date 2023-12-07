<?php

use App\Http\Models\ClienteModel;

$cliente = new ClienteModel();

$cliente->getDataClienteForDocOrName($_POST['nameOrDocCliente']);