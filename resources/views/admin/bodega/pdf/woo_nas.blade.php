<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Woo NAS {{ $order->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #a6917e;
        }
        th {
            background-color: #F5ECE4;
        }
    </style>
</head>

<body style="background: #F5ECE4">
    <h1>Detalles de la Orden Woo NAS#{{ $order->id }}</h1>
    <p><strong>Cliente:</strong> {{ $order->billing->first_name }} {{ $order->billing->last_name }}</p>
    <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($order->date_created)->format('d-m-Y') }}</p>
    <p><strong>Total:</strong> ${{ $order->total }}</p>

    <h3>Productos:</h3>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->line_items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>${{ $item->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
