@extends('layouts/main')
@section('contenido')

    <body>
        <header class="p-2">
            <h3>Modificar Solicitud</h3>
        </header>
        <main class="p-4">
            <div class="card ">
                <div class="card-header">
                    Formulario
                </div>
                <div class="card-body">
                    <h5 class="card-title">Modifica los datos de la solicitud</h5>
                    <p class="card-text">Recuerda revisar antes de actualizar </p>
                    <form action="{{ route('solicitudes.update', $solicitud->idSolicitud) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="col-md-3 position-relative">
                            <label for="validationTooltip04" class="form-label">Tipo de Solicitud</label>
                            <select class="form-select" id="tipo_solicitud" name="tipo_solicitud" required>
                                @foreach ($tiposolicitud as $tipo)
                                    <option value="{{ $tipo->idTipo_Solicitud }}"
                                        {{ old('tipo_solicitud', $solicitud->Tipo_Solicitud_idTipo_Solicitud) == $tipo->idTipo_Solicitud ? 'selected' : '' }}>
                                        {{ $tipo->Tipo_Solicitud }}</option>
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
                        {{-- <div id="empleadoFijoFields" style="display:none;">
                            <div class="col-md-4 position-relative">
                                <label for="validationTooltip01" class="form-label">Personas</label>
                                <select class="form-select" id="personas_id" name="personas_id" required>

                                    @foreach ($personas as $persona)
                                        <option value="{{ $persona->idPersonas }}"
                                            {{ old('personas_id', $solicitud->personas_has_servicios) == $persona->idPersonas ? 'selected' : '' }}>
                                            {{ $persona->Nombres }}
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

                        </div> --}}

                        {{-- Empleados a Destajo --}}
                        <div id="empleadoDestajoFields" style="display:block;">
                            <div class="col-md-4 position-relative">
                                <label for="validationTooltip01" class="form-label">Servicio</label>
                                <select class="form-select" id="servicio_id" name="servicio_id" required>
                                    <option selected disabled value="">Elegir</option>
                                    @foreach ($servicios as $servicio)
                                        <option value="{{ $servicio->idServicio }}"
                                            {{ old('servicio_id', $servicio_ps->idServicio) == $servicio->idServicio ? 'selected' : '' }}>
                                            {{ $servicio->Nombre_Servicio }}
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
                                <select class="form-select" id="personas_id" name="personas_id" required>
                                    <option selected disabled value="">Elegir</option>
                                    @foreach ($personas as $persona)
                                        <option value="{{ $persona->idPersonas }}"
                                            {{ old('personas_id', $persona_ps->idPersonas) == $persona->idPersonas ? 'selected' : '' }}>
                                            {{ $persona->Nombres }}
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
                                        aria-label="Amount (to the nearest dollar)"
                                        value="{{ old('costo_servicio', $ps->Costo_Servicio) }}">

                                    <span class="input-group-text">,00</span>
                                </div>
                                <div class="invalid-tooltip">
                                    Please provide a valid monto.
                                </div>
                            </div>

                        </div>

                        {{-- Empresas --}}
                        {{-- <div id="empresaFields" style="display:none;">
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
                                    <input type="text" id="costo_servicio" name="costo_servicio" class="form-control"
                                        aria-label="Amount (to the nearest dollar)">
                                    <span class="input-group-text">,00</span>
                                </div>
                                <div class="invalid-tooltip">
                                    Please provide a valid monto.
                                </div>
                            </div>
                        </div> --}}


                        <div class="col-12 py-4">
                            <button class="btn btn-primary" type="submit">Actualizar Solicitud</button>
                        </div>
                        <div class="container p-2">
                            <a class="btn btn-outline-info " href="{{ route('solicitudes.index') }}">Volver a la
                                lista</a>
                        </div>

        </main>
    </body>
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
