<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recibo Mercado Pago</title>
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
                <td>{{ $nota->num_order }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>Approved</td>
            </tr>
            <tr>
                <th>Monto Transacción</th>
                <td>{{$nota->pago}}</td>
            </tr>
            <tr>
                <th>Fecha Aprobación</th>
                <td>{{$nota->fecha}}</td>
            </tr>
            <tr>
                <th>Método de Pago</th>
                <td>Clabe</td>
            </tr>
            <tr>
                <th>Tipo de Pago</th>
                <td>Bank_transfer</td>
            </tr>
            <tr>
                <th>Descripción</th>
                <td>Bank_transfer</td>
            </tr>
            <tr>
                <th>Email del Pagador</th>
                <td>{{$nota->User->email}}</td>
            </tr>
        </table>
    </div>
</body>
</html>
