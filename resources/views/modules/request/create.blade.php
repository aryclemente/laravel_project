@extends('layouts/main')
@section('contenido')

    <body>
        <header>
            <h1>Agregar Solicitud</h1>
        </header>
        <main>
            <form action="{{ route('solicitudes.store') }}" method="POST">
                @csrf

                <label for="trabajador_id">Trabajador:</label>
                <select id="trabajador_id" name="trabajador_id" required>
                    @foreach ($trabajadores as $trabajador)
                        <option value="{{ $trabajador->id }}">{{ $trabajador->nombre }} {{ $trabajador->apellido }}</option>
                    @endforeach
                </select>

                <label for="empresa_id">Empresa:</label>
                <select id="empresa_id" name="empresa_id" required>
                    @foreach ($empresas as $empresa)
                        <option value="{{ $empresa->id }}">{{ $empresa->nombre }}</option>
                    @endforeach
                </select>

                <label for="servicio_id">Servicio:</label>
                <select id="servicio_id" name="servicio_id" required>
                    @foreach ($servicios as $servicio)
                        <option value="{{ $servicio->id }}">{{ $servicio->nombre }}</option>
                    @endforeach
                </select>

                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>

                <button type="submit">Guardar</button>
            </form>
            <a href="{{ route('solicitudes.index') }}">Volver a la lista</a>
        </main>
    @endsection
