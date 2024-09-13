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
    </header>

    <main>
        <div class="table-responsive py-6 px-4">
            <table class="table caption">
                <caption>Lista de Servicios</caption>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripcion</th>


                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($servicios as $servicio)
                        <tr>
                            <td class="table-info text-center">


                                {{ $servicio->idServicio }}

                            </td>


                            <td class="">
                                {{ $servicio->Nombre_Servicio }}
                            </td>
                            <td>
                                {{ $servicio->Descripción_Servicio }}
                            </td>



                        </tr>
                    @endforeach
                </tbody>
            </table>



        </div>

    </main>
@endsection
