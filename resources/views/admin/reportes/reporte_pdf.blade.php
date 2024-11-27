<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte Completo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.5;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .table th, .table td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }
        .chart {
            text-align: center;
            margin: 20px 0;
        }
        .chart img {
            width: 80%;
        }
    </style>
</head>
<body>

    <h1>Reporte de Pagos y Cursos</h1>

    <p><strong>Fecha de inicio:</strong> {{ $fechaInicioSemana }}</p>
    <p><strong>Fecha de fin:</strong> {{ $fechaFinSemana }}</p>
    <p><strong>Total Pagado:</strong> ${{ $totalPagadoFormateado }}</p>

    <h2>Órdenes</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Forma de Pago</th>
                <th>Pago</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->fecha }}</td>
                    <td>{{ $order->forma_pago }}</td>
                    <td>${{ number_format($order->pago, 2, '.', ',') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Gráfica de Pagos</h2>
    <div class="chart">
        <img src="data:image/png;base64,{{ base64_encode($grafica) }}" alt="Gráfico de Pagos">
    </div>

    <h2>Resumen de Formas de Pago</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Forma de Pago</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr><td>Mercado Pago</td><td>{{ $orders_mp->count() }}</td></tr>
            <tr><td>Stripe</td><td>{{ $orders_stripe->count() }}</td></tr>
            <tr><td>Transferencia Inbursa</td><td>{{ $orders_inbursa->count() }}</td></tr>
            <tr><td>Transferencia Bancomer</td><td>{{ $orders_bbva->count() }}</td></tr>
            <tr><td>Efectivo</td><td>{{ $orders_Efectivo->count() }}</td></tr>
            <tr><td>Tarjeta</td><td>{{ $orders_Tarjeta->count() }}</td></tr>
            <tr><td>Oxxo Inbursa</td><td>{{ $orders_oxxo_inbursa->count() }}</td></tr>
            <tr><td>Nota</td><td>{{ $orders_nota->count() }}</td></tr>
        </tbody>
    </table>

    <h2>Cursos Comprados</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre del Curso</th>
                <th>Total Comprado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($cursosComprados as $curso)
                <tr>
                    <td>{{ $curso['nombre'] }}</td>
                    <td>{{ $curso['total'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
