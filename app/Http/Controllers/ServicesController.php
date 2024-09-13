<?php

namespace App\Http\Controllers;

use App\Models\Servicio;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function index()
    {
        $servicios = Servicio::all();
        return view('modules.servicios.index', compact('servicios'));
    }
    //Nuevo Servicio

}
