<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    //Asignar control de la ruta al controlador | Mostrar Todos los Servicios
    public function ShowAllServices()
    {
        return "Hello, Welcome to Contract Systems.
    Aquí se mostraran todos los servicios del sistema";
    }
    //Nuevo Servicio
    public function CreateService()
    {
        return "Crear un nuevo servicio";
    }
    //Modificar un servicio
    public function UpdateService($service)
    {
        return "Modificar el siguiente servicio {$service}";
    }
    public function ShowService($service)
    {
        return "Hello, Welcome to Contract Systems.
        Aquí se mostrará el servicio: {$service}";
    }
}
