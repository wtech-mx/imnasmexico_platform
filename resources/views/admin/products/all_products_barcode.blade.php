<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Códigos de Barras de Todos los Productos</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
            text-align: center; /* Centra el contenido en el cuerpo */
        }
        .container {
            padding: 20px;
            text-align: center; /* Centra el contenido de cada contenedor */
            page-break-after: always; /* Crea un salto de página después de cada producto */
        }
        h1 {
            font-size: 24px;
            margin-bottom: 10px; /* Espacio entre el nombre del producto y el código de barras */
        }
        .barcode {
            margin: 10px auto; /* Centra el código de barras */
            display: inline-block; /* Asegura que se mantenga centrado */
        }
        .sku {
            font-size: 16px;
            margin-top: 10px;
        }
        .product-item {
            page-break-inside: avoid; /* Evita que el contenido de un producto se divida entre páginas */
            margin-bottom: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        @foreach ($products as $product)
            <div class="product-item">
                <h1>{{ $product->nombre }}</h1> <!-- Nombre del producto -->
                <div class="barcode">
                    {!! DNS1D::getBarcodeHTML($product->sku, 'C128') !!} <!-- Código de barras -->
                </div>
                <p class="sku">SKU: {{ $product->sku }}</p> <!-- SKU debajo del código de barras -->
            </div>
        @endforeach
    </div>
</body>
</ht
