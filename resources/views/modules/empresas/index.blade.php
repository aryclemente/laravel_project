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
                <caption>Lista de Empresas</caption>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>RIF</th>
                        <th>Direccion</th>
                        <th>Telefono</th>
                        <th>Status</th>


                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    @foreach ($empresas as $empresa)
                        <tr>
                            <td class="table-info text-center">


                                {{ $empresa->idEmpresa }}

                            </td>


                            <td class="">
                                {{ $empresa->Nombre_Empresa }}
                            </td>
                            <td>
                                {{ $empresa->RIF }}
                            </td>
                            <td>
                                {{ $empresa->Dirección }}
                            </td>
                            <td>
                                {{ $empresa->Teléfono }}
                            </td>
                            <td>
                                {{ $empresa->Status_idStatus === 1 ? 'Activa' : 'No Disponible' }}

                            </td>



                        </tr>
                    @endforeach
                </tbody>
            </table>



        </div>

    </main>
@endsection
