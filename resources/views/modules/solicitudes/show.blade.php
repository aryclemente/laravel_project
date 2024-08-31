@extends('layouts/main')
@section('contenido')
    <header>
        <h1>Detalles de la Solicitud</h1>
    </header>
    <main>
        <p>ID: {{ $solicitud->idSolicitud }}</p>
        <p>Fecha: {{ $solicitud->Fecha_solicitud }}</p>



        <a href="{{ route('solicitudes.index') }}">Volver a la lista</a>
    </main>
@endsection
