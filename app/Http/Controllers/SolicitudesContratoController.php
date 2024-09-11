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
        //$solicitudes = SolicitudesContrato::where('Status_solicitud', true)->get();
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
                // Validar los datos necesarios para el Personal A destajo
                $request->validate([
                    'personas_id_2' => 'required|exists:personas_has_servicios,Personas_idPersonas',
                    'servicio_id' => 'required|exists:personas_has_servicios,Servicios_idServicio',
                    'costo_servicio' => 'required|numeric',
                ]);

                // Crear y guardar un nuevo registro en PersonasHasServicio
                $personas_servicios = new PersonasHasServicio();
                $personas_servicios->Servicios_idServicio = $request->servicio_id;
                $personas_servicios->Personas_idPersonas = $request->personas_id_2;
                $personas_servicios->Costo_Servicio = $request->costo_servicio;
                $personas_servicios->save();
                // Asociar el registro con la solicitud
                $solicitudes->Fecha_solicitud = now();
                $solicitudes->Status_solicitud = true;
                $solicitudes->Tipo_Solicitud_idTipo_Solicitud = $request->tipo_solicitud;
                $solicitudes->save();
                $personas_servicios->solicitudes_contratos()->save($solicitudes);
                return redirect()->route('solicitudes.index')->with('success', 'Solicitud de Personal a Destajo creada exitosamente.');
            case 3:
                $request->validate([
                    'empresa_id' => 'required|exists:personas_has_servicios,Personas_idPersonas',
                    'servicio_id_3' => 'required|exists:personas_has_servicios,Servicios_idServicio',
                    'costo_servicio_3' => 'required|numeric',
                ]);
                // Crear y guardar un nuevo registro en EmpresasHasServicio
                $empresas_servicios = new EmpresasHasServicio();
                $empresas_servicios->Servicios_idServicio = $request->servicio_id_3;
                $empresas_servicios->Empresas_idEmpresa = $request->empresa_id;
                $empresas_servicios->Costo_Servicio = $request->costo_servicio_3;
                $empresas_servicios->save();
                // Asociar el registro con la solicitud
                $solicitudes->Fecha_solicitud = now();
                $solicitudes->Status_solicitud = true;
                $solicitudes->Tipo_Solicitud_idTipo_Solicitud = $request->tipo_solicitud;
                $solicitudes->save();
                $empresas_servicios->solicitudes_contratos()->save($solicitudes);
                return redirect()->route('solicitudes.index')->with('success', 'Solicitud para Servicios por Empresas creada exitosamente.');
            default:
                return redirect()->route('solicitudes.index')->with('error', 'Tipo de solicitud no válido.');
        }
    }

    // SolicitudesContratoController.php
    public function generarcontrato($id) {}

    public function show($id)
    {
        // Obtener la solicitud por ID
        $solicitud = SolicitudesContrato::findOrFail($id);
        $personaservicio = null;
        $empresas_servicios = null;
        $persona_ps = null;
        $servicio_ps = null;
        $ps = null;
        $es = null;

        switch ($solicitud->Tipo_Solicitud_idTipo_Solicitud) {
            case 1:
                // Agregar Logica entre EmpleadosFijos y Solicitudes
                $check = 1;
            case 2:
                $personaservicio = PersonasHasServicio::where('id_Personas_has_Servicios', $solicitud->id_Personas_has_Servicios_)->get();

                foreach ($personaservicio as $ps) {
                    $persona_ps = $ps->persona;
                    $servicio_ps = $ps->servicio;
                }

            case 3:
                $empresas_servicios = EmpresasHasServicio::where('idEmpresas_has_Servicioscol', $solicitud->Empresas_has_Servicios_idEmpresas_has_Servicioscol)->get();
                foreach ($empresas_servicios as $es) {
                    $empresa_es = $es->empresa;
                    $servicio_es = $es->servicio;
                }
        }
        return view('modules.solicitudes.show', compact('solicitud', 'empresas_servicios', 'ps', 'servicio_ps', 'persona_ps', 'es', 'empresa_es', 'servicio_es'));
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


    public function generateContract($id)
    {
        // Obtener la solicitud por ID
        $solicitud = SolicitudesContrato::findOrFail($id);
        // Validar el tipo de contrato y seleccionar la vista

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
            default:
                abort(404, 'Tipo de contrato no válido.');
        }

        // $solicitud = SolicitudesContrato::with([
        //     'personas_has_servicio',
        //     'empresas_has_servicio',
        //     'tipo_solicitud',
        //     'contratos'
        // ])->findOrFail($id);
        // Elige la vista basada en el tipo de solicitud
        // $view = 'modules.contratos.default_contract_template'; // Vista por defecto si no se encuentra una específica
        // switch ($solicitud->Tipo_Solicitud_idTipo_Solicitud) {
        //     case 1:
        //         $view = 'modules.contratos.fixed_contract_template';
        //         break;
        //     case 2:
        //         $view = 'modules.contratos.task_contract_template';
        //         break;
        //     case 3:
        //         $view = 'modules.contratos.company_contract_template';
        //         break;
        // }

        $pdf = \PDF::loadView($view, ['solicitud' => $solicitud]);

        return $pdf->download('contrato_' . $id . '.pdf');
    }
}
