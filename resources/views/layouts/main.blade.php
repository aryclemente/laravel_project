<!doctype html>
<html data-bs-theme="dark" lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body>

    <nav class="navbar navbar-expand-lg px-4 bg-light-subtle">
        <div class="container-fluid">

            <a class="navbar-brand" href="{{ route('dashboard.index') }}">
                <img src="1.png" alt="logo" class="rounded"
                    style="
                        width: 80px;
                        height: 50px;
                        object-fit: cover;
                    ">
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse items-center">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('dashboard.index') }}"> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('solicitudes.fijo') }}"> Personal Fijo
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('solicitudes.destajo') }}"> Personal a
                            Destajo </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{ route('solicitudes.empresas') }}"> Empresas por
                            Servicios </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="collapse navbar-collapse items-center lateral-nav-mobile bg-light-subtle" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item nav-item-mobile">
                <i id="iconLateralMenu" class="fa-solid fa-house"></i>
                <a class="nav-link active" aria-current="page" href="{{ route('dashboard.index') }}"> Dashboard </a>
            </li>

            <!-- generial section -->
            <li class="nav-item nav-item-mobile">
                <i id="iconLateralMenu" class="fa-solid fa-file-contract"></i>
                <a class="nav-link" aria-current="page" href="{{ route('contratos.index') }}"> Contratos </a>
            </li>
            <li class="nav-item nav-item-mobile">
                <i id="iconLateralMenu" class="fa-solid fa-list-check"></i>
                <a class="nav-link" aria-current="page" href="{{ route('solicitudes.index') }}"> Solicitudes </a>
            </li>
            <li class="nav-item nav-item-mobile">
                <i id="iconLateralMenu" class="fa-solid fa-user-check"></i>
                <a class="nav-link" aria-current="page" href="{{ route('personas.index') }}"> Personas </a>
            </li>
            <li class="nav-item nav-item-mobile">
                <i id="iconLateralMenu" class="fa-solid fa-handshake"></i>
                <a class="nav-link" aria-current="page" href="{{ route('servicios.index') }}"> Servicios </a>
            </li>
            <li class="nav-item nav-item-mobile">
                <i id="iconLateralMenu" class="fa-solid fa-building"></i>
                <a class="nav-link" aria-current="page" href="{{ route('empresas.index') }}"> Empresas </a>
            </li>

            <!-- Professional section -->
            <li class="nav-item nav-item-mobile">
                <i id="iconLateralMenu" class="fa-solid fa-building"></i>
                <a class="nav-link" aria-current="page" href="{{ route('solicitudes.fijo') }}"> Personal Fijo </a>
            </li>
            <li class="nav-item nav-item-mobile">
                <i id="iconLateralMenu" class="fa-solid fa-building"></i>
                <a class="nav-link" aria-current="page" href="{{ route('solicitudes.destajo') }}"> Presonal a Destajo
                </a>
            </li>
            <li class="nav-item nav-item-mobile">
                <i id="iconLateralMenu" class="fa-solid fa-building"></i>
                <a class="nav-link" aria-current="page" href="{{ route('solicitudes.empresas') }}"> Empresas por
                    Servicios </a>
            </li>
        </ul>
    </div>

    <div class="container-fluid bg-light-subtle">
        <button class="btn btn-primary lateral-nav-desktop" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarNavLateral" aria-controls="navbarNavDropdown" aria-expanded="false"
            aria-label="Toggle navigation" id="showLateralMenu">
            <i id="iconLateralMenu" class="fa-solid fa-arrow-right"></i>
        </button>
        <div class="row justify-content-center" style="height:100vh">
            <div id="navbarNavLateral" class="col-md-2 col-sm-12 collapse collapse-horizontal ">
                <!-- nav section desktop -->
                <div class="container d-flex justify-content-center mt-5">
                    <ul class="navbar-nav">
                        <li class="nav-item lateral-nav-item-mobile">
                            <i id="iconLateralMenu" class="fa-solid fa-house"></i>
                            <a class="nav-link active" aria-current="page" href="{{ route('dashboard.index') }}">
                                Dashboard </a>
                        </li>
                        <li class="nav-item lateral-nav-item-mobile">
                            <i id="iconLateralMenu" class="fa-solid fa-file-contract"></i>
                            <a class="nav-link" aria-current="page" href="{{ route('contratos.index') }}"> Contratos
                            </a>
                        </li>
                        <li class="nav-item lateral-nav-item-mobile">
                            <i id="iconLateralMenu" class="fa-solid fa-list-check"></i>
                            <a class="nav-link" aria-current="page" href="{{ route('solicitudes.index') }}">
                                Solicitudes </a>
                        </li>
                        <li class="nav-item lateral-nav-item-mobile">
                            <i id="iconLateralMenu" class="fa-solid fa-user-check"></i>
                            <a class="nav-link" aria-current="page" href="{{ route('personas.index') }}"> Personas
                            </a>
                        </li>
                        <li class="nav-item lateral-nav-item-mobile">
                            <i id="iconLateralMenu" class="fa-solid fa-handshake"></i>
                            <a class="nav-link" aria-current="page" href="{{ route('servicios.index') }}"> Servicios
                            </a>
                        </li>
                        <li class="nav-item lateral-nav-item-mobile">
                            <i id="iconLateralMenu" class="fa-solid fa-building"></i>
                            <a class="nav-link" aria-current="page" href="{{ route('empresas.index') }}">
                                Empresas </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-10 col-sm-12 bg-body overflow-auto rounded" style="height: 100%">
                @yield('contenido')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    @stack('scripts')
</body>

</html>
