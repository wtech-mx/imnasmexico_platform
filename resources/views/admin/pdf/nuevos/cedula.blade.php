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
        .col-1 { width: 3.69%; }  /* 8.33% - 4.64% */
        .col-2 { width: 12.02%; } /* 16.66% - 4.64% */
        .col-3 { width: 20.36%; } /* 25% - 4.64% */
        .col-4 { width: 28.69%; } /* 33.33% - 4.64% */
        .col-5 { width: 37.02%; } /* 41.66% - 4.64% */
        .col-6 { width: 45.36%; } /* 50% - 4.64% */
        .col-7 { width: 53.69%; } /* 58.33% - 4.64% */
        .col-8 { width: 62.02%; } /* 66.66% - 4.64% */
        .col-9 { width: 70.36%; } /* 75% - 4.64% */
        .col-10 { width: 78.69%; } /* 83.33% - 4.64% */
        .col-11 { width: 87.02%; } /* 91.66% - 4.64% */
        .col-12 { width: 95.36%; } /* 100% - 4.64% */

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
