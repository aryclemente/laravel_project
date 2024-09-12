<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\SolicitudesContratoController;
use App\Http\Controllers\DashboardController;

/* Dashboard*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
/*Muestra todas las solicitudes*/
Route::get('/solicitudes', [SolicitudesContratoController::class, 'index'])->name('solicitudes.index');
/*Crea una solicitud*/
Route::get('/solicitudes/create', [SolicitudesContratoController::class, 'create'])->name('solicitudes.create');
/*Envia la solicitud a BBDD*/
Route::post('/solicitudes', [SolicitudesContratoController::class, 'store'])->name('solicitudes.store');
/*/Obtener solicitud por id*/
Route::get('/solicitudes/edit/{id}', [SolicitudesContratoController::class, 'edit'])->name('solicitudes.edit');
/*/Modificar una solicitud*/
Route::put('/solicitudes/update/{id}', [SolicitudesContratoController::class, 'update'])->name('solicitudes.update');
/*Muestra el detalle de una solicitud*/
Route::get('/solicitudes/show/{id}', [SolicitudesContratoController::class, 'show'])->name('solicitudes.show');

Route::get('/solicitudes/{id}', [SolicitudesContratoController::class, 'show'])->name('solicitudes.show');
//Genera un pdf
Route::get('/solicitudes/generateContract/{id}', [SolicitudesContratoController::class, 'generarcontrato'])->name('solicitudes.generateContract');

Route::put('/solicitudes/{id}', [SolicitudesContratoController::class, 'destroy'])->name('solicitudes.destroy');

Route::get('/solicitudes/delete', [SolicitudesContratoController::class, 'deletes'])->name('solicitudes.deleteshow');

/*Ruta con Controlador | Muestra todos los contratos*/
Route::get('/contratos', [ContratoController::class, 'index'])->name('contratos.index');


//Ruta con Controlador | Crea un nuevo Contrato
// Route::get('/contratos/create/{id}', [SolicitudesContratoController::class, 'generarcontrato'])->name('solicitudes.generateContract');
Route::post('/contratos', [ContratoController::class, 'store'])->name('contratos.store');

//Modifica un contrato seleccionado
Route::get('/contratos/edit/{id}', [ContratoController::class, 'edit'])->name('contratos.edit');
Route::put('/contratos/update/{id}', [ContratoController::class, 'update'])->name('contratos.update');

//Se visualiza el detalle de un contrato
Route::get('/contratos/show/{id}', [ContratoController::class, 'show'])->name('contratos.show');

Route::post('/contratos/{id}/finalizar', [ContratoController::class, 'finalizar'])->name('contratos.finalizar');



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
