<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo MercadoPago</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
            color: #4CAF50;
        }
        .details {
            margin: 20px 0;
        }
        .details th, .details td {
            text-align: left;
            padding: 8px;
            border: 1px solid #ddd;
        }
        .details th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="https://plataforma.imnasmexico.com/utilidades/logo_mp.png" alt="" style="width: 30%">
        <h1>Recibo de Pago - MercadoPago</h1>

        <table class="details" width="100%">
            <tr>
                <th>ID de Pago</th>
                <td>{{ $data['id'] }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ ucfirst($data['status']) }}</td>
            </tr>
            <tr>
                <th>Monto Transacción</th>
                <td>${{ number_format($data['transaction_amount'], 2) }}</td>
            </tr>
            <tr>
                <th>Fecha Aprobación</th>
                <td>{{ \Carbon\Carbon::parse($data['date_approved'])->format('d/m/Y H:i') }}</td>
            </tr>
            <tr>
                <th>Método de Pago</th>
                <td>{{ ucfirst($data['payment_method_id']) }}</td>
            </tr>
            <tr>
                <th>Tipo de Pago</th>
                <td>{{ ucfirst($data['payment_type_id']) }}</td>
            </tr>
            <tr>
                <th>Descripción</th>
                <td>{{ $data['description'] }}</td>
            </tr>
            <tr>
                <th>Email del Pagador</th>
                <td>{{ $data['payer_email'] }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
