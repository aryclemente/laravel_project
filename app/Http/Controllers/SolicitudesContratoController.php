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
        //$solicitudes = SolicitudesContrato::all();
        $solicitudes = SolicitudesContrato::where('Status_solicitud', true)->get();
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
                $empleadoFijo = new Trabajadores();
                $empleadoFijo->Cargos_idCargos   = $request->cargos_id;
                $empleadoFijo->Personas_idPersonas  = $request->personas_id;
                $empleadoFijo->Status_Trabajador = true;
                $empleadoFijo->Codigo_Trabajador = null;
                //$empleadoFijo->Turnos_idTurnos = $request->turnos_id;
                $empleadoFijo->save();
                // Crear la solicitud de contrato para empleado fijo
                $solicitudes->Fecha_solicitud = now();
                $solicitudes->Status_solicitud = true;
                $solicitudes->Tipo_Solicitud_idTipo_Solicitud = $request->tipo_solicitud;
                $solicitudes->trabajadores()->associate($empleadoFijo);

                $solicitudes->save();
                return redirect()->route('solicitudes.show', $solicitudes->idSolicitud)->with('success', 'Solicitud para empleado fijo creada exitosamente.');
            case 2:
                // Validar los datos necesarios para el Personal A destajo
                $request->validate([
                    'personas_id_2' => 'required|integer|gt:0|exists:personas_has_servicios,Personas_idPersonas',
                    'servicio_id' => 'required|integer|gt:0|exists:personas_has_servicios,Servicios_idServicio',
                    'costo_servicio' => 'required|numeric|gt:0',
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
                return redirect()->route('solicitudes.show', $solicitudes->idSolicitud)->with('success', 'Solicitud de Personal a Destajo creada exitosamente.');
            case 3:
                $request->validate([
                    'empresa_id' => 'required|integer|exists:empresas_has_servicios,Empresas_idEmpresa',
                    'servicio_id_3' => 'required|integer|gt:0|exists:empresas_has_servicios,Servicios_idServicio',
                    'costo_servicio_3' => 'required|numeric|gt:0',
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
                return redirect()->route('solicitudes.show', $solicitudes->idSolicitud)->with('success', 'Solicitud para Servicios por Empresas creada exitosamente.');
            default:
                return redirect()->route('solicitudes.index')->with('error', 'Tipo de solicitud no válido.');
        }
    }

    // SolicitudesContratoController.php
    public function generarcontrato($id)
    {
        $solicitud = SolicitudesContrato::findOrFail($id);
        $tipos = TipoSolicitud::where('idTipo_Solicitud', $solicitud->Tipo_Solicitud_idTipo_Solicitud)->get();
        $tipo = null;
        if ($tipos->isNotEmpty()) {
            $tipo = $tipos->first(); // Obtener el primer resultado
        }
        $personaservicio = null;
        $empresas_servicios = null;
        $persona_ps = null;
        $servicio_ps = null;
        $empresa_es = null;
        $servicio_es = null;
        $ps = null;
        $es = null;
        $persona = null;
        $cargo = null;
        $turno = null;

        switch ($solicitud->Tipo_Solicitud_idTipo_Solicitud) {
            case 1:
                // Agregar Logica entre EmpleadosFijos y Solicitudes
                $check = 1;
            case 2:
                $personaservicio = PersonasHasServicio::where('id_Personas_has_Servicios', $solicitud->id_Personas_has_Servicios_)->get();
                if ($personaservicio->isNotEmpty()) {
                    $ps = $personaservicio->first(); // Obtener el primer resultado
                    $persona_ps = $ps->persona;
                    $servicio_ps = $ps->servicio;
                }


            case 3:
                $empresas_servicios = EmpresasHasServicio::where('idEmpresas_has_Servicioscol', $solicitud->Empresas_has_Servicios_idEmpresas_has_Servicioscol)->get();
                if ($empresas_servicios->isNotEmpty()) {
                    $es = $empresas_servicios->first(); // Obtener el primer resultado
                    $empresa_es = $es->empresa;
                    $servicio_es = $es->servicio;
                }
        }

        //dd($solicitud, $ps, $servicio_ps, $persona_ps, $es, $empresa_es, $servicio_es, $tipo, $persona, $cargo, $turno);
        return view('modules.contratos.create', compact('solicitud', 'ps', 'servicio_ps', 'persona_ps', 'es', 'empresa_es', 'servicio_es', 'tipo', 'persona', 'cargo', 'turno'));
    }

    public function show($id)
    {
        // Obtener la solicitud por ID
        $solicitudes = SolicitudesContrato::findOrFail($id);
        $personaservicio = null;
        $empresas_servicios = null;
        $persona_ps = null;
        $servicio_ps = null;
        $empresa_es = null;
        $servicio_es = null;
        $ps = null;
        $es = null;
        $empleadoFijo = null;
        $cargo = null;
        $persona = null;
        $turno = null;

        switch ($solicitudes->Tipo_Solicitud_idTipo_Solicitud) {
            case 1:
                $empleadoFijos = Trabajadores::where('idTrabajador', $solicitudes->id_Trabajador_id)->get();
                $empleadoFijo = $empleadoFijos->first();

                //$cargos = $empleadoFijo->cargo();

                $cargos = Cargo::where('idCargos', $empleadoFijo->Cargos_idCargos)->get();
                $cargo = $cargos->first();
                $personas = Persona::where('idPersonas', $empleadoFijo->Personas_idPersonas)->get();
                $persona = $personas->first();

            case 2:
                $personaservicio = PersonasHasServicio::where('id_Personas_has_Servicios', $solicitudes->id_Personas_has_Servicios_)->get();

                foreach ($personaservicio as $ps) {
                    $persona_ps = $ps->persona;
                    $servicio_ps = $ps->servicio;
                }

            case 3:
                $empresas_servicios = EmpresasHasServicio::where('idEmpresas_has_Servicioscol', $solicitudes->Empresas_has_Servicios_idEmpresas_has_Servicioscol)->get();
                foreach ($empresas_servicios as $es) {
                    $empresa_es = $es->empresa;
                    $servicio_es = $es->servicio;
                }
        }
        return view('modules.solicitudes.show', compact('solicitudes', 'empresas_servicios', 'ps', 'servicio_ps', 'persona_ps', 'es', 'empresa_es', 'servicio_es', 'empleadoFijo', 'cargo', 'persona', 'turno'));
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
        $empresa_es = null;
        $servicio_es = null;
        $ps = null;
        $es = null;
        switch ($solicitud->Tipo_Solicitud_idTipo_Solicitud) {
            case 1:
                // Obtener los datos relacionados con la solicitud
                // $empresaservicio = EmpresasHasServicio::where('idEmpresas_has_Servicioscol ', $solicitud->Empresas_has_Servicios_idEmpresas_has_Servicioscol)->get();
                // if ($empresaservicio->isNotEmpty()) {
                //     $es = $empresaservicio->first(); // Obtener el primer resultado
                //     $empresa_es = $es->persona;
                //     $servicio_es = $es->servicio;
                // }
                // // Pasar las variables a la vista
                // return view('modules/solicitudes/edit', compact('solicitud', 'tiposolicitud', 'personas', 'servicios', 'turnos', 'cargos', 'empresas', 'persona_ps', 'servicio_ps', 'ps', 'es', '$empresa_es', 'servicio_es'));
                $solicitudes->save();
            case 2:
                // Obtener los datos relacionados con la solicitud
                $personaservicio = PersonasHasServicio::where('id_Personas_has_Servicios', $solicitud->id_Personas_has_Servicios_)->get();
                if ($personaservicio->isNotEmpty()) {
                    $ps = $personaservicio->first(); // Obtener el primer resultado
                    $persona_ps = $ps->persona;
                    $servicio_ps = $ps->servicio;
                }
                // Pasar las variables a la vista

            case 3:
                // Obtener los datos relacionados con la solicitud

                $empresaservicio = EmpresasHasServicio::where('idEmpresas_has_Servicioscol', $solicitud->Empresas_has_Servicios_idEmpresas_has_Servicioscol)->get();
                $es = $empresaservicio->first(); // Obtener el primer resultado
                $empresa_es = $es->empresa;
                $servicio_es = $es->servicio;
                //dd($id, $solicitud, $es, $empresa_es, $servicio_es);


        }
        // Pasar las variables a la vista

        return view('modules/solicitudes/edit', compact('solicitud', 'personas', 'tiposolicitud',  'servicios', 'persona_ps', 'servicio_ps', 'ps',  'empresas', 'es', 'empresa_es', 'servicio_es', 'cargos', 'turnos'));
    }

    public function update(Request $request, string $id)
    {
        // Encontrar la solicitud por ID
        $solicitud = SolicitudesContrato::findOrFail($id);
        switch ($solicitud->Tipo_Solicitud_idTipo_Solicitud) {
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
                $solicitud->Fecha_solicitud = now();
                $solicitud->Status_solicitud = true;
                $solicitud->Tipo_Solicitud_idTipo_Solicitud = $request->tipo_solicitud;
                $solicitud->save();
                return redirect()->route('solicitudes.index')->with('success', 'Solicitud para empleado fijo creada exitosamente.');
            case 2:
                // Validar los datos necesarios para el Personal A destajo
                $request->validate([
                    'personas_id_2' => 'required|integer|gt:0|exists:personas_has_servicios,Personas_idPersonas',
                    'servicio_id' => 'required|integer|gt:0|exists:personas_has_servicios,Servicios_idServicio',
                    'costo_servicio' => 'required|numeric|gt:0',
                ]);
                // Crear y guardar un nuevo registro en PersonasHasServicio
                $personas_servicios = new PersonasHasServicio();
                $personas_servicios->Servicios_idServicio = $request->servicio_id;
                $personas_servicios->Personas_idPersonas = $request->personas_id_2;
                $personas_servicios->Costo_Servicio = $request->costo_servicio;
                $personas_servicios->save();
                // Asociar el registro con la solicitud
                $solicitud->Fecha_solicitud = now();
                $solicitud->Status_solicitud = true;
                $solicitud->Tipo_Solicitud_idTipo_Solicitud = $request->tipo_solicitud;
                $solicitud->save();
                $personas_servicios->solicitudes_contratos()->save($solicitud);
                return redirect()->route('solicitudes.show', $solicitud->idSolicitud)->with('success', 'Solicitud de Personal a Destajo creada exitosamente.');
            case 3:
                $request->validate([
                    'empresa_id' => 'required|integer|exists:empresas_has_servicios,Empresas_idEmpresa',
                    'servicio_id_3' => 'required|integer|gt:0|exists:empresas_has_servicios,Servicios_idServicio',
                    'costo_servicio_3' => 'required|numeric|gt:0',
                ]);
                // Crear y guardar un nuevo registro en EmpresasHasServicio
                $empresas_servicios = new EmpresasHasServicio();
                $empresas_servicios->Servicios_idServicio = $request->servicio_id_3;
                $empresas_servicios->Empresas_idEmpresa = $request->empresa_id;
                $empresas_servicios->Costo_Servicio = $request->costo_servicio_3;
                $empresas_servicios->save();
                // Asociar el registro con la solicitud
                $solicitud->Fecha_solicitud = now();
                $solicitud->Status_solicitud = true;
                $solicitud->Tipo_Solicitud_idTipo_Solicitud = $request->tipo_solicitud;
                $solicitud->save();
                $empresas_servicios->solicitudes_contratos()->save($solicitud);
                return redirect()->route('solicitudes.show', $solicitud->idSolicitud)->with('success', 'Solicitud para Servicios por Empresas creada exitosamente.');
            default:
                return redirect()->route('solicitudes.index')->with('error', 'Tipo de solicitud no válido.');
        }
        // Validar los datos recibidos
        $validatedData = $request->validate([
            'tipo_solicitud' => 'required|integer|exists:tipo_solicitud,idTipo_Solicitud|gt:0',
            'personas_id' => 'required|integer|exists:personas_has_servicios,Personas_idPersonas|gt:0',
            'cargos_id' => 'nullable|integer|exists:cargos,idCargos|gt:0',
            'turnos_id' => 'nullable|integer|exists:turnos,idTurnos|gt:0',
            'servicio_id' => 'nullable|integer|exists:personas_has_servicios,Servicios_idServicio|gt:0',
            'costo_servicio' => 'nullable|numeric|exists:personas_has_servicios,Costo_Servicio|gt:0',
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
        return redirect()->route('solicitudes.show', $solicitud->idSolicitud)->with('success', 'Solicitud actualizada correctamente.');
    }

    public function desactivar($id)
    {
        $solicitud = SolicitudesContrato::findOrFail($id);
        if ($solicitud->Status_solicitud === false) {
            $solicitud->Status_solicitud = true;
            $solicitud->update();
        } else {
            $solicitud->Status_solicitud = false;
            $solicitud->update();
        }
        return redirect()->route('solicitudes.index')->with('success', 'Solicitud eliminada con éxito.');
    }

    public function deleteshow()
    {
        $tiposolicitud = TipoSolicitud::all();
        //$solicitudes = SolicitudesContrato::all();
        //dd($tiposolicitud, $solicitudes);
        $solicitudes = SolicitudesContrato::where('Status_solicitud', false)->get();


        return view('modules/solicitudes/deleteshow', compact('solicitudes', 'tiposolicitud'));
    }

    public function fijo()
    {
        $tiposolicitud = TipoSolicitud::all();
        //$solicitudes = SolicitudesContrato::all();
        $solicitudes = SolicitudesContrato::where('Tipo_Solicitud_idTipo_Solicitud', 1)->get();
        $cargos = Cargo::all();
        $servicios = Servicio::all();
        return view('modules/solicitudes/index', compact('solicitudes', 'tiposolicitud'));
    }

    public function destajo()
    {
        $tiposolicitud = TipoSolicitud::all();
        //$solicitudes = SolicitudesContrato::all();
        $solicitudes = SolicitudesContrato::where('Tipo_Solicitud_idTipo_Solicitud', 2)->get();
        $cargos = Cargo::all();
        $servicios = Servicio::all();
        return view('modules/solicitudes/index', compact('solicitudes', 'tiposolicitud'));
    }

    public function empresas()
    {
        $tiposolicitud = TipoSolicitud::all();
        //$solicitudes = SolicitudesContrato::all();
        $solicitudes = SolicitudesContrato::where('Tipo_Solicitud_idTipo_Solicitud', 3)->get();
        $cargos = Cargo::all();
        $servicios = Servicio::all();
        return view('modules/solicitudes/index', compact('solicitudes', 'tiposolicitud'));
    }
}
