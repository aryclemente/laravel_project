<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractsController;

//Ruta sencilla
Route::get('/', function () {
    return "Hello, I'm AriC. Welcome to my first app";
});

//Ruta con Controlador
Route::get('/contracts', [ContractsController::class, 'ShowContracts']);

//Ruta con Controlador
Route::get('/contracts', [ContractsController::class, 'CreateContract']);



Route::get('/contracts/{contract?}', function ($contract) {
    return "Hello, Welcome to Contract Systems.
    Aquí se mostrará el contrato: {$contract}";
});
