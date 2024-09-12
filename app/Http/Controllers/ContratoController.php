<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrato;
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
        return view('modules.contratos.index', compact('contratos'));
    }

    public function store(Request $request, string $id)
    {
        $solicitud = SolicitudesContrato::findOrFail($id);
        $request->validate([

            'fecha_inicio' => 'required|exists:personas_has_servicios,Servicios_idServicio',
            'fecha_final' => 'required|numeric',
        ]);
        switch ($solicitud->Tipo_Solicitud_idTipo_Solicitud) {
            case 1:
                // Agregar Logica entre EmpleadosFijos y Solicitudes
                $check = 1;
            case 2:
                $request->validate([
                    'remuneracion_ps' => 'required|exists:contratos,Remuneración',

                ]);
                $contrato = new Contrato();
                $contrato->Fecha_Inicio = $request->fecha_inicio;
                $contrato->Fecha_Fin = $request->fecha_final;
                $contrato->Remuneración = $request->remuneracion_ps;
                $contrato->Status_Contrato = true;
                $contrato->Solicitudes_contratos_idSolicitud = $request->tipo_solicitud;
                $solicitud->contratos()->save($contrato);
                dd($solicitud, $contrato, $request, $id);


            case 3:
                $empresas_servicios = EmpresasHasServicio::where('idEmpresas_has_Servicioscol', $solicitud->Empresas_has_Servicios_idEmpresas_has_Servicioscol)->get();
                if ($empresas_servicios->isNotEmpty()) {
                    $es = $empresas_servicios->first(); // Obtener el primer resultado
                    $empresa_es = $es->empresa;
                    $servicio_es = $es->servicio;
                }
        }



        // $contrato = new Contrato();
        // $contrato->nombre = $validatedData['nombre'];
        // $contrato->tipo_contrato = $validatedData['tipo_contrato'];
        // $contrato->estado = $request->accion === 'guardar' ? 'activo' : 'borrador';
        // // Asignar otros atributos según el tipo de contrato

        // $contrato->save();

        return redirect()->route('dashboard');
    }

    public function show(string $id)
    {
        return view('contratos.show', compact('contrato'));
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
}
