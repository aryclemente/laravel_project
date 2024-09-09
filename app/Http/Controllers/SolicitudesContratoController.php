<?php

namespace App\Http\Controllers;

use App\Models\Cargo;
use App\Models\SolicitudesContrato;
use App\Models\EmpleadoFijo; 
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
                'personas_id' => 'required|exists:personas,idPersonas',
                'cargos_id' => 'required|exists:cargos,idCargos',
                'turnos_id' => 'required|exists:turnos,idTurnos',
            ]);

            // Crear el empleado fijo
            $empleadoFijo = new EmpleadoFijo();
            $empleadoFijo->personas_id = $request->personas_id;
            $empleadoFijo->cargos_id = $request->cargos_id;
            $empleadoFijo->turnos_id = $request->turnos_id;
            $empleadoFijo->save();

            // Crear la solicitud de contrato para empleado fijo
            $solicitudes->Fecha_solicitud = now();
            $solicitudes->Status_solicitud = true;
            $solicitudes->Tipo_Solicitud_idTipo_Solicitud = $request->tipo_solicitud;
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
        // Obtener la solicitud por ID
        $solicitud = SolicitudesContrato::findOrFail($id);

        // Validar el tipo de contrato y seleccionar la vista
        switch ($solicitud->tipo_solicitud->tipo_contrato) {
            case 'fijo':
                $view = 'modules.contratos.fixed_contract_template';
                break;
            case 'servicios':
                $view = 'modules.contratos.task_contract_template';
                break;
            case 'empresa':
                $view = 'modules.contratos.company_contract_template';
                break;
            default:
                abort(404, 'Tipo de contrato no válido.');
        }

        // Generar el PDF
        $pdf = PDF::loadView($view, ['solicitud' => $solicitud]);

        // Retornar el PDF descargable
        return $pdf->download('contrato_' . $solicitud->id . '.pdf');
    }

    public function show($id)
    {
        // Obtener la solicitud por ID
        $solicitud = SolicitudesContrato::findOrFail($id);
    
        // Pasar la solicitud a la vista
        return view('modules.solicitudes.show', compact('solicitud'));
    }
    
public function edit(string $id)
{
    // Obtener todos los datos necesarios para la vista
    $solicitudes = SolicitudesContrato::all();
    $personas = Persona::all();
    $servicios = Servicio::all();
    $tiposolicitud = TipoSolicitud::all();
    $turnos = Turno::all();
    $cargos = Cargo::all();
    $empresas = Empresa::all();

    // Encontrar la solicitud por ID
    $solicitud = SolicitudesContrato::findOrFail($id);

    // Inicializar las variables
    $persona_ps = null;
    $servicio_ps = null;

    // Obtener los datos relacionados con la solicitud
    $personaservicio = PersonasHasServicio::where('id_Personas_has_Servicios', $solicitud->id_Personas_has_Servicios_)->get();

    // Solo necesitas el primer resultado
    if ($personaservicio->isNotEmpty()) {
        $ps = $personaservicio->first(); // Obtener el primer resultado
        $persona_ps = $ps->persona;
        $servicio_ps = $ps->servicio;
    }

    // Pasar las variables a la vista
    return view('modules/solicitudes/edit', compact('solicitud', 'tiposolicitud', 'personas', 'servicios', 'turnos', 'cargos', 'empresas', 'persona_ps', 'servicio_ps'));
}
public function update(Request $request, string $id)
{
    // Encontrar la solicitud por ID
    $solicitud = SolicitudesContrato::findOrFail($id);

    // Validar los datos recibidos
    $validatedData = $request->validate([
        'tipo_solicitud' => 'required|integer',
        'personas_id' => 'required|integer',
        'cargos_id' => 'nullable|integer',
        'turnos_id' => 'nullable|integer',
        'servicio_id' => 'nullable|integer',
        'costo_servicio' => 'nullable|numeric',
    ]);

    // Actualizar la solicitud
    $solicitud->update($validatedData);

    // Actualizar PersonasHasServicio si es necesario
    $personaservicio = PersonasHasServicio::where('id_Personas_has_Servicios', $solicitud->id_Personas_has_Servicios_)->get();

    foreach ($personaservicio as $ps) {
        $ps->Servicios_idServicio = $request->servicio_id;
        $ps->Personas_idPersonas = $request->personas_id;
        $ps->Costo_Servicio = $request->costo_servicio;
        $ps->save();
    }

    // Redirigir con mensaje de éxito
    return redirect()->route('solicitudes.index')->with('success', 'Solicitud actualizada correctamente.');
}

    public function destroy($id)
{
    $solicitud = SolicitudesContrato::findOrFail($id);
    $solicitud->delete();
    return redirect()->route('solicitudes.index')->with('success', 'Solicitud eliminada con éxito.');
}
}
}
}

