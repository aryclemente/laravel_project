<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles de la Solicitud</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <h1>Detalles de la Solicitud</h1>
    </header>
    <main>
        <p>ID: {{ $solicitud->id }}</p>
        <p>Trabajador: {{ $solicitud->trabajador->nombre }} {{ $solicitud->trabajador->apellido }}</p>
        <p>Empresa: {{ $solicitud->empresa->nombre }}</p>
        <p>Servicio: {{ $solicitud->servicio->nombre }}</p>
        <p>Fecha: {{ $solicitud->fecha }}</p>
        <a href="{{ route('solicitudes.index') }}">Volver a la lista</a>
    </main>
</body>
</html>
