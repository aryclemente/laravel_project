@extends('layouts/main')

@section('contenido')

    <!-- container section  -->
    <div class="container p-5">
        <!-- Mensaje de bienvenida -->
        <div class="mb-4">
            <div class="alert alert-success text-center">
                <h4 class="alert-heading fw-bold">Bienvenido al Sistema de Contratación</h4>
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

        <div class="row mt-4 mb-3 text-center">
            <div class="col-md-4">
                <div class="card alert alert-info">
                    <div class="card-header bg-transparent text-uppercase fw-bolder">Contratos Activos</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $contratosActivosCount }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card alert alert-primary">
                    <div class="card-header bg-transparent text-uppercase fw-bolder">Contratos en Borrador</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $contratosBorradorCount }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card alert alert-secondary">
                    <div class="card-header bg-transparent text-uppercase fw-bolder">Contratos Inactivos</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $contratosInactivosCount }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>

        const btnLateralMenu = document.querySelector("#showLateralMenu");
        const icon = document.querySelector("#iconLateralMenu");
        const lateralMenu = document.querySelector("#navbarNavLateral");

        btnLateralMenu.addEventListener("click", ()=>{
            if(btnLateralMenu.classList.contains("btn-primary")){
                btnLateralMenu.classList.remove("btn-primary");
                btnLateralMenu.classList.add("btn-secondary");
                icon.classList.remove("fa-arrow-right");
                icon.classList.add("fa-arrow-left")
            }else{
                btnLateralMenu.classList.remove("btn-secondary");
                btnLateralMenu.classList.add("btn-primary");
                icon.classList.remove("fa-arrow-left")
                icon.classList.add("fa-arrow-right");
            }
        })

    </script>
@endpush
