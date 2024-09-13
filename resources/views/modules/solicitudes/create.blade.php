@extends('layouts/main')
@section('contenido')

    <body>
        @stack('scripts')
        <header class="p-4">
            <h3>Nueva Solicitud</h3>
        </header>
        <main class="px-4 py-2">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card border-success">
                <div class="card-header border-success">
                    Formulario
                </div>
                <div class="card-body ">
                    <h5 class="card-title">Ingresa los datos de la solicitud</h5>
                    <p class="card-text">Recuerda revisar </p>

                    <form action="{{ route('solicitudes.store') }}" method="POST" class="row g-3 needs-validation"
                        novalidate>
                        @csrf
                        @method('POST')
                        <div class="col-md-3 position-relative ">
                            <label for="validationTooltip04" class="form-label">Tipo de Solicitud</label>
                            <select class="form-select" id="tipo_solicitud" name="tipo_solicitud" required>
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
                        {{-- Empleado Fijo --}}
                        <div id="empleadoFijoFields" style="display:none;">
                            <div class="col-md-4 position-relative">
                                <label for="validationTooltip01" class="form-label">Personas</label>
                                <select class="form-select" id="personas_id" name="personas_id" required>
                                    <option selected disabled value="">Elegir</option>
                                    @foreach ($personas as $persona)
                                        <option value="{{ $persona->idPersonas }}">{{ $persona->Nombres }}
                                            {{ $persona->Apellidos }}</option>
                                    @endforeach
                                </select>
                                <div class="valid-tooltip">
                                    Excelente!
                                </div>
                                <div class="invalid-tooltip">
                                    Por favor selecciona un tipo de solicitud.
                                </div>
                            </div>


                            <div class="col-md-3 position-relative">
                                <label for="validationTooltip05" class="form-label">Cargos</label>
                                <select class="form-select" id="cargos_id" name="cargos_id" required>
                                    <option selected disabled value="">Elegir</option>
                                    @foreach ($cargos as $cargo)
                                        <option value="{{ $cargo->idCargos }}">{{ $cargo->Nombre_Cargo }}</option>
                                    @endforeach
                                </select>
                                <div class="valid-tooltip">
                                    Excelente!
                                </div>
                                <div class="invalid-tooltip">
                                    Please provide a valid zip.
                                </div>
                            </div>


                            <div class="col-md-3 position-relative">
                                <label for="validationTooltip05" class="form-label">Turnos</label>
                                <select class="form-select" id="turnos_id" name="turnos_id" required>
                                    <option selected disabled value="">Elegir</option>
                                    @foreach ($turnos as $turno)
                                        <option value="{{ $turno->idTurnos }}">{{ $turno->Nombre_Turno }}</option>
                                    @endforeach
                                </select>
                                <div class="valid-tooltip">
                                    Excelente!
                                </div>
                                <div class="invalid-tooltip">
                                    Please provide a valid zip.
                                </div>
                            </div>

                        </div>

                        {{-- Empleados a Destajo --}}
                        <div id="empleadoDestajoFields" style="display:none;">

                            <div class="col-md-4 position-relative">
                                <label for="validationTooltip01" class="form-label">Servicio</label>
                                <select class="form-select" id="servicio_id" name="servicio_id" required>
                                    <option selected disabled value="">Elegir</option>
                                    @foreach ($servicios as $servicio)
                                        <option value="{{ $servicio->idServicio }}">{{ $servicio->Nombre_Servicio }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="valid-tooltip">
                                    Excelente!
                                </div>
                                <div class="invalid-tooltip">
                                    Por favor selecciona un servicio.
                                </div>
                            </div>


                            <div class="col-md-4 position-relative">
                                <label for="validationTooltip01" class="form-label">Personas</label>
                                <select class="form-select" id="personas_id_2" name="personas_id_2" required>
                                    <option selected disabled value="">Elegir</option>
                                    @foreach ($personas as $persona)
                                        <option value="{{ $persona->idPersonas }}">{{ $persona->Nombres }}
                                            {{ $persona->Apellidos }}</option>
                                    @endforeach
                                </select>
                                <div class="valid-tooltip">
                                    Excelente!
                                </div>
                                <div class="invalid-tooltip">
                                    Por favor selecciona un tipo de solicitud.
                                </div>
                            </div>
                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip03" class="form-label">Remuneracion</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">$</span>
                                    <input type="text" id="costo_servicio" name="costo_servicio" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-text">,00</span>
                                </div>
                                <div class="invalid-tooltip">
                                    Please provide a valid monto.
                                </div>
                            </div>

                        </div>

                        {{-- Empresas --}}
                        <div id="empresaFields" style="display:none;">
                            <div class="col-md-4 position-relative">
                                <label for="validationTooltip01" class="form-label">Servicio</label>
                                <select class="form-select" id="servicio_id_3" name="servicio_id_3" required>
                                    <option selected disabled value="">Elegir</option>
                                    @foreach ($servicios as $servicio)
                                        <option value="{{ $servicio->idServicio }}">{{ $servicio->Nombre_Servicio }}
                                        </option>
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
                            <div class="col-md-6 position-relative">
                                <label for="validationTooltip03" class="form-label">Remuneracion</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">$</span>
                                    <input type="text" id="costo_servicio_3" name="costo_servicio_3"
                                        class="form-control" aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-text">,00</span>
                                </div>
                                <div class="invalid-tooltip">
                                    Please provide a valid monto.
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <button class="btn btn-outline-success" type="submit">Registrar Solicitud</button>
                            <a class="btn btn-outline-info " href="{{ route('solicitudes.index') }}">Volver a la
                                lista</a>
                        </div>
                        <div class="container p-2">

                        </div>
                    </form>
                </div>
            </div>



        </main>
    @endsection

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.getElementById('tipo_solicitud').addEventListener('change', function() {
                    let tiposolicitud = this.value;
                    document.getElementById('empleadoFijoFields').style.display = tiposolicitud == 1 ? 'block' :
                        'none';
                    document.getElementById('empleadoDestajoFields').style.display = tiposolicitud == 2 ?
                        'block' : 'none';
                    document.getElementById('empresaFields').style.display = tiposolicitud == 3 ? 'block' :
                        'none';
                });
            });
        </script>
    @endpush
