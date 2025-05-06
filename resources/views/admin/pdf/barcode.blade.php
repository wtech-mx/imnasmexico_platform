<!DOCTYPE html>
<html>
    <style>
        .barcode-container {
            text-align: center;
            margin-bottom: 40px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
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
    <h2>Códigos de Barra de los Productos Cosmica</h2>
    {{-- <p><strong>Fecha y hora de generación:</strong> {{ $fechaHora }}</p>
    <p><strong>Generado por:</strong> {{ $usuario }}</p> --}}
    @php
        $contador = 0;
    @endphp
    @foreach ($products as $product)
        <div class="barcode-container">
            <h4>{{ $product->nombre }} <br>SKU: {{ $product->sku }}</h4>
            <img src="data:image/png;base64,{{ DNS1D::getBarcodePNG($product->sku, 'C128') }}" alt="barcode" />
        </div>

        @php
            $contador++;
        @endphp

        @if ($contador % 7 === 0)
            <div class="page-break"></div>
        @endif
    @endforeach
</body>
</html>
