@extends('layouts/main')

@section('contenido')
    <header>
        <div class="container py-3">
            <h1>Detalles de la Solicitud</h1>
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
                    <h5 class="card-title">Solicitud #{{ $solicitudes->idSolicitud }}</h5>
                </div>
                <div class="card-body">
                    <p><strong>ID:</strong> {{ $solicitudes->idSolicitud }}</p>
                    <p><strong>Fecha:</strong> {{ $solicitudes->Fecha_solicitud->format('d/m/Y') }}</p>
                    <p><strong>Tipo de Solicitud:</strong>

                        {{ $solicitudes->tipo_solicitud ? $solicitudes->tipo_solicitud->Tipo_Solicitud : 'No definido' }}
                    </p>
                    <p><strong>Status:</strong>
                        {{ $solicitudes->Status_solicitud === true ? 'Activa' : 'Desactivado' }}
                        <!-- Añadir más detalles según sea necesario -->
                        @if ($solicitudes->Tipo_Solicitud_idTipo_Solicitud == 1)
                            <p><strong>Persona:</strong> {{ $persona ? $persona->Nombres : 'No definido' }}
                            </p>
                            <p><strong>Cargo:</strong> {{ $cargo ? $cargo->Nombre_Cargo : 'No definido' }}</p>
                            <p><strong>Turno:</strong> {{ $turno ? $turno->Nombre_Turno : 'No definido' }}</p>
                        @elseif($solicitudes->Tipo_Solicitud_idTipo_Solicitud == 2)
                            <p><strong>Servicio:</strong>
                                {{ $servicio_ps->Nombre_Servicio ? $servicio_ps->Nombre_Servicio : 'No definido' }}
                            </p>
                            <p><strong>Persona:</strong>
                                {{ $persona_ps->Nombres ? $persona_ps->Nombres : 'No definido' }}
                            </p>
                            <p><strong>Costo del Servicio:</strong>
                                {{ $ps->Costo_Servicio ? $ps->Costo_Servicio : 'No definido' }}</p>
                        @elseif($solicitudes->Tipo_Solicitud_idTipo_Solicitud == 3)
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
                    <a href="{{ route('solicitudes.index') }}" class="btn btn-outline-primary">Volver a la lista</a>
                    <a href="{{ route('solicitudes.edit', $solicitudes->idSolicitud) }}"
                        class="btn btn-outline-warning">Editar</a>
                    <form action="{{ route('solicitudes.desactivar', ['id' => $solicitudes->idSolicitud]) }}"
                        method="POST" style="display:inline;"
                        onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta solicitud?');">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
