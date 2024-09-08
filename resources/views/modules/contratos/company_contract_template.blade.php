<!DOCTYPE html>
<html>
<head>
    <title>Contrato a Empresas</title>
</head>
<body>
    <h1>Contrato a Empresas</h1>
    <p>Fecha: {{ $solicitud->Fecha_solicitud->format('d/m/Y') }}</p>
    <p>Empresa: {{ $solicitud->empresa ? $solicitud->empresa->Nombre_Empresa : 'No disponible' }}</p>
    <p>Servicio: {{ $solicitud->servicio ? $solicitud->servicio->Nombre_Servicio : 'No disponible' }}</p>
    <!-- Detalles específicos para contrato a empresas -->
</body>
</html>
