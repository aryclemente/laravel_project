<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrato;
use App\Rules\AcceptedTerms;
use Carbon\Carbon;

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

class ContratoController extends Controller
{
    public function index()
    {
        $contratos = Contrato::all();
        $solicitudes = SolicitudesContrato::all();
        $tipos = TipoSolicitud::all();
        return view('modules.contratos.index', compact('contratos', 'solicitudes', 'tipos'));
    }

    public function store(Request $request, string $id)
    {
        $solicitud = SolicitudesContrato::findOrFail($id);

        $request->validate([
            'fecha_inicio' => 'required|date|after:today',
            'fecha_final' => 'required|date|after:today',
            'acepto_terminos' => ['required', new AcceptedTerms],
        ]);

        $contrato = new Contrato();
        $contrato->Fecha_Inicio = $request->fecha_inicio;
        $contrato->Fecha_Fin = $request->fecha_final;

        switch ($solicitud->Tipo_Solicitud_idTipo_Solicitud) {
            case 1:
                // Agregar Logica entre EmpleadosFijos y Solicitudes
                $check = 1;
            case 2:
                $request->validate([
                    'remuneracion_ps' => 'required',
                ]);
                $contrato->Remuneración = $request->remuneracion_ps;
                $contrato->Status_Contrato = true;
                $contrato->Solicitudes_contratos_idSolicitud = $solicitud->idSolicitud;
                $contrato->save();
                return redirect()->route('contratos.index');
            case 3:
                $request->validate([
                    'remuneracion_es' => 'required|numeric|min:0',
                ]);
                $contrato->Remuneración = $request->remuneracion_es;
                $contrato->Status_Contrato = true;
                $contrato->Solicitudes_contratos_idSolicitud = $solicitud->idSolicitud;
                $contrato->save();
                return redirect()->route('contratos.index');
        }
    }

    public function show(string $id)
    {
        $solicitud = SolicitudesContrato::findOrFail($id);
        $contratos = Contrato::where('Solicitudes_contratos_idSolicitud', $id)->get();
        if ($contratos->isNotEmpty()) {
            $contrato = $contratos->first(); // Obtener el primer resultado
        }

        $personaservicio = null;
        $empresas_servicios = null;
        $persona_ps = null;
        $servicio_ps = null;
        $empresa_es = null;
        $servicio_es = null;
        $ps = null;
        $es = null;

        switch ($solicitud->Tipo_Solicitud_idTipo_Solicitud) {
            case 1:
                // Agregar Logica entre EmpleadosFijos y Solicitudes
                $check = 1;
            case 2:
                $personaservicio = PersonasHasServicio::where('id_Personas_has_Servicios', $solicitud->id_Personas_has_Servicios_)->get();

                if ($personaservicio->isNotEmpty()) {
                    $ps = $personaservicio->first(); //
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
        //dd($solicitud, $contrato, $ps, $persona_ps, $servicio_ps);
        return view('modules.contratos.show', compact('solicitud', 'contrato', 'ps', 'servicio_ps', 'persona_ps', 'es', 'empresa_es', 'servicio_es'));
    }

    public function edit(string $id)
    {
        return view('contratos.edit', compact('contrato'));
    }

    public function finalizar(string $id)
    {
        $contrato = Contrato::FindOrFail($id);
        $contrato->estado = 'finalizado';
        $contrato->save();

        return redirect()->route('contratos.index');
    }

    public function ContractPDF($id)
    {
        // Obtener la solicitud por ID
        $contrato = Contrato::findOrFail($id);
        $solicitudes = SolicitudesContrato::where('idSolicitud', $contrato->Solicitudes_contratos_idSolicitud)->get();
        if ($solicitudes->isNotEmpty()) {
            $solicitud = $solicitudes->first(); // Obtener el primer resultado

        }

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

        $pdf = \PDF::loadView($view, ['solicitud' => $solicitud], ['contrato' => $contrato]);

        return $pdf->download('contrato_' . $id . '.pdf');
    }
}
