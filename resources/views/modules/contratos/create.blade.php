@extends('layouts/main')

@section('contenido')
    <header class="p-2">
        <h3>Generar Contrato</h3>
    </header>
    <main class="p-4">
        <div class="card">
            <div class="card-header">
                Formulario
            </div>
            <div class="card-body">
                <h5 class="card-title">Crear un nuevo contrato</h5>
                <p class="card-text">Completa la siguiente informacion</p>
                <form action="{{ route('contratos.store') }}" method="POST">
                    @csrf
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
                                <label for="servicio_id" class="form-label">Servicio</label>
                                <option class="form-select" value="">
                                    {{ $servicio_ps ? $servicio_ps->Nombre_Servicio : 'No definido' }}
                                </option>

                            </div>

                            <div class="col-md-4 position-relative">
                                <label for="personas_id" class="form-label">Personas</label>
                                <option class="form-select" value="">
                                    {{ $persona_ps ? $persona_ps->Nombres : 'No definido' }}

                                </option>
                            </div>

                            <div class="col-md-6 position-relative">
                                <label for="costo_servicio" class="form-label">Remuneración</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">$</span>
                                    <option class="form-select" value="">
                                        {{ $ps ? $ps->Costo_Servicio : 'No definido' }}

                                    </option>

                                    <span class="input-group-text">,00</span>
                                </div>
                            </div>
                        </div>
                    @elseif($solicitud->Tipo_Solicitud_idTipo_Solicitud == 3)
                        {{-- Empresa --}}
                        <div id="empresaFields" style="display:block;">

                            <div class="col-md-4 position-relative">
                                <label for="empresa_id" class="form-label">Empresa</label>
                                {{ $empresa_es ? $empresa_es->Nombre_Empresa : 'No definido' }}


                            </div>
                            <p><strong>Servicio:</strong>
                                {{ $servicio_es ? $servicio_es->Nombre_Servicio : 'No definido' }}</p>
                            <div class="col-md-6 position-relative">
                                <label for="remuneracion_empresa" class="form-label">Remuneración</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">$</span>
                                    <input type="text" id="remuneracion_empresa" name="remuneracion_empresa"
                                        class="form-control" value="">
                                    {{ $es ? $es->Costo_Servicio : 'No definido' }}

                                    <span class="input-group-text">,00</span>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class=" col-12 py-4">
                        <button class="btn btn-outline-warning" type="submit">Actualizar Solicitud</button>
                        <a class="btn btn-outline-info" href="{{ route('solicitudes.index') }}">Volver a la lista</a>
                    </div>

                </form>
            </div>
        </div>
    </main>
@endsection
