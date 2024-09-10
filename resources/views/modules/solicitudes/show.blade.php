@extends('layouts/main')

@section('contenido')
    <header>
        <div class="container py-3">
            <h1>Detalles de la Solicitud</h1>
        </div>
    </header>

    <main>
        <div class="container py-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Solicitud #{{ $solicitud->idSolicitud }}</h5>
                </div>
                <div class="card-body">
                    <p><strong>ID:</strong> {{ $solicitud->idSolicitud }}</p>
                    <p><strong>Fecha:</strong> {{ $solicitud->Fecha_solicitud->format('d/m/Y') }}</p>
                    <p><strong>Tipo de Solicitud:</strong>
                        {{ $solicitud->tipo_solicitud ? $solicitud->tipo_solicitud->Tipo_Solicitud : 'No definido' }}</p>

                    <!-- Añadir más detalles según sea necesario -->
                    @if ($solicitud->Tipo_Solicitud_idTipo_Solicitud == 1)
                        <p><strong>Persona:</strong> {{ $solicitud->persona ? $solicitud->persona->nombre : 'No definido' }}
                        </p>
                        <p><strong>Cargo:</strong> {{ $solicitud->cargo ? $solicitud->cargo->nombre : 'No definido' }}</p>
                        <p><strong>Turno:</strong> {{ $solicitud->turno ? $solicitud->turno->nombre : 'No definido' }}</p>
                    @elseif($solicitud->Tipo_Solicitud_idTipo_Solicitud == 2)
                        <p><strong>Servicio:</strong>
                            {{ $servicio_ps->Nombre_Servicio ? $servicio_ps->Nombre_Servicio : 'No definido' }}
                        </p>
                        <p><strong>Costo del Servicio:</strong>
                            {{ $personaservicio->Costo_Servicio ? $personaservicio->Costo_Servicio : 'No definido' }}</p>
                    @elseif($solicitud->Tipo_Solicitud_idTipo_Solicitud == 3)
                        <p><strong>Empresa:</strong> {{ $solicitud->empresa ? $solicitud->empresa->nombre : 'No definido' }}
                        </p>
                        <p><strong>Servicio:</strong>
                            {{ $solicitud->servicio ? $solicitud->servicio->nombre : 'No definido' }}</p>
                        <p><strong>Costo del Servicio:</strong>
                            {{ $solicitud->costo_servicio ? $solicitud->costo_servicio : 'No definido' }}</p>
                    @endif
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('solicitudes.index') }}" class="btn btn-primary">Volver a la lista</a>
                    <a href="{{ route('solicitudes.edit', $solicitud->idSolicitud) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('solicitudes.destroy', $solicitud->idSolicitud) }}" method="POST"
                        style="display:inline;"
                        onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta solicitud?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
