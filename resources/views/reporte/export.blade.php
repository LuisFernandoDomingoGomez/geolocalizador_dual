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
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Registro de Asistencias</h2>
    <br>
    @foreach ($encuestasAgrupadas as $user_id => $encuestasPorMes)
        @php
            $user = App\Models\User::find($user_id);
        @endphp
        <h3>Alumno: {{ $user->name }}</h3>
        @foreach ($encuestasPorMes as $mes => $encuestasPorDia)
            @foreach ($encuestasPorDia as $dia => $encuestas)
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
                        @foreach ($encuestas as $encuesta)
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
        @endforeach
    @endforeach
</body>
</html>
