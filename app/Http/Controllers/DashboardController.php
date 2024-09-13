<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrato;
use App\Models\SolicitudesContrato;

class DashboardController extends Controller
{
    /**
     * Muestra el dashboard con contratos activos y en borrador.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Contar los contratos activos
        $contratosActivosCount = Contrato::where('Status_Contrato', 1)->count();

        // Contar los contratos en borrador
        $contratosInactivaCount = Contrato::where('Status_Contrato', 0)->count();

        // Contar los contratos inactivos
        $solicitudesActivasCount = SolicitudesContrato::where('Status_solicitud', 1)->count();


        // Pasar las variables a la vista
        return view('modules/dashboard/index', [
            'contratosActivosCount' => $contratosActivosCount,
            'contratosInactivaCount' => $contratosInactivaCount,
            'solicitudesActivasCount' => $solicitudesActivasCount,
        ]);
    }
}
