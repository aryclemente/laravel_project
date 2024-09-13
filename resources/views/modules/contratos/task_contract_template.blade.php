<!DOCTYPE html>
<html>

<head>
    <title>Contrato a Destajo</title>
</head>

<body>
    <h1>Contrato a Destajo</h1>
    <h5 class="card-title">Contrato #{{ $contrato->idContratos }}</h5>
    <p><strong>Fecha de Inicio:</strong> {{ $contrato->Fecha_Inicio->format('d/m/Y') }}</p>
    <p><strong>Fecha de Final:</strong> {{ $contrato->Fecha_Fin->format('d/m/Y') }}</p>

    <p><strong>Remuneracion:</strong> {{ $contrato->Remuneración }} $</p>
    <p>Persona:
        {{ $persona_ps ? $persona_ps->Nombres . ' ' . $persona_ps->Apellidos : 'No disponible' }}
    </p>
    <p>Servicio: {{ $servicio_ps ? $servicio_ps->Nombre_Servicio : 'No disponible' }}</p>
    <!-- Detalles específicos para contrato a destajo -->
</body>

</html>
