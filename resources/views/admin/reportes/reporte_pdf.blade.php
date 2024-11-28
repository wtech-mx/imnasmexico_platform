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

    <h1>Reporte de Pagos de Cursos</h1>

    <p><strong>Fecha de inicio:</strong> {{ \Carbon\Carbon::parse($fechaInicioSemana)->format('j M \\d\\e\\l Y') }}</p>
    <p><strong>Fecha de fin:</strong> {{ \Carbon\Carbon::parse($fechaFinSemana)->format('j M \\d\\e\\l Y') }}</p>
    <p><strong>Total Pagado:</strong> ${{ $totalPagadoFormateado }}</p>
    <p><strong>Vendedor:</strong> {{ $vendedor }}</p>

    <div class="chart">
        <h2>Gráfico de Pagos</h2>
        <img src="data:image/png;base64,{{ $grafica }}" alt="Gráfico de Pagos">
    </div>


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
            @php
                $totalPagos = 0;
                $ordenesOrdenadas = $orders->sortByDesc('pago');
            @endphp
            @foreach ($ordenesOrdenadas as $order)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($order->fecha)->format('j M \\d\\e\\l Y') }}</td>
                    <td>{{ $order->forma_pago }}</td>
                    <td>${{ number_format($order->pago, 2, '.', ',') }}</td>
                </tr>
                @php $totalPagos += $order->pago; @endphp
            @endforeach
            <tr>
                <td colspan="2"><strong>Total</strong></td>
                <td><strong>${{ number_format($totalPagos, 2, '.', ',') }}</strong></td>
            </tr>
        </tbody>
    </table>

    <h2>Resumen de Formas de Pago</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Forma de Pago</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $formasPago = [
                    ['forma' => 'Mercado Pago', 'total' => $orders_mp->count()],
                    ['forma' => 'Stripe', 'total' => $orders_stripe->count()],
                    ['forma' => 'Transferencia Inbursa', 'total' => $orders_inbursa->count()],
                    ['forma' => 'Transferencia Bancomer', 'total' => $orders_bbva->count()],
                    ['forma' => 'Efectivo', 'total' => $orders_Efectivo->count()],
                    ['forma' => 'Tarjeta', 'total' => $orders_Tarjeta->count()],
                    ['forma' => 'Oxxo Inbursa', 'total' => $orders_oxxo_inbursa->count()],
                    ['forma' => 'Nota', 'total' => $orders_nota->count()],
                ];
                $formasPagoOrdenadas = collect($formasPago)->sortByDesc('total');
                $totalFormasPago = 0;
            @endphp
            @foreach ($formasPagoOrdenadas as $forma)
                <tr>
                    <td>{{ $forma['forma'] }}</td>
                    <td>{{ $forma['total'] }}</td>
                </tr>
                @php $totalFormasPago += $forma['total']; @endphp
            @endforeach
            <tr>
                <td><strong>Total</strong></td>
                <td><strong>{{ $totalFormasPago }}</strong></td>
            </tr>
        </tbody>
    </table>

    <h2>Cursos</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre del Curso</th>
                <th>Total Inscritos</th>
            </tr>
        </thead>
        <tbody>
            @php
                $totalCursos = 0;
                $cursosOrdenados = $cursosComprados->sortByDesc('total');
            @endphp
            @foreach ($cursosOrdenados as $curso)
                <tr>
                    <td>{{ $curso['nombre'] }}</td>
                    <td>{{ $curso['total'] }}</td>
                </tr>
                @php $totalCursos += $curso['total']; @endphp
            @endforeach
            <tr>
                <td><strong>Total</strong></td>
                <td><strong>{{ $totalCursos }}</strong></td>
            </tr>
        </tbody>
    </table>
    <div class="footer">
        <p>Reporte generado el {{ $fechaGeneracion }}</p>
    </div>
</body>
</html>
