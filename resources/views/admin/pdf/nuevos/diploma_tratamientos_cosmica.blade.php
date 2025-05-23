<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reconocimiento </title>
    @php
        $domain = request()->getHost();
        $basePath = ($domain == 'plataforma.imnasmexico.com')
                ? 'https://plataforma.imnasmexico.com/documentos_nuevos/'
                : 'documentos_nuevos/';

    @endphp

    @include('admin.pdf.nuevos.fuentes')

    <style>

        .border {
            border: 0px solid #000;
        }

        .container {
            position: relative;
            width: 816px;  /* 8.5 in * 96 dpi */
            height: 1055px; /* 11 in * 96 dpi */
            margin: 0 auto;
            overflow: hidden;
            background-image: url('https://plataforma.imnasmexico.com/documentos_nuevos/diploma_cosmica.png');
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
        }

        [class^="col-"] {
            float: left;
            padding-left: 15px;
            padding-right: 15px;
            box-sizing: border-box;
        }
        .col-1 { width: 3.69%; }  /* 8.33% - 4.64% */
        .col-2 { width: 12.70%; } /* 16.66% - 4.64% */
        .col-3 { width: 21.00%; } /* 25% - 4.64% */
        .col-4 { width: 29.30%; } /* 33.33% - 4.64% */
        .col-5 { width: 37.02%; } /* 41.66% - 4.64% */
        .col-6 { width: 45.90%; } /* 50% - 4.64% */
        .col-7 { width: 53.69%; } /* 58.33% - 4.64% */
        .col-8 { width: 62.70%; } /* 66.66% - 4.64% */
        .col-9 { width: 70.36%; } /* 75% - 4.64% */
        .col-10 { width: 78.69%; } /* 83.33% - 4.64% */
        .col-11 { width: 87.02%; } /* 91.66% - 4.64% */
        .col-12 { width: 95.80%; } /* 100% - 4.64% */

        .titulo{
            font-family: 'Boston_Angel_Regular';
            font-weight: 'regular';
            color: #2c6d77;
            font-size: 25px;
            line-height: 15px;
        }

        .parrafo{
            font-family: 'Belleza-Regular';
            font-weight: 'regular';
            color: #737373;
            font-size: 15px;
        }

        .nombre_persona{
            font-family: 'Tangerine-Regular';
            font-weight: 'regular';
            color: #2c6d77;
            font-size: 43px;
            line-height: 35px;
        }

        .curso{
            font-family: 'Belleza-Regular';
            font-weight: 'regular';
            color: #2c6d77;
            font-size: 33px;
            line-height: 35px;
            margin: 0!important;
            padding: 0!important;
        }

        .footer{
            color: #000;
            font-size: 19px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';

        }

        .parrafo2{
            font-family: 'Belleza-Regular';
            font-weight: 'regular';
            color: #737373;
            font-size: 13px;
        }

        .img_logo {
            width: 330px;  /* Tamaño máximo permitido */
            height: auto;
            margin-left: auto;
            margin-right: auto;
            margin-top: 0px;
            padding: 0;
        }

        .img_logo img {
            max-width: 90%;  /* Tamaño máximo permitido */
            max-height: 90%;
            object-fit: contain; /* Mantiene la proporción sin cortar */
            padding: 0;
            margin: 0;
        }

        .nombre_flotante{
            position: absolute;
            top: 33%;
            left: 15%;
            font-size: 20px;
        }


        .fecha_flotante{
            position: absolute;
            top: 68%;
            left: 13%;
            font-size: 20px;
        }

    </style>
</head>
<body>

    <div class="container">

        <div class="row" style="position: relative">
            <div class="col-12 text-center nombre_flotante" style="">
                <h1>{{ $nombre }}
                </h1>
            </div>

            <h2 class="fecha_flotante" style="">
                12 y 13 de Abril 2025
            </h2>

        </div>

    </div>

</body>
</html>
