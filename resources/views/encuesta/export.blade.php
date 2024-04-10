<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Encuestas</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #aeabab;
        }
        td {
            background-color: #ffffff;
        }
        .total {
            font-weight: bold;
            background-color: #c5e0b3;
        }
    </style>
</head>
<body>
    <h2>Registro de Asistencias</h2>
    <br>
    @foreach ($encuestasPorMes as $mes => $encuestasDelMes)
        <table>
            <thead>
                <tr>
                    <th style="border: 1px solid black; background-color: #c5e0b3;"><strong>{{ \Carbon\Carbon::parse($mes)->locale('es')->isoFormat('MMMM [de] Y') }}</strong></th>
                    <th style="border: 1px solid black; background-color: #c5e0b3;" colspan="5"></th>
                </tr>
                <tr>
                    <th style="border: 1px solid black; background-color: #c5e0b3;">Fecha</th>
                    <th style="border: 1px solid black; background-color: #c5e0b3;">Hora</th>
                    <th style="border: 1px solid black; background-color: #c5e0b3;">Nombre</th>
                    <th style="border: 1px solid black; background-color: #c5e0b3;">Empresa</th>
                    <th style="border: 1px solid black; background-color: #c5e0b3;">Latitud</th>
                    <th style="border: 1px solid black; background-color: #c5e0b3;">Longitud</th>
                </tr>
            </thead>
            <tbody>
                @php $i = 0; @endphp
                @foreach ($encuestasDelMes as $encuesta)
                    <tr>
                        <td style="border: 1px solid black;">{{ \Carbon\Carbon::parse($encuesta->created_at)->isoFormat('dddd D [de] MMMM [de] Y') }}</td>
                        <td style="border: 1px solid black;">{{ $encuesta->created_at->format('h:i A') }}</td>
                        <td style="border: 1px solid black;">{{ $encuesta->user->name }}</td>
                        <td style="border: 1px solid black;">{{ $encuesta->empresa->name }}</td>
                        <td style="border: 1px solid black;">{{ $encuesta->latitud }}</td>
                        <td style="border: 1px solid black;">{{ $encuesta->longitud }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>
</html>
