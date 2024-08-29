<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractsController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\HomeController;


/*Ruta sencilla | HomePage*/

Route::get('/', HomeController::class)->name('index');

//Ruta con Controlador | Muestra todos los contratos
Route::get('/contracts', [ContractsController::class, 'ShowAllContracts']);

//Ruta con Controlador | Crea un nuevo Contrato
Route::get('/contracts/CreateContract', [ContractsController::class, 'CreateContract']);

//Modifica un contrato seleccionado
Route::get('/contracts/UpdateContract/{contract?}', [ContractsController::class, 'UpdateContract']);

//Se visualiza el detalle de un contrato
Route::get('/contracts/{contract?}', [ContractsController::class, 'ShowContract']);

//Muestra todas las solicitudes
Route::get('/requests', [RequestsController::class, 'ShowAllRequests']);

//Ruta con Controlador | Crea una nueva Solicitud
Route::get('/requests/CreateRequest', [RequestsController::class, 'CreateRequest']);

//Modifica una solicitud seleccionado
Route::get('/requests/UpdateRequest/{request?}', [RequestsController::class, 'UpdateRequest']);

//Se visualiza el detalle de una Solicitud
Route::get('/requests/ShowRequest/{request?}', [RequestsController::class, 'ShowRequest']);

//Muestra todos los servicios
Route::get('/services', [ServicesController::class, 'ShowAllServices']);

//Ruta con Controlador | Crea un nuevo servicio
Route::get('/services/CreateService', [ServicesController::class, 'CreateService']);

//Modifica un servicio seleccionado
Route::get('/services/UpdateService/{service?}', [ServicesController::class, 'UpdateService']);

//Se visualiza el detalle de un Servicio
Route::get('/services/ShowService/{service?}', [ServicesController::class, 'ShowService']);

//Muestra todo el personal
Route::get('/staff', [StaffController::class, 'ShowAllStaff']);

//Ruta con Controlador | Crea un nuevo personal
Route::get('/staff/CreateStaff', [StaffController::class, 'CreateStaff']);

//Modifica un personal existente
Route::get('/staff/UpdateStaff/{staff?}', [StaffController::class, 'UpdateStaff']);

//Se visualiza el detalle de un personal
Route::get('/staff/ShowStaff/{staff?}', [StaffController::class, 'ShowStaff']);
