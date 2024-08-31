<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\SolicitudesContrato;
use App\Models\Trabajadores;
use App\Models\Empresa;
use App\Models\Persona;
use App\Models\Servicio;
use App\Models\TipoSolicitud;
use App\Models\Turno;
use Illuminate\Http\Request;



class SolicitudesContratoController extends Controller
{
    public function index()
    {
        $tiposolicitud = TipoSolicitud::all();
        $solicitudes = SolicitudesContrato::all();
        $cargos = Cargo::all();
        $servicios = Servicio::all();
        return view('modules/solicitudes/index', compact('solicitudes', 'tiposolicitud'));
    }

    public function create()
    {
        $tiposolicitud = TipoSolicitud::all();
        $solicitudes = SolicitudesContrato::all();
        $empresas = Empresa::all();
        $personas = Persona::all();
        $cargos = Cargo::all();
        $turnos = Turno::all();
        $servicios = Servicio::all();
        return view('modules/solicitudes/create', compact('solicitudes', 'tiposolicitud', 'personas',  'empresas', 'servicios', 'cargos', 'turnos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idTipo_Solicitud' => 'required|boolean',
            'servicios_idServicio' => 'required|integer|exists:servicios,idServicio',
            'personas_idPersonas' => 'required|integer|exists:personas,idPersonas'
        ]);

        SolicitudesContrato::create($request->all());
        return redirect()->route('solicitudes.index');
    }

    public function show(string $idSolicitud)
    {
        $solicitud = SolicitudesContrato::find($idSolicitud);
        return view('modules/solicitudes/show', compact('solicitud'));
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
            'idTipo_Solicitud' => 'required|boolean',
            'servicios_idServicio' => 'required|integer|exists:servicios,idServicio',
            'personas_idPersonas' => 'required|integer|exists:personas,idPersonas'
        ]);

        $solicitud->update($request->all());
        return redirect()->route('solicitudes.index');
    }

    public function destroy(SolicitudesContrato $solicitud)
    {
        $solicitud->delete();
        return redirect()->route('solicitudes.index');
    }
}
