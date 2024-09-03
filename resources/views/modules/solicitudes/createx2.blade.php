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

                        <div id="empleadoFijoFields" style="display:none;">
                            <div class="form-group">
                                <label for="turno">Turno</label>
                                <select class="form-control" id="turno" name="turno">
                                    <option value="mañana">Mañana</option>
                                    <option value="tarde">Tarde</option>
                                    <option value="noche">Noche</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="cargo">Cargo</label>
                                <select class="form-control" id="cargo" name="cargo">
                                    <option value="chef">Chef</option>
                                    <option value="mesonero">Mesonero</option>
                                    <option value="maitre">Maitre</option>
                                </select>
                            </div>
                        </div>
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
                        </div>

                        <div id="empresaFields" style="display:none;">
                            <div class="form-group">
                                <label for="rif">RIF</label>
                                <input type="text" class="form-control" id="rif" name="rif">
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
            @stack('scripts')
        </main>
    @endsection

    @push('scripts')
        <script>
            document.getElementById('tipo_solicitud').addEventListener('change', function() {
                let tiposolicitud = this.value;
                console.log(tiposolicitud);
                document.getElementById('empleadoFijoFields').style.display = tiposolicitud === 1 ?
                    'block' :
                    'none';
                document.getElementById('empleadoDestajoFields').style.display = tiposolicitud === 2 ?
                    'block' :
                    'none';
                document.getElementById('empresaFields').style.display = tiposolicitud === 3 ? 'block' : 'none';
            });
        </script>
    @endpush
