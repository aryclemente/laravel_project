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
                <caption>Lista de Personas</caption>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Cedula</th>
                        <th>Correo Elctronico</th>
                        <th>Fecha de Nacimiento</th>
                        <th>Telefono</th>


                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($personas as $persona)
                        <tr>
                            <td class="table-info text-center">


                                {{ $persona->idPersonas }}

                            </td>


                            <td class="">
                                {{ $persona->Nombres }}
                                {{ $persona->Apellidos }}
                            </td>
                            <td>
                                {{ $persona->Cédula }}
                            </td>
                            <td>
                                {{ $persona->Fecha_Nacimiento->format('d/m/Y') }}
                            </td>
                            <td>
                                {{ $persona->Correo_Electrónico }}
                            </td>
                            <td>
                                {{ $persona->Teléfono }}
                            </td>




                        </tr>
                    @endforeach
                </tbody>
            </table>



        </div>

    </main>
@endsection
