<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini-Grid PDF</title>
    @php
        $domain = request()->getHost();
        $basePath = ($domain == 'plataforma.imnasmexico.com')
                ? 'https://plataforma.imnasmexico.com/documentos_nuevos/cedula/'
                : 'documentos_nuevos/cedula/';
    @endphp
    <style>
        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        .container {
            position: relative;
            width: 480px; /* Ancho máximo basado en el tamaño del PDF */
            height: 668px; /* Altura basada en el tamaño del PDF */
            margin: 0 auto; /* Centrar el contenedor */
            overflow: hidden; /* Evitar desbordes */
            background-image: url('{{ $basePath . 'fondo.png'}}');
            background-size: cover; /* Asegura que la imagen cubra toda el área */
            background-position: center center; /* Centra la imagen */
            background-repeat: no-repeat; /* No repetir la imagen */
        }

        .content {
            position: relative; /* Necesario para superponer contenido sobre la imagen */
            z-index: 2; /* Asegura que el contenido esté encima de la imagen */
            width: 100%;
            height: 100%;
        }

        .row {
            width: 100%;
            clear: both;
        }
        [class^="col-"] {
            float: left;
            padding-left: 15px;
            padding-right: 15px;
            box-sizing: border-box;
        }
        .col-1 { width: 8.33%; }
        .col-2 { width: 16.66%; }
        .col-3 { width: 25%; }
        .col-4 { width: 33.33%; }
        .col-5 { width: 41.66%; }
        .col-6 { width: 50%; }
        .col-7 { width: 58.33%; }
        .col-8 { width: 66.66%; }
        .col-9 { width: 75%; }
        .col-10 { width: 83.33%; }
        .col-11 { width: 91.66%; }
        .col-12 { width: 100%; }
        .text-center {
            text-align: center;
        }
        .border {
            border: 1px solid #000;
        }
        .p-2 {
            padding: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Contenido superpuesto sobre la imagen -->
        <div class="content">
            <div class="row">
                <div class="col-4 text-center border p-2">
                    <img src="{{ $basePath . 'sello-registro-marca-de-agua.webp'}}" style="width: 50px">
                </div>
                <div class="col-4 text-center border p-2">
                    <img src="{{ $basePath . 'sello-registro-marca-de-agua.webp'}}" style="width: 50px">
                </div>
                <div class="col-4 text-center border p-2">
                    <img src="{{ $basePath . 'sello-registro-marca-de-agua.webp'}}" style="width: 50px">
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center border p-2">
                    <p>
                        REGISTRO NACIONAL INSTITUTO MEXICANO NATURALES AIN SPA, LA SECRETARIA DEL TRABAJO Y PREVISION SOCIAL E INSTITUTO INTEGRAL AM 360 OTORGAN la PRESENTE
                    </p>
                </div>

            </div>

            <div class="row">
                <div class="col-12 text-center border p-2">
                    <p>
                        cédula de identidad
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-4 text-center border p-2">
                    wqww
                </div>
                <div class="col-8 text-center border p-2">
                    qwq
                </div>
            </div>

            <div class="row">
                <div class="col-4 text-center border p-2">
                    <img src="{{ $basePath . 'sello-registro-marca-de-agua.webp'}}" style="width: 50px">
                </div>
                <div class="col-4 text-center border p-2">
                    <img src="{{ $basePath . 'sello-registro-marca-de-agua.webp'}}" style="width: 50px">
                </div>
                <div class="col-4 text-center border p-2">
                    <img src="{{ $basePath . 'sello-registro-marca-de-agua.webp'}}" style="width: 50px">
                </div>
            </div>

            <div class="row">
                <div class="col-4 text-center border p-2">
                    <img src="{{ $basePath . 'sello-registro-marca-de-agua.webp'}}" style="width: 50px">
                </div>
                <div class="col-4 text-center border p-2">
                    <img src="{{ $basePath . 'sello-registro-marca-de-agua.webp'}}" style="width: 50px">
                </div>
                <div class="col-4 text-center border p-2">
                    <img src="{{ $basePath . 'sello-registro-marca-de-agua.webp'}}" style="width: 50px">
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center border p-2">
                    <p>
                        cédula de identidad
                    </p>
                </div>
            </div>

        </div>
    </div>



</body>
</html>
