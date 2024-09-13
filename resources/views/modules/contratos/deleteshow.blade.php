@extends('layouts/main')
@section('contenido')
    <header>
        <div class="container p-3">
            <blockquote class="blockquote py-2">
                <p>Contratos Finalizados</p>
            </blockquote>
        </div>


    </header>
    <main>
        <div class="table-responsive py-6 px-4">
            <table class="table caption">
                <caption>Lista de Contratos Finalizados</caption>
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
                <tbody class="table-group-divider">
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

                        <td class="py-2 px-4 border-b">
                            {{ $contrato->Status_Contrato === true ? 'Activa' : 'Desactivado' }}
                        </td>
                        <td class="py-2 px-4 border-b">{{ $contrato->Fecha_Inicio->format('d/m/Y') }}</td>
                        <td class="py-2 px-4 border-b">{{ $contrato->Fecha_Fin->format('d/m/Y') }}</td>

                        <td class="py-2 px-4 border-b">
                            <a class="btn btn-outline-success"
                                href="{{ route('contratos.ContractPDF', $contrato->idContratos) }}">Descargar
                                PDF</a>
                            <a href="{{ route('contratos.show', $contrato->idContratos) }}" class="btn btn-outline-info">Ver
                                Detalle</a>

                            <form action="{{ route('contratos.finalizar', $contrato->idContratos) }}" method="POST"
                                class="inline">
                                @csrf
                                <button type="submit" class="btn btn-outline-danger">Restaurar</button>
                            </form>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>


        </div>

    </main>
@endsection
