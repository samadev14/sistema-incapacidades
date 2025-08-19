{{-- Vista para mostrar el reporte individual de cada empleado de su incapacidad en formato PDF --}}
@php
    use Carbon\Carbon;
    $hourly_zone = Carbon::now('America/Bogota');
@endphp
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Incapacidad</title>

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

        footer {
            margin-top: 40px;
            text-align: left;
            color: #000;
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
        <h1>Reporte de Incapacidad</h1>
        <p>Generado el {{ $hourly_zone->translatedFormat('d \d\e F \d\e Y \a \l\a\s h:i A') }}</p>
    </header>

    <table class="datos" aria-label="Tabla con datos del reporte de incapacidad">
        <tr>
            <th scope="row">N° de Registro</th>
            <td>{{ $incapacity->id }}</td>
        </tr>
        <tr>
            <th scope="row">Nombres y Apellidos</th>
            <td>{{ $incapacity->employee->full_name }}</td>
        </tr>
        <tr>
            <th scope="row">N.° Cédula</th>
            <td>{{ $incapacity->employee->id_employee }}</td>
        </tr>
        <tr>
            <th scope="row">Correo Electrónico Corporativo</th>
            <td>{{ $incapacity->employee->email_employee }}</td>
        </tr>
        <tr>
            <th scope="row">Puesto de Trabajo</th>
            <td>{{ $incapacity->employee->position->name_position }}</td>
        </tr>
        <tr>
            <th scope="row">Entidad Promotora de Salud (EPS)</th>
            <td>{{ $incapacity->employee->healthcare->name_healthcare }}</td>
        </tr>
        <tr>
            <th scope="row">Tipo de Incapacidad</th>
            <td>{{ $incapacity->type_incapacity }}</td>
        </tr>
        <tr>
            <th scope="row">Descripción de la Incapacidad</th>
            <td>{{ $incapacity->description_incapacity }}</td>
        </tr>
        <tr>
            <th scope="row">Fecha Inicial</th>
            <td>{{ $incapacity->start_date->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <th scope="row">Fecha Final</th>
            <td>{{ $incapacity->end_date->format('d/m/Y') }}</td>
        </tr>
        <tr>
            <th scope="row">Estado</th>
            <td>{{ $incapacity->status }}</td>
        </tr>
    </table>

    <footer>
        <p>Validado por: _______________________________________</p>
    </footer>

</body>

</html>
