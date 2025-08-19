{{-- Vista para mostrar la información de cada empleado en formato PDF --}}
@php
    use Carbon\Carbon;
    $hourly_zone = Carbon::now('America/Bogota');
@endphp
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del Empleado</title>

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            margin: 40px;
            font-size: 16px;
            color: #000;
        }

        header {
            text-align: center;
            margin-bottom: 40px;
        }

        header img {
            max-height: 80px;
            margin-bottom: 10px;
        }

        h1 {
            color: #000;
            margin-bottom: 5px;
        }

        .datos {
            border-collapse: collapse;
            width: 100%;
        }

        .datos th,
        .datos td {
            border: 1px solid #ddd;
            padding: 12px 10px;
            vertical-align: top;
        }

        .datos th {
            background-color: #f2f2f2;
            text-align: left;
            width: 30%;
        }

        .datos tr:nth-child(even) {
            background-color: #fafafa;
        }

        @media print {
            body {
                margin: 10mm;
                font-size: 12px;
            }

            header img {
                display: none;
            }
        }
    </style>

</head>

<body>

    <header>
        <img src="#" alt="Logo de la Empresa">
        <h1>Información del Empleado</h1>
        <p>Generado el {{ $hourly_zone->translatedFormat('d \d\e F \d\e Y \a \l\a\s h:i A') }}</p>
    </header>

    <table class="datos" aria-label="Tabla con datos del empleado">
        <tr>
            <th scope="row">Nombres</th>
            <td>{{ $employee->name_employee }}</td>
        </tr>
        <tr>
            <th scope="row">Apellidos</th>
            <td>{{ $employee->last_name_employee }}</td>
        </tr>
        <tr>
            <th scope="row">N.° Cédula</th>
            <td>{{ $employee->id_employee }}</td>
        </tr>
        <tr>
            <th scope="row">Correo Electrónico Corporativo</th>
            <td>{{ $employee->email_employee }}</td>
        </tr>
        <tr>
            <th scope="row">Puesto de Trabajo</th>
            <td>{{ $employee->position?->name_position }}</td>
        </tr>
        <tr>
            <th scope="row">Entidad Promotora de Salud (EPS)</th>
            <td>{{ $employee->healthcare?->name_healthcare }}</td>
        </tr>
    </table>

</body>

</html>
