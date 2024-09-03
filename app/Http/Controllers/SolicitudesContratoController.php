<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\SolicitudesContrato;
use App\Models\Trabajadores;
use App\Models\Empresa;
use App\Models\Persona;
use App\Models\Servicio;
use App\Models\TipoSolicitud;
use App\Models\PersonasHasServicio;
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

    public function createdestajo()
    {

        $solicitudes = SolicitudesContrato::all();
        $personas = Persona::all();
        $servicios = Servicio::all();

        return view('modules/solicitudes/createdestajo', compact('solicitudes', 'personas',  'servicios'));
    }

    public function storedestajo(Request $request)
    {

        $solicitudes = new SolicitudesContrato();
        $personas_servicios = new PersonasHasServicio();

        $request->validate([
            'personas_id' => 'required',
            'servicio_id' => 'required'
        ]);

        $personas_servicios->Servicios_idServicio = $request->servicio_id;
        $personas_servicios->Personas_idPersonas = $request->personas_id;
        $personas_servicios->Costo_Servicio = $request->costo_servicio;
        $personas_servicios->save();

        $solicitudes->Fecha_solicitud = now();
        $solicitudes->Status_solicitud = true;
        $solicitudes->Tipo_Solicitud_idTipo_Solicitud = 2;

        $personas_servicios->solicitudes_contratos()->save($solicitudes);


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
