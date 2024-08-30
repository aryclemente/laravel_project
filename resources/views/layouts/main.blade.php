<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>

<body style="background-color: rgb(247, 255, 255)
">

    <div class="container">
        <div class="nav">
            <ul class="nav justify-content-center nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">DashBoard</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false">Personal Fijo</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Solicitudes</a></li>
                        <li><a class="dropdown-item" href="#">Cargos</a></li>
                        <li><a class="dropdown-item" href="#">Trabajadores</a></li>
                        <li><a class="dropdown-item" href="#">Contratos</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false">Personal a Destajo</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Solicitudes</a></li>
                        <li><a class="dropdown-item" href="#">Servicios</a></li>
                        <li><a class="dropdown-item" href="#">Personal</a></li>
                        <li><a class="dropdown-item" href="#">Contratos</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button"
                        aria-expanded="false">Empresas</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Solicitudes</a></li>
                        <li><a class="dropdown-item" href="#">Servicios</a></li>
                        <li><a class="dropdown-item" href="#">Empresas</a></li>
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
</body>

</html>
