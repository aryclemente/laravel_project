<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContractsController extends Controller
{
    //Asignar control de la ruta al controlador | Muestra todos los Contratos
    public function ShowAllContracts()
    {
        return "Hello, Welcome to Contract Systems.
    Aquí se mostraran todos los contratos del sistema";
    }
    //Crear Contrato
    public function CreateContract()
    {
        return "Crear un nuevo contrato";
    }
    //ModificarContrato
    public function UpdateContract($contract)
    {
        return "Modificar el contrato seleccionado {$contract}";
    }
    //Mostrar Detalle del Contrato
    public function ShowContract($contract)
    {
        return "Hello, Welcome to Contract Systems.
        Aquí se mostrará el contrato: {$contract}";
    }
}
