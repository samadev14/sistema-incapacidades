{{-- Vista para mostrar el reporte mensual de incapacidades registradas en formato PDF --}}
@php
    use Carbon\Carbon;
    $hourly_zone = Carbon::now('America/Bogota');
@endphp
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte Mensual de Incapacidades Registradas</title>

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f5f5f5;
        }
    </style>

</head>

<body>

    <header>
        <img src="#" alt="Logo de la Empresa">
        <h1>Resumen Mensual de Incapacidades Registradas</h1>
        <p>Generado el {{ $hourly_zone->translatedFormat('d \d\e F \d\e Y \a \l\a\s h:i A') }}</p>
        <p style="text-align: center; font-size: 14px; margin-bottom: 10px;">
        </p>
    </header>

    <table>
        <thead>
            <tr>
                <th colspan="2">
                    Resumen desde el {{ Carbon::parse($startDate)->translatedFormat('d \d\e F \d\e Y') }}
                    hasta el {{ Carbon::parse($endDate)->translatedFormat('d \d\e F \d\e Y') }}
                </th>
            </tr>
        </thead>
        <thead>
            <tr>
                <th>Mes</th>
                <th>Cantidad de Incapacidades Registradas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $month => $quantity)
                <tr>
                    <td>{{ $month }}</td>
                    <td>{{ $quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
