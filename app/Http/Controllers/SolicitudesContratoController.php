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

    $id_ts = $request->tipo_solicitud;

    switch ($id_ts) {
        case 1:
            // Validar los datos necesarios para el tipo 1
            $request->validate([
                'idPersonas' => 'required|exists:personas,id',
                'idCargos' => 'required|exists:cargos,id',
                'idTurnos' => 'required|exists:turnos,id',
            ]);

            // Crear la solicitud de contrato para empleado fijo
            $solicitudes->Fecha_solicitud = now();
            $solicitudes->Status_solicitud = true;
            $solicitudes->Tipo_Solicitud_idTipo_Solicitud = $request->tipo_solicitud;
            $solicitudes->Personas_idPersonas = $request->personas_id;
            $solicitudes->Cargos_idCargos = $request->cargos_id;
            $solicitudes->Turnos_idTurnos = $request->turnos_id;
            $solicitudes->Costo_Servicio = $request->costo_servicio ?? 0;
            $solicitudes->save();

            return redirect()->route('solicitudes.index')->with('success', 'Solicitud para empleado fijo creada exitosamente.');

        case 2:
            // Crear y guardar un nuevo registro en PersonasHasServicio
            $personas_servicios = new PersonasHasServicio();
            $personas_servicios->Servicios_idServicio = $request->servicio_id;
            $personas_servicios->Personas_idPersonas = $request->personas_id;
            $personas_servicios->Costo_Servicio = $request->costo_servicio;
            $personas_servicios->save();

            // Asociar el registro con la solicitud
            $solicitudes->Fecha_solicitud = now();
            $solicitudes->Status_solicitud = true;
            $solicitudes->Tipo_Solicitud_idTipo_Solicitud = $request->tipo_solicitud;
            $solicitudes->save();

            return redirect()->route('solicitudes.index')->with('success', 'Solicitud tipo 2 creada exitosamente.');

        case 3:
            // Crear y guardar un nuevo registro en EmpresasHasServicio
            $empresas_servicios = new EmpresasHasServicio();
            $empresas_servicios->Servicios_idServicio = $request->servicio_id;
            $empresas_servicios->Empresas_idEmpresa = $request->empresa_id;
            $empresas_servicios->Costo_Servicio = $request->costo_servicio;
            $empresas_servicios->save();

            // Asociar el registro con la solicitud
            $solicitudes->Fecha_solicitud = now();
            $solicitudes->Status_solicitud = true;
            $solicitudes->Tipo_Solicitud_idTipo_Solicitud = $request->tipo_solicitud;
            $solicitudes->save();

            return redirect()->route('solicitudes.index')->with('success', 'Solicitud tipo 3 creada exitosamente.');

        default:
            return redirect()->route('solicitudes.index')->with('error', 'Tipo de solicitud no válido.');
    }
}

    // SolicitudesContratoController.php
    public function generateContract($id)
{
    $solicitud = SolicitudesContrato::with([
        'personas_has_servicio', 
        'empresas_has_servicio', 
        'tipo_solicitud',
        'contratos'
    ])->findOrFail($id);
    dd($solicitud);

    // Elige la vista basada en el tipo de solicitud
    $view = 'modules.contratos.default_contract_template'; // Vista por defecto si no se encuentra una específica

    switch ($solicitud->Tipo_Solicitud_idTipo_Solicitud) {
        case 1:
            $view = 'modules.contratos.fixed_contract_template';
            break;
        case 2:
            $view = 'modules.contratos.task_contract_template';
            break;
        case 3:
            $view = 'modules.contratos.company_contract_template';
            break;
    }

    $pdf = \PDF::loadView($view, ['solicitud' => $solicitud]);

    return $pdf->download('contrato_' . $id . '.pdf');
}

    public function show($id)
{
    // Encuentra la solicitud por su ID o lanza una excepción si no se encuentra
    $solicitud = SolicitudesContrato::findOrFail($id);

    // Inicializar variables
    $persona_ps = null;
    $servicio_ps = null;

    // Obtén información adicional si es necesario
    $personaservicio = PersonasHasServicio::where('id_Personas_has_Servicios', $solicitud->id_Personas_has_Servicios_)->with('solicitudes_contratos')->get();

    // Verificar si hay resultados y asignar variables
    if ($personaservicio->isNotEmpty()) {
        $ps = $personaservicio->first(); // Obtener el primer resultado
        $persona_ps = $ps->persona;
        $servicio_ps = $ps->servicio;
    }

    // Devuelve la vista con la solicitud y datos relacionados
    return view('modules/solicitudes/show', compact('solicitud', 'persona_ps', 'servicio_ps'));
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
    public function destroy($id)
{
    $solicitud = SolicitudesContrato::findOrFail($id);
    $solicitud->delete();
    return redirect()->route('solicitudes.index')->with('success', 'Solicitud eliminada con éxito.');
}
}
