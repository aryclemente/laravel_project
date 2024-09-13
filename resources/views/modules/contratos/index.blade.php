@extends('layouts.main')
@section('contenido')
    <div class="container mx-auto px-4">
        <h1 class="text-3xl font-bold mb-6">Historial de Contratos</h1>

        <table class="">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Tipo de Contrato</th>
                    <th class="py-2 px-4 border-b">Estado</th>
                    <th class="py-2 px-4 border-b">Fecha de Inicio</th>
                    <th class="py-2 px-4 border-b">Fecha de Vencimiento</th>
                    <th class="py-2 px-4 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contratos as $contrato)
                    <td class="py-2 px-4 border-b">{{ $contrato->idContratos }}</td>
                    @foreach ($solicitudes as $solicitud)
                        @foreach ($tipos as $tipo)
                            @if (
                                $contrato->Solicitudes_contratos_idSolicitud === $solicitud->idSolicitud &&
                                    $solicitud->Tipo_Solicitud_idTipo_Solicitud === $tipo->idTipo_Solicitud)
                                <td class="py-2 px-4 border-b">
                                    {{ $tipo->Tipo_Solicitud }}
                            @endif
                            </td>
                        @endforeach
                    @endforeach

                    <td class="py-2 px-4 border-b">{{ $contrato->Status_Contrato }}</td>
                    <td class="py-2 px-4 border-b">{{ $contrato->Fecha_Inicio->format('d/m/Y') }}</td>
                    <td class="py-2 px-4 border-b">{{ $contrato->Fecha_Fin->format('d/m/Y') }}</td>

                    <td class="py-2 px-4 border-b">
                        <a class="btn btn-outline-success"
                            href="{{ route('solicitudes.ContractPDF', $contrato->idContratos) }}">Descargar
                            PDF</a>
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
