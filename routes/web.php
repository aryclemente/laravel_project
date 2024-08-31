<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContractsController;
use App\Http\Controllers\RequestsController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\StaffController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SolicitudesContratoController;

/*Ruta sencilla | Dashboard*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

/*/Muestra todas las solicitudes*/
Route::get('/solicitudes', [SolicitudesContratoController::class, 'index'])->name('solicitudes.index');

/*Crea una solicitud*/

Route::get('/solicitudes/create', [SolicitudesContratoController::class, 'create'])->name('solicitudes.create');

/*Envia la solicitud a BBDD*/
Route::post('/solicitudes', [SolicitudesContratoController::class, 'store'])->name('solicitudes.store');

/*Muestra el detalle de una solicitud*/
Route::get('/solicitudes/show/{id}', [SolicitudesContratoController::class, 'show'])->name('solicitudes.show');

/*/Obtener solicitud por id*/
Route::get('/solicitudes/{id}/edit', [SolicitudesContratoController::class, 'edit'])->name('solicitudes.edit');

/*/Modificar una solicitud*/
Route::put('/solicitudes/{id}', [SolicitudesContratoController::class, 'update'])->name('solicitudes.update');

/*/Finalizar solicitud*/
Route::post('/solicitudes/{id}/finalizar', [SolicitudesContratoController::class, 'finalizar'])->name('solicitudes.finalizar');

/*Ruta con Controlador | Muestra todos los contratos*/
Route::get('/contracts', [ContractsController::class, 'ShowAllContracts']);

//Ruta con Controlador | Crea un nuevo Contrato
Route::get('/contracts/CreateContract', [ContractsController::class, 'CreateContract']);

//Modifica un contrato seleccionado
Route::get('/contracts/UpdateContract/{contract?}', [ContractsController::class, 'UpdateContract']);

//Se visualiza el detalle de un contrato
Route::get('/contracts/{contract?}', [ContractsController::class, 'index']);


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
