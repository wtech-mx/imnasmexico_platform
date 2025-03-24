<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producción Estimada</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Producción Estimada</h1>
    <p style="text-align: center;">Fecha: {{date('d-m-Y', strtotime($today))}}</p>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad estimada</th>
                <th>Granel (kg)</th>
                <th>Envases</th>
                <th>Etiquetas</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($resultados as $estimado)
                <tr>
                    <td>{{ $estimado['producto'] }}</td>
                    <td>{{ $estimado['max_producible'] }}</td>
                    <td>{{  number_format($estimado['stock_granel'], 2) }}</td>
                    <td>
                        <ul>
                            @foreach ($estimado['stock_envases'] as $nombre => $cantidad)
                                <li>{{ $nombre }}: <b>{{ number_format($cantidad, 0) }}</b></li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul>
                            @foreach ($estimado['stock_etiquetas'] as $nombre => $cantidad)
                                <li>{{ $nombre }}: <b>{{ number_format($cantidad, 0) }}</b></li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
