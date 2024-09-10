<!DOCTYPE html>
<html>
<head>
    <title>Contrato Fijo</title>
</head>
<body>
    <h1>Contrato Fijo</h1>
    <p>Fecha: {{ $solicitud->Fecha_solicitud->format('d/m/Y') }}</p>
    <p>Persona: {{ $solicitud->persona ? ($solicitud->persona->Nombres . ' ' . $solicitud->persona->Apellidos) : 'No disponible' }}</p>
    <p>Servicio: {{ $solicitud->servicio ? $solicitud->servicio->Nombre_Servicio : 'No disponible' }}</p>
    <!-- Detalles específicos para contrato fijo -->
</body>
</html>
