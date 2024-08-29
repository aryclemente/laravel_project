<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestsController extends Controller
{
    //Asignar control de la ruta al controlador | Mostrar Solicitudes
    public function index()
    {
        return view('modules/Request/index');
    }

    public function ShowAllRequests()
    {
        return "Hello, Welcome to Contract Systems.
    Aquí se mostraran todas las solicitudes del sistema";
    }
    //Nueva Solicitud
    public function CreateRequest()
    {
        return "Crear una nueva solicitud";
    }
    //Modificar una solicitud
    public function UpdateRequest($request)
    {
        return "Modificar la siguiente solicitud {$request}";
    }
    public function ShowRequest($request)
    {
        return "Hello, Welcome to Contract Systems.
        Aquí se mostrará la solicitud: {$request}";
    }
}
