<?php
// ...
require_once __DIR__ . './../vendor/autoload.php';

// var_dump(__DIR__ . '/../vendor/autoload.php');

use App\Http\Request;

$request = new Request();
$request->send();