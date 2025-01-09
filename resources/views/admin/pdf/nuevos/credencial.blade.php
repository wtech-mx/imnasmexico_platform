<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titulo</title>
    @php
        $domain = request()->getHost();
        $basePath = ($domain == 'plataforma.imnasmexico.com')
                ? 'https://plataforma.imnasmexico.com/documentos_nuevos/credencial/'
                : 'documentos_nuevos/credencial/';
    @endphp

    @include('admin.pdf.nuevos.fuentes')

    <style>

        .border {
            border: 1px solid #000;
        }

        .container {
            position: relative;
            width: 321px;
            height:207px;
            margin: 0 auto; /* Centrar el contenedor */
            overflow: hidden; /* Evitar desbordes */
            background-image: url('{{ $basePath . 'fondo.png'}}');
            background-size: cover; /* Asegura que la imagen cubra toda el área */
            background-position: center center; /* Centra la imagen */
            background-repeat: no-repeat; /* No repetir la imagen */
        }

        [class^="col-"] {
            float: left;
            padding-left: 15px;
            padding-right: 15px;
            box-sizing: border-box;
        }
        .col-1 { width: 3.69%; }  /* 8.33% - 4.64% */
        .col-2 { width: 6.60%; } /* 16.66% - 4.64% */
        .col-3 { width: 14.90%; } /* 25% - 4.64% */
        .col-4 { width: 23.20%; } /* 33.33% - 4.64% */
        .col-5 { width: 37.02%; } /* 41.66% - 4.64% */
        /* .col-6 { width: 45.36%; }  */
        .col-6 { width: 39.90%; } /* 50% - 4.64% */
        .col-7 { width: 53.69%; } /* 58.33% - 4.64% */
        .col-8 { width: 62.70%; } /* 66.66% - 4.64% */
        .col-9 { width: 70.36%; } /* 75% - 4.64% */
        .col-10 { width: 78.69%; } /* 83.33% - 4.64% */
        .col-11 { width: 87.02%; } /* 91.66% - 4.64% */
        .col-12 { width: 89.50%; } /* 100% - 4.64% */

    </style>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-12 text-center border p-2">Columna 12</div>
        </div>
        <div class="row">
            <div class="col-6 text-center border p-2">Columna 6</div>
            <div class="col-6 text-center border p-2">Columna 6</div>
        </div>
        <div class="row">
            <div class="col-4 text-center border p-2">Columna 4</div>
            <div class="col-4 text-center border p-2">Columna 4</div>
            <div class="col-4 text-center border p-2">Columna 4</div>
        </div>
        <div class="row">
            <div class="col-3 text-center border p-2">Columna 3</div>
            <div class="col-3 text-center border p-2">Columna 3</div>
            <div class="col-3 text-center border p-2">Columna 3</div>
            <div class="col-3 text-center border p-2">Columna 3</div>
        </div>
        <div class="row">
            <div class="col-2 text-center border p-2">Columna 2</div>
            <div class="col-2 text-center border p-2">Columna 2</div>
            <div class="col-2 text-center border p-2">Columna 2</div>
            <div class="col-2 text-center border p-2">Columna 2</div>
            <div class="col-2 text-center border p-2">Columna 2</div>
            <div class="col-2 text-center border p-2">Columna 2</div>
        </div>
    </div>

</body>
</html>
