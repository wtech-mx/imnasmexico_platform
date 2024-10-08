<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Código de Barras</title>
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 50px;
        }
        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }
        .barcode {
            margin: 20px auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>{{ $product->nombre }}</h1>
        <div class="barcode">
            {!! $barcode !!} <!-- Aquí se genera el código de barras en HTML -->
        </div>
        <p>SKU: {{ $product->sku }}</p>
    </div>
</body>
</html>
