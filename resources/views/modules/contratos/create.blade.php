@extends('layouts/main')

@section('contenido')
    <header class="p-2">
        <h3>Generar Contrato</h3>
    </header>
    <main class="p-4">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card">
            <div class="card-header">
                Formulario
            </div>
            <div class="card-body">
                <h5 class="card-title">Crear un nuevo contrato</h5>
                <p class="card-text">Completa la siguiente informacion</p>
                <form action="{{ route('contratos.store', $solicitud->idSolicitud) }}" method="POST">
                    @csrf
                    {{-- @method('PUT') --}}
                    <div class="col-md-3 position-relative">
                        <label for="tipo_solicitud" class="form-label">Tipo de Solicitud</label>
                        <option class="form-select" id="tipo_solicitud" name="tipo_solicitud" required>

                            {{ $tipo->Tipo_Solicitud }}
                        </option>

                    </div>

                    {{-- Empleado Fijo --}}
                    @if ($solicitud->Tipo_Solicitud_idTipo_Solicitud == 1)
                        <div id="empleadoFijoFields" style="display:block;">
                            {{-- <div class="col-md-4 position-relative">
                            <label for="personas_id" class="form-label">Personas</label> --}}
                            {{--
                                <input selected disabled value="">Elegir</input>
                                {{ $persona->Nombres }} {{ $persona->Apellidos }}

                            </div>

                            <div class="col-md-3 position-relative">
                                <label for="cargos_id" class="form-label">Cargos</label>
                                {{ $cargo->Nombre_Cargo }}
                            </div>

                            <div class="col-md-3 position-relative">
                                <label for="turnos_id" class="form-label">Turnos</label>
                                {{ $turno->Nombre_Turno }}

                            </div> --}}
                        </div>
                    @elseif($solicitud->Tipo_Solicitud_idTipo_Solicitud == 2)
                        {{-- Empleados a Destajo --}}
                        <div id="empleadoDestajoFields" style="display:block;">

                            <div class="col-md-4 position-relative">
                                <label for="servicio_ps" class="form-label">Servicio</label>
                                <option class="form-select" value="">
                                    {{ $servicio_ps ? $servicio_ps->Nombre_Servicio : 'No definido' }}
                                </option>

                            </div>

                            <div class="col-md-4 position-relative">
                                <label class="form-label">Personas</label>
                                <option id="persona_ps" class="form-select" value="">
                                    {{ $persona_ps ? $persona_ps->Nombres : 'No definido' }}

                                </option>
                            </div>

                            <div class="col-md-6 position-relative">
                                <label class="form-label">Remuneración</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">$</span>
                                    <input type="text" id="remuneracion_ps" name="remuneracion_ps" class="form-control"
                                        value="{{ $ps ? $ps->Costo_Servicio : 'No definido' }}">
                                    <span class="input-group-text">,00</span>
                                </div>
                                <div class="invalid-tooltip">
                                    Por favor proporciona una remuneración válida.
                                </div>


                            </div>
                        </div>
                    @elseif($solicitud->Tipo_Solicitud_idTipo_Solicitud == 3)
                        {{-- Empresa --}}
                        <div id="empresaFields" style="display:block;">

                            <div class="col-md-4 position-relative">
                                <label for="empresa_id" class="form-label">Empresa</label>
                                <option class="form-select value="">
                                    {{ $empresa_es ? $empresa_es->Nombre_Empresa : 'No definido' }}

                                </option>


                            </div>
                            <div class="col-md-4 position-relative">
                                <label for="servicio_es" class="form-label">Servicio</label>
                                <option class="form-select value="">
                                    {{ $servicio_es ? $servicio_es->Nombre_Servicio : 'No definido' }}

                                </option>


                            </div>
                            <div class="col-md-6 position-relative">
                                <label for="remuneracion_es" class="form-label">Remuneración</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">$</span>
                                    <input type="text" id="remuneracion_es" name="remuneracion_es" class="form-control"
                                        value="{{ $es ? $es->Costo_Servicio : 'No definido' }}">
                                    <span class="input-group-text">,00</span>
                                </div>
                                <div class="invalid-tooltip">
                                    Por favor proporciona una remuneración válida.
                                </div>


                            </div>
                        </div>
                    @endif


                    <label for="">
                        Fecha_Inicio
                    </label>
                    <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio">

                    <label for="">
                        Fecha_final
                    </label>
                    <input type="date" class="form-control" name="fecha_final" id="fecha_final">

                    <input type="checkbox" name="acepto_terminos" id="acepto_terminos" required>
                    <label for="acepto_terminos">He leído y acepto los <a href="terminos_y_condiciones.html"
                            target="_blank">Términos y Condiciones</a></label>
                    @error('terms')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class=" col-12 py-4">
                        <button class="btn btn-outline-success" type="submit">Generar Contrato</button>
                        <a class="btn btn-outline-info" href="{{ route('solicitudes.index') }}">Volver a la lista</a>

                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection
