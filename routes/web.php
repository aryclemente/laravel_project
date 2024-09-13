<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\SolicitudesContratoController;
use App\Http\Controllers\DashboardController;

/* Dashboard*/

Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
/*Muestra todas las solicitudes*/
Route::get('/solicitudes', [SolicitudesContratoController::class, 'index'])->name('solicitudes.index');
/*Muestra todas las solicitudes Fijas*/
Route::get('/solicitudes/fijo', [SolicitudesContratoController::class, 'fijo'])->name('solicitudes.fijo');
/*Muestra todas las solicitudes Destajo*/
Route::get('/solicitudes/destajo', [SolicitudesContratoController::class, 'destajo'])->name('solicitudes.destajo');
/*Muestra todas las solicitudes Empresa*/
Route::get('/solicitudes/empresas', [SolicitudesContratoController::class, 'empresas'])->name('solicitudes.empresas');
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
//Route::get('/solicitudes/{id}', [SolicitudesContratoController::class, 'show'])->name('solicitudes.show');
Route::post('/solicitudes/{id}', [SolicitudesContratoController::class, 'desactivar'])->name('solicitudes.desactivar');
//Lista de Solicitudes Desactivadas
Route::get('/solicitudes/delete', [SolicitudesContratoController::class, 'deleteshow'])->name('solicitudes.deleteshow');


//Crear un Contrato
Route::get('/solicitudes/generarcontrato/{id}', [SolicitudesContratoController::class, 'generarcontrato'])->name('solicitudes.generarcontrato');
Route::post('/contratos/{id}', [ContratoController::class, 'store'])->name('contratos.store');

//Genera un pdf
Route::get('/contratos/ContractPDF/{id}', [ContratoController::class, 'ContractPDF'])->name('contratos.ContractPDF');

/*Ruta con Controlador | Muestra todos los contratos*/
Route::get('/contratos', [ContratoController::class, 'index'])->name('contratos.index');

//Modifica un contrato seleccionado
Route::get('/contratos/edit/{id}', [ContratoController::class, 'edit'])->name('contratos.edit');
Route::put('/contratos/update/{id}', [ContratoController::class, 'update'])->name('contratos.update');

//Se visualiza el detalle de un contrato
Route::get('/contratos/show/{id}', [ContratoController::class, 'show'])->name('contratos.show');

Route::post('/contratos/{id}/finalizar', [ContratoController::class, 'finalizar'])->name('contratos.finalizar');

//Lista de Contratos Finalizados
Route::get('/contratos/finalizado', [ContratoController::class, 'deleteshow'])->name('contratos.deleteshow');


//Muestra todos los servicios
Route::get('/services', [ServicesController::class, 'index'])->name('servicios.index');

//Muestra todas las empresas
Route::get('/empresas', [EmpresaController::class, 'index'])->name('empresas.index');

// //Ruta con Controlador | Crea un nuevo servicio
// Route::get('/services/CreateService', [ServicesController::class, 'CreateService']);

// //Modifica un servicio seleccionado
// Route::get('/services/UpdateService/{service?}', [ServicesController::class, 'UpdateService']);

// //Se visualiza el detalle de un Servicio
// Route::get('/services/ShowService/{service?}', [ServicesController::class, 'ShowService']);

//Muestra todo el personal
Route::get('/staff', [StaffController::class, 'index'])->name('personas.index');

// //Ruta con Controlador | Crea un nuevo personal
// Route::get('/staff/CreateStaff', [StaffController::class, 'CreateStaff']);

// //Modifica un personal existente
// Route::get('/staff/UpdateStaff/{staff?}', [StaffController::class, 'UpdateStaff']);

// //Se visualiza el detalle de un personal
// Route::get('/staff/ShowStaff/{staff?}', [StaffController::class, 'ShowStaff']);
