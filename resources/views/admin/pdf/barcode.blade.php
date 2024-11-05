<!DOCTYPE html>
<html>
<head>
    <title>Códigos de Barra</title>
    <style>
        .barcode-container {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h2>Códigos de Barra de los Productos</h2>
    <p><strong>Fecha y hora de generación:</strong> {{ $fechaHora }}</p>
    <p><strong>Generado por:</strong> {{ $usuario }}</p>

    @foreach ($products as $product)
        <div class="barcode-container">
            <h4>{{ $product->nombre }} <br>SKU: {{ $product->sku }}</h4>
            <!-- Generar código de barras usando milon/barcode -->
            <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($product->sku, 'C128') }}" alt="barcode" />
        </div>
    @endforeach
</body>
</html>
