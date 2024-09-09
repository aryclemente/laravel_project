<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\SolicitudesContrato;
use App\Models\Trabajadores;
use App\Models\Empresa;
use App\Models\EmpresasHasServicio;
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
        // $solicitudes = SolicitudesContrato::where('Status_solicitud', true)->get();
        $cargos = Cargo::all();
        $servicios = Servicio::all();
        return view('modules/solicitudes/index', compact('solicitudes', 'tiposolicitud'));
    }


    public function create()
    {

        $solicitudes = SolicitudesContrato::all();
        $personas = Persona::all();
        $servicios = Servicio::all();
        $tiposolicitud = TipoSolicitud::all();
        $turnos = Turno::all();
        $cargos = Cargo::all();
        $empresas = Empresa::all();
        return view('modules/solicitudes/create', compact('solicitudes', 'personas',  'servicios', 'tiposolicitud', 'turnos', 'cargos', 'empresas'));
    }

    public function store(Request $request)
    {

        $solicitudes = new SolicitudesContrato();
        $personas_servicios = new PersonasHasServicio();
        $empresas_servicios = new EmpresasHasServicio();




        $id_ts = $request->tipo_solicitud;

        switch ($id_ts) {
            case 1:

                return redirect()->route('solicitudes.index');

            case 2:

                $personas_servicios->Servicios_idServicio = $request->servicio_id;
                $personas_servicios->Personas_idPersonas = $request->personas_id;
                $personas_servicios->Costo_Servicio = $request->costo_servicio;
                $personas_servicios->save();

                $solicitudes->Fecha_solicitud = now();
                $solicitudes->Status_solicitud = true;
                $solicitudes->Tipo_Solicitud_idTipo_Solicitud = $request->tipo_solicitud;

                $personas_servicios->solicitudes_contratos()->save($solicitudes);


                return redirect()->route('solicitudes.index');
            case 3:

                $empresas_servicios->Servicios_idServicio = $request->servicio_id;
                $empresas_servicios->Empresas_idEmpresa = $request->empresa_id;
                $empresas_servicios->Costo_Servicio = $request->costo_servicio;
                $empresas_servicios->save();
                // dd($id_ts, $empresas_servicios, $solicitudes);
                $solicitudes->Fecha_solicitud = now();
                $solicitudes->Status_solicitud = true;
                $solicitudes->Tipo_Solicitud_idTipo_Solicitud = $request->tipo_solicitud;

                $empresas_servicios->solicitudes_contratos()->save($solicitudes);


                return redirect()->route('solicitudes.index');
        }
    }



    public function edit(string $id)
    {
        $solicitudes = SolicitudesContrato::all();
        $personas = Persona::all();
        $servicios = Servicio::all();
        $tiposolicitud = TipoSolicitud::all();
        $turnos = Turno::all();
        $cargos = Cargo::all();
        $empresas = Empresa::all();

        $solicitud = SolicitudesContrato::FindOrFail($id);
        $personaservicio = PersonasHasServicio::where('id_Personas_has_Servicios', $solicitud->id_Personas_has_Servicios_)->with('solicitudes_contratos')->get();
        foreach ($personaservicio as $ps) {
            $persona_ps = $ps->persona;
            $servicio_ps = $ps->servicio;
        }



        return view('modules/solicitudes/edit', compact('solicitud', 'tiposolicitud', 'personas',  'servicios', 'turnos', 'cargos', 'empresas', 'ps', 'persona_ps', 'servicio_ps'));
    }

    public function update(Request $request, string $id)
    {
        $solicitud = SolicitudesContrato::FindOrFail($id);

        $id_ts = $request->tipo_solicitud;

        // switch ($id_ts) {
        //     case 1:
        //         return redirect()->route('solicitudes.index');

        //     case 2:
        $personaservicio = PersonasHasServicio::where('id_Personas_has_Servicios', $solicitud->id_Personas_has_Servicios_)->with('solicitudes_contratos')->get();


        foreach ($personaservicio as $ps) {
            $ps->Servicios_idServicio = $request->servicio_id;
            $ps->Personas_idPersonas = $request->personas_id;
            $ps->Costo_Servicio = $request->costo_servicio;
            $ps->save();
            $ps->solicitudes_contratos()->save($solicitud);
        }

        $solicitud->update($request->all());
        return redirect()->route('solicitudes.index');
        // case 3:
        return redirect()->route('solicitudes.index');
        // }
    }

    // public function destroy(string $id)
    // {
    //     $solicitud = SolicitudesContrato::withTrashed()->findOrFail($id);
    //     if ($solicitud->trashed()) {
    //         $solicitud->restore();
    //         return redirect()->back()->with('success', 'Solicitud restaurada.');
    //     } else {
    //         $solicitud->delete();
    //         return redirect()->back()->with('success', 'Solicitud eliminada.');
    //     }
    // }

    public function create_contrato(string $id)
    {
        $solicitudes = SolicitudesContrato::all();
        $personas = Persona::all();
        $servicios = Servicio::all();
        $tiposolicitud = TipoSolicitud::all();
        $turnos = Turno::all();
        $cargos = Cargo::all();
        $empresas = Empresa::all();

        $solicitud = SolicitudesContrato::FindOrFail($id);
        $tipo = TipoSolicitud::where('idTipo_Solicitud', $solicitud->Tipo_Solicitud_idTipo_Solicitud)->with('solicitudes_contratos')->get();
        $personaservicio = PersonasHasServicio::where('id_Personas_has_Servicios', $solicitud->id_Personas_has_Servicios_)->with('solicitudes_contratos')->get();

        foreach ($personaservicio as $ps) {
            $persona = PersonasHasServicio::where('idPersonas', $ps->Personas_idPersonas)->with('persona')->get();
            dd($persona, $ps);
        }

        return view('modules/contratos/create', compact('solicitud', 'tipo', 'personas',  'servicios', 'turnos', 'cargos', 'empresas'));
    }
}
