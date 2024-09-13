@extends('layouts/main')
@section('contenido')
    <header>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="container p-3">
            <blockquote class="blockquote py-2">
                <p>Solicitudes</p>
            </blockquote>
            <div class="row">
                <div class="col ">
                    <button onclick="window.location.href='{{ route('solicitudes.create') }}'" type="button"
                        class="btn btn-outline-success">Nueva
                        Solicitud</button>
                </div>
            </div>
        </div>


    </header>

    <main>
        <div class="table-responsive py-6 px-4">
            <table class="table caption">
                <caption>Lista de solicitudes</caption>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Tipo_Solicitud</th>
                        <th>Status</th>
                        <th>Acciones</th>

                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($solicitudes as $solicitud)
                        <tr>
                            <td class="table-info text-center">


                                {{ $solicitud->idSolicitud }}

                            </td>


                            <td class="">
                                {{ $solicitud->Fecha_solicitud->format('d/m/Y') }}
                            </td>
                            <td>
                                {{ $solicitud->tipo_solicitud ? $solicitud->tipo_solicitud->Tipo_Solicitud : 'Sin tipo de solicitud' }}
                            </td>
                            <td class="">
                                {{ $solicitud->Status_solicitud === true ? 'Activa' : 'Desactivado' }}
                            </td>
                            <td class="text-center">
                                <a class="btn btn-outline-success"
                                    href="{{ route('solicitudes.generarcontrato', $solicitud->idSolicitud) }}">
                                    Generar Contrato
                                </a>
                                <a class="btn btn-outline-info"
                                    href="{{ route('solicitudes.show', $solicitud->idSolicitud) }}">
                                    Mostrar
                                </a>
                                <a class="btn btn-outline-warning"
                                    href="{{ route('solicitudes.edit', $solicitud->idSolicitud) }}">
                                    Modificar
                                </a>
                                <form action="{{ route('solicitudes.desactivar', ['id' => $solicitud->idSolicitud]) }}"
                                    method="POST" style="display:inline;"
                                    onsubmit="return confirm('¿Estás seguro de que quieres eliminar esta solicitud?');">
                                    @csrf
                                    <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                                </form>
                            </td>


                        </tr>
                    @endforeach
                </tbody>
            </table>
            <a class="btn btn-outline-danger" href="{{ route('solicitudes.deleteshow') }}">
                Solicitudes Eliminadas
            </a>
            <div class="contaniner p-4">
                <table class="table caption">
                    <caption>Lista de Tipo de solicitudes</caption>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($tiposolicitud as $tipo)
                            <tr>
                                <td class="table-info text-center">{{ $tipo->idTipo_Solicitud }}</td>
                                <td class="">{{ $tipo->Tipo_Solicitud }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </main>
@endsection
