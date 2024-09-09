@extends('layouts.main')
@section('contenido')
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-6">Historial de Contratos</h1>

        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Tipo de Contrato</th>
                    <th class="py-2 px-4 border-b">Estado</th>
                    <th class="py-2 px-4 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contratos as $contrato)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $contrato->idContratos }}</td>
                        <td class="py-2 px-4 border-b">
                            {{ $contrato->tipo_solicitud ? $contrato->tipo_solicitud->Tipo_Solicitud : 'Sin tipo de solicitud' }}
                        </td>
                        <td class="py-2 px-4 border-b">{{ $contrato->Status_Contrato }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('contratos.show', $contrato->idContratos) }}" class="text-blue-500">Ver</a>
                            <a href="{{ route('contratos.edit', $contrato->idContratos) }}" class="text-blue-500">Editar</a>
                            <form action="{{ route('contratos.finalizar', $contrato->idContratos) }}" method="POST"
                                class="inline">
                                @csrf
                                <button type="submit" class="text-red-500">Finalizar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
