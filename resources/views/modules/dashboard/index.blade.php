@extends('layouts/main')

{{-- @section('title', 'Dashboard') --}}

@section('contenido')
    <div class="container mt-5">
        <figure class="text-center">
            <blockquote class="blockquote">
                <p>Modulo de Contratacion</p>
            </blockquote>
            <figcaption class="blockquote-footer">
                IUJO - 4to Semestre - Informatica
            </figcaption>
        </figure>
        <div class="row">
            <div class="col-md-4">
                <div class="card bg-success text-white mb-3">
                    <div class="card-header">Contratos Activos</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $contratosActivosCount }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-warning text-dark mb-3">
                    <div class="card-header">Contratos en Borrador</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $contratosBorradorCount }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-danger text-white mb-3">
                    <div class="card-header">Contratos Inactivos</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $contratosInactivosCount }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
