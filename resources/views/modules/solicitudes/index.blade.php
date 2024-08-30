@extends('layouts/main')
@section('contenido')
    <header>

        <div class="container p-3">
            <blockquote class="blockquote py-2">
                <p>Personal Fijo</p>
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
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($solicitudes as $solicitud)
                        <tr>
                            <td>{{ $solicitud->id }}</td>
                            <td>{{ $solicitud->fecha }}</td>
                            <td>

                                <button type="submit" class="btn btn-outline-danger">Eliminar</button>

                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </main>
@endsection
