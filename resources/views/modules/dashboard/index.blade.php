@extends('layouts/main')

@section('contenido')
    <div class="container mt-5">
        <!-- Mensaje de bienvenida -->
        <div class="mb-4">
            <div class="alert alert-info text-center">
                <h4 class="alert-heading">Bienvenido al Sistema de Contratación</h4>
                <p>Este es el módulo de gestión de contratos para IUJO - 4to Semestre - Informática.</p>
            </div>
        </div>

        <!-- Resumen de contratos -->
        <figure class="text-center">
            <blockquote class="blockquote">
                <p>Módulo de Contratación</p>
            </blockquote>
            <figcaption class="blockquote-footer">
                IUJO - 4to Semestre - Informática
            </figcaption>
        </figure>

        <div class="row mt-4">
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
