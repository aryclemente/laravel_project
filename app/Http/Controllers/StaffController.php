<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function ShowAllStaff()
    {
        return "Hello, Welcome to Contract Systems.
    Aquí se mostraran todo el personal a destajo del sistema";
    }
    //Nuevo Servicio
    public function CreateStaff()
    {
        return "Crear un nuevo trabajador";
    }
    //Modificar un servicio
    public function UpdateStaff($staff)
    {
        return "Modificar el siguiente trabajador {$staff}";
    }
    public function ShowStaff($staff)
    {
        return "Hello, Welcome to Contract Systems.
        Aquí se mostrará el siguiente trabajador: {$staff}";
    }
}
