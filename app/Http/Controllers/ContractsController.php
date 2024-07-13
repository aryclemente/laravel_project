<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContractsController extends Controller
{
    //Asignar control de la ruta al controlador
    public function ShowContracts()
    {
        return "Hello, Welcome to Contract Systems.
    Aquí se mostraran todos los contratos del sistema";
    }
    public function CreateContract()
    {
        return "Crear un nuevo contrato";
    }
}
