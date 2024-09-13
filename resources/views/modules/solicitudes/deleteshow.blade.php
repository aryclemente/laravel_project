@extends('layouts/main')
@section('contenido')
    <header>
        <div class="container p-3">
            <blockquote class="blockquote py-2">
                <p>Lista de Borrados</p>
            </blockquote>
        </div>


    </header>
    <main>
        <div class="table-responsive py-6 px-4">
            <table class="table caption">
                <caption>Lista de solicitudes eliminadas</caption>
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

                                <a class="btn btn-outline-info"
                                    href="{{ route('solicitudes.show', $solicitud->idSolicitud) }}">
                                    Mostrar
                                </a>

                                <form action="{{ route('solicitudes.desactivar', ['id' => $solicitud->idSolicitud]) }}"
                                    method="POST" style="display:inline;"
                                    onsubmit="return confirm('¿Estás seguro de que quieres restaurar esta solicitud?');">
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
