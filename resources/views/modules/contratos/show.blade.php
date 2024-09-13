@extends('layouts/main')

@section('contenido')
    <header>
        <div class="container py-3">
            <h1>Detalles del Contrato</h1>
        </div>
    </header>

    <main>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="container py-4">
            <div class="card border-info">
                <div class="card-header border-info">
                    <h5 class="card-title">Contrato #{{ $contrato->idContratos }}</h5>
                </div>
                <div class="card-body">
                    <p><strong>Tipo de Solicitud:</strong>
                        {{ $solicitud->tipo_solicitud ? $solicitud->tipo_solicitud->Tipo_Solicitud : 'No definido' }}</p>

                    <p><strong>Fecha de Inicio:</strong> {{ $contrato->Fecha_Inicio->format('d/m/Y') }}</p>
                    <p><strong>Fecha de Final:</strong> {{ $contrato->Fecha_Fin->format('d/m/Y') }}</p>

                    <p><strong>Remuneracion:</strong> {{ $contrato->Remuneración }} $</p>


                    <!-- Añadir más detalles según sea necesario -->
                    @if ($solicitud->Tipo_Solicitud_idTipo_Solicitud == 1)
                        {{-- <p><strong>Persona:</strong> {{ $solicitud->persona ? $solicitud->persona->nombre : 'No definido' }}
                        </p>
                        <p><strong>Cargo:</strong> {{ $solicitud->cargo ? $solicitud->cargo->nombre : 'No definido' }}</p>
                        <p><strong>Turno:</strong> {{ $solicitud->turno ? $solicitud->turno->nombre : 'No definido' }}</p> --}}
                    @elseif($solicitud->Tipo_Solicitud_idTipo_Solicitud == 2)
                        <p><strong>Servicio:</strong>
                            {{ $servicio_ps->Nombre_Servicio ? $servicio_ps->Nombre_Servicio : 'No definido' }}
                        </p>
                        <p><strong>Persona:</strong>
                            {{ $persona_ps->Nombres ? $persona_ps->Nombres : 'No definido' }}
                        </p>
                    @elseif($solicitud->Tipo_Solicitud_idTipo_Solicitud == 3)
                        <p><strong>Empresa:</strong>
                            {{ $empresa_es->Nombre_Empresa ? $empresa_es->Nombre_Empresa : 'No definido' }}
                        </p>
                        <p><strong>Servicio:</strong>
                            {{ $servicio_es->Nombre_Servicio ? $servicio_es->Nombre_Servicio : 'No definido' }}</p>
                        <p><strong>Costo del Servicio:</strong>
                            {{ $es->Costo_Servicio ? $es->Costo_Servicio : 'No definido' }}
                        </p>
                    @endif
                </div>
                <div class="card-footer text-end">
                    <a class="btn btn-outline-success"
                        href="{{ route('contratos.ContractPDF', $contrato->idContratos) }}">Descargar
                        PDF</a>

                    <a href="{{ route('contratos.edit', $contrato->idContratos) }}"
                        class="btn btn-outline-warning">Editar</a>
                    <form action="{{ route('contratos.finalizar', ['id' => $contrato->idContratos]) }}" method="POST"
                        style="display:inline;"
                        onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta solicitud?');">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                    </form>
                    <a href="{{ route('contratos.index') }}" class="btn btn-outline-primary">Volver a la lista</a>
                </div>
            </div>
        </div>
    </main>
@endsection
