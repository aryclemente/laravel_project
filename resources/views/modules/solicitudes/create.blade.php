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
                                <option>Personal Fijo</option>
                                <option>A Destajo</option>
                                <option>Empresas</option>
                            </select>
                            <div class="invalid-tooltip">
                                Por favor selecciona un tipo de solicitud.
                            </div>
                        </div>
                        <div class="col-md-4 position-relative">
                            <label for="validationTooltip01" class="form-label">Servicio</label>
                            <select class="form-select" id="servicio_id" name="servicio_id" required>
                                <option selected disabled value="">Elegir</option>
                                @foreach ($servicios as $servicio)
                                    <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
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
                            <label for="validationTooltip01" class="form-label">Personas</label>
                            <select class="form-select" id="trabajador_id" name="trabajador_id" required>
                                <option selected disabled value="">Elegir</option>
                                @foreach ($trabajadores as $trabajador)
                                    <option value="{{ $trabajador->id }}">{{ $trabajador->nombre }}
                                        {{ $trabajador->apellido }}</option>
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
                            <label for="validationTooltip02" class="form-label">Fecha_Inicio</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" required>
                            </div>
                            <div class="valid-tooltip">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-4 position-relative">
                            <label for="validationTooltipUsername" class="form-label">Fecha_final</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                <input type="date" id="fecha_final" name="fecha_final" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6 position-relative">
                            <label for="validationTooltip03" class="form-label">Remuneracion</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">$</span>
                                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                                <span class="input-group-text">.00</span>
                            </div>
                            <div class="invalid-tooltip">
                                Please provide a valid city.
                            </div>
                        </div>

                        <div class="col-md-3 position-relative">
                            <label for="validationTooltip05" class="form-label">Empresa</label>
                            <select class="form-select" id="empresa_id" name="empresa_id" required>
                                @foreach ($empresas as $empresa)
                                    <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                                @endforeach
                            </select>
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
