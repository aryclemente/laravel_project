<!doctype html>
<html data-bs-theme="dark" lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

</head>

<body>
    <div class="container">
        <div class="nav">
            <ul class="nav justify-content-center nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('dashboard.index') }}">DashBoard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false">Solicitudes</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('solicitudes.index') }}">Solicitudes</a>
                        </li>
                        <li><a class="dropdown-item" href="#">Contratos</a></li>
                    </ul>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false">Contratos</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('contratos.index') }}">Contratos</a>
                        </li>
                        <li><a class="dropdown-item" href="#">Contratos</a></li>
                    </ul>
                </li>


            </ul>
        </div>
    </div>
    @yield('contenido')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    @stack('scripts')
</body>

</html>
