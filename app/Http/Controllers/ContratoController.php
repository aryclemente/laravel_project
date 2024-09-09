<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contrato;
use App\Models\Trabajadores;

class ContratoController extends Controller
{
    public function index()
    {
        $contratos = Contrato::all();
        return view('modules.contratos.index', compact('contratos'));
    }

    public function create()
    {

        return view('contratos.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string',
            'tipo_contrato' => 'required|string',
            // Añadir validaciones específicas para cada tipo de contrato según los campos adicionales
        ]);

        $contrato = new Contrato();
        $contrato->nombre = $validatedData['nombre'];
        $contrato->tipo_contrato = $validatedData['tipo_contrato'];
        $contrato->estado = $request->accion === 'guardar' ? 'activo' : 'borrador';
        // Asignar otros atributos según el tipo de contrato

        $contrato->save();

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
