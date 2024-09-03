@extends('layouts/main')
@section('contenido')

    <body>
        <header class="p-2">
            <h3>Nueva Solicitud</h3>
        </header>
        <main class="p-4">
            <div class="card ">
                <div class="card-header">
                    Formulario
                </div>
                <div class="card-body">
                    <h5 class="card-title">Ingresa los datos de la solicitud</h5>
                    <p class="card-text">Recuerda revisar </p>

                    <form action="{{ route('solicitudes.store') }}" method="POST" class="row g-3 needs-validation" novalidate>
                        @csrf
                        @method('POST')
                        <div class="col-md-3 position-relative">
                            <label for="validationTooltip04" class="form-label">Tipo de Solicitud</label>
                            <select class="form-select" id="validationTooltip04" required>
                                <option selected disabled value="">Elegir</option>
                                @foreach ($tiposolicitud as $tipo)
                                    <option value="{{ $tipo->idTipo_Solicitud }}">{{ $tipo->Tipo_Solicitud }}</option>
                                @endforeach
                            </select>
                            <div class="valid-tooltip">
                                Excelente!
                            </div>
                            <div class="invalid-tooltip">
                                Por favor selecciona un tipo de solicitud.
                            </div>
                        </div>
                        <div class="col-md-4 position-relative">
                            <label for="validationTooltip01" class="form-label">Servicio</label>
                            <select class="form-select" id="servicio_id" name="servicio_id" required>
                                <option selected disabled value="">Elegir</option>
                                @foreach ($servicios as $servicio)
                                    <option value="{{ $servicio->idServicio }}">{{ $servicio->Nombre_Servicio }}</option>
                                @endforeach
                            </select>
                            <div class="valid-tooltip">
                                Excelente!
                            </div>
                            <div class="invalid-tooltip">
                                Por favor selecciona un servicio.
                            </div>
                        </div>



                        <div class="col-md-3 position-relative">
                            <label for="validationTooltip05" class="form-label">Empresa</label>
                            <select class="form-select" id="empresa_id" name="empresa_id" required>
                                <option selected disabled value="">Elegir</option>
                                @foreach ($empresas as $empresa)
                                    <option value="{{ $empresa->idEmpresa }}">{{ $empresa->Nombre_Empresa }}</option>
                                @endforeach
                            </select>
                            <div class="valid-tooltip">
                                Excelente!
                            </div>
                            <div class="invalid-tooltip">
                                Please provide a valid zip.
                            </div>
                        </div>





                        <div class="col-12">
                            <button class="btn btn-primary" type="submit">Registrar Solicitud</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="container p-2">
                <a class="btn btn-outline-info " href="{{ route('solicitudes.index') }}">Volver a la lista</a>
            </div>

        </main>
    @endsection
