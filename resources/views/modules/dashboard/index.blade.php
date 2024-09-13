@extends('layouts/main')

@section('contenido')

    <!-- container section  -->
    <div class="container p-5">
        <!-- Mensaje de bienvenida -->
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <img src="2.png" style="height: 300px; width: 100%; object-fit:cover;" alt="logo">
                </div>
                <div class="col-lg-6">
                    <div class="alert text-center ">
                        <h1 class="fw-semibold title-color"> CASA COLOMBIA te da la Bienvenida </h1>
                        <h4 class="fw-bold">Sistema de Contratación</h4>
                        <p>Desarrollado bajo la empresa IUJO y asociados - 4to Semestre - Informática.</p>
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
                </div>
            </div>
        </div>


        <div class="row mt-4 mb-3 text-center">
            <div class="col-md-4">
                <div class="card alert root-bg-green-degree">
                    <div class="card-header bg-transparent text-uppercase fw-bolder">Contratos Activos</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $contratosActivosCount }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card alert root-bg-tomatoe-degree">
                    <div class="card-header bg-transparent text-uppercase fw-bolder">Contratos en Borrador</div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $contratosBorradorCount }}</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card alert root-bg-dark-degree">
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
