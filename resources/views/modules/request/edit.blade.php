<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Solicitud</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <h1>Editar Solicitud</h1>
    </header>
    <main>
        <form action="{{ route('solicitudes.update', $solicitud->id) }}" method="POST">
            @csrf
            @method('PUT')

            <label for="trabajador_id">Trabajador:</label>
            <select id="trabajador_id" name="trabajador_id" required>
                @foreach ($trabajadores as $trabajador)
                    <option value="{{ $trabajador->id }}" {{ $solicitud->trabajador_id == $trabajador->id ? 'selected' : '' }}>
                        {{ $trabajador->nombre }} {{ $trabajador->apellido }}
                    </option>
                @endforeach
            </select>

            <label for="empresa_id">Empresa:</label>
            <select id="empresa_id" name="empresa_id" required>
                @foreach ($empresas as $empresa)
                    <option value="{{ $empresa->id }}" {{ $solicitud->empresa_id == $empresa->id ? 'selected' : '' }}>
                        {{ $empresa->nombre }}
                    </option>
                @endforeach
            </select>

            <label for="servicio_id">Servicio:</label>
            <select id="servicio_id" name="servicio_id" required>
                @foreach ($servicios as $servicio)
                    <option value="{{ $servicio->id }}" {{ $solicitud->servicio_id == $servicio->id ? 'selected' : '' }}>
                        {{ $servicio->nombre }}
                    </option>
                @endforeach
            </select>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" value="{{ $solicitud->fecha }}" required>

            <button type="submit">Actualizar</button>
        </form>
        <a href="{{ route('solicitudes.index') }}">Volver a la lista</a>
    </main>
</body>
</html>

