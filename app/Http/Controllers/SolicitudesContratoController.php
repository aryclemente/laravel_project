<?php

namespace App\Http\Controllers;

use App\Models\SolicitudesContrato;
use App\Models\Trabajadores;
use App\Models\Empresa;
use App\Models\Servicio;
use Illuminate\Http\Request;

class SolicitudesContratoController extends Controller
{
    public function index()
    {
        $solicitudes = SolicitudesContrato::all();
        return view('modules/solicitudes/index', compact('solicitudes'));
    }

    public function create()
    {
        $trabajadores = Trabajadores::all();
        $empresas = Empresa::all();
        $servicios = Servicio::all();
        return view('modules/solicitudes/create', compact('trabajadores', 'empresas', 'servicios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Fecha_Solicitud' => 'required|date',
            'Trabajadores_idTrabajador' => 'required|integer|exists:trabajadores,idTrabajador',
            'Empresas_idEmpresa' => 'required|integer|exists:empresas,idEmpresa',
            'Servicios_idServicio' => 'required|integer|exists:servicios,idServicio',
        ]);

        SolicitudesContrato::create($request->all());
        return redirect()->route('solicitudes.index');
    }

    public function edit(SolicitudesContrato $solicitud)
    {
        $trabajadores = Trabajadores::all();
        $empresas = Empresa::all();
        $servicios = Servicio::all();
        return view('modules/solicitudes/edit', compact('solicitud', 'trabajadores', 'empresas', 'servicios'));
    }

    public function update(Request $request, SolicitudesContrato $solicitud)
    {
        $request->validate([
            'Fecha_Solicitud' => 'required|date',
            'Trabajadores_idTrabajador' => 'required|integer|exists:trabajadores,idTrabajador',
            'Empresas_idEmpresa' => 'required|integer|exists:empresas,idEmpresa',
            'Servicios_idServicio' => 'required|integer|exists:servicios,idServicio',
        ]);

        $solicitud->update($request->all());
        return redirect()->route('modules/solicitudes/index');
    }

    public function destroy(SolicitudesContrato $solicitud)
    {
        $solicitud->delete();
        return redirect()->route('modules/solicitudes/index');
    }
}
