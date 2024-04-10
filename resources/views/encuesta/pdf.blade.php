<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Encuestas</title>
    <style>
            body {
        font-family: Arial, sans-serif;
    }
    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .header img {
        max-width: 180px;
    }
    .logos {
        display: flex;
        align-items: center;
    }
    .logos img {
        margin-right: 10px; /* Espacio entre los logos */
    }
    .logo-1 {
        width: 60px; /* Ancho del primer logotipo */
        height: auto; /* Altura ajustada automáticamente */
    }
    .logo-2 {
        width: 180px; /* Ancho del segundo logotipo */
        height: auto; /* Altura ajustada automáticamente */
    }
    h3 {
        text-align: center;
        margin-bottom: 20px;
    }
    h4 {
        text-align: center;
        margin-bottom: 15px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        font-size: 12px; /* Tamaño de la fuente de la tabla */
    }
    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }
    th {
        background-color: #f2f2f2;
    }
    .badge {
        padding: 4px 8px;
        font-weight: bold;
    }
    </style>
</head>
<body>
    <div class="header">
        <!-- Logos de las instituciones -->
        <div class="logos">
            <img src="dist/images/logo_2.png" alt="Logo 1" class="logo-2" style="margin-right: 440px;">
            <img src="dist/images/logo.png" alt="Logo 3" class="logo-1">
        </div>
    </div>
    <h3 style="color: #008b71; font-weight: bold; margin-bottom: 1px;">CECyTEM - Plantel LERMA</h3>
    <h4 style="font-weight: bold; margin-top: 1px; text-decoration: underline;">"Registro de Asistencias"</h4>
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
        <br>
    @endforeach
</body>
</html>
