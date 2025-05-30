<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reconocimientos </title>
    @php
        $domain = request()->getHost();
        $basePath = ($domain == 'plataforma.imnasmexico.com')
                ? 'https://plataforma.imnasmexico.com/documentos_nuevos/reconocimiento/'
                : 'documentos_nuevos/reconocimiento/';

        $basePathUtilidades = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/utilidades_documentos/'
                    : 'utilidades_documentos/';

    @endphp

    @include('admin.pdf.nuevos.fuentes')

    <style>

        .border {
            border: 0px solid #000;
        }

        .container {
            position: relative;
            width: 816px;  /* 8.5 in * 96 dpi */
            height: 1056px; /* 11 in * 96 dpi */
            margin: 0 auto;
            overflow: hidden;
            background-image: url('{{ $basePath . 'fondo.png'}}');
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
            line-height: 30px;
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
            /* dimensiones fijas para contener el logo */
            width: 290px;
            height: 290px;
            margin: 10px auto 0;    /* 70px de separación arriba, centrado horizontal */
            overflow: hidden;       /* recorta todo lo que sobresalga */
            display: flex;
            align-items: center;    /* centra vertical */
            justify-content: center;/* centra horizontal */
            }

            .img_logo img {
            /* que la imagen ocupe todo el contenedor manteniendo proporción */
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            display: block;
            }

            /* contenedor principal: columna, centrado horizontal */
            .firma-wrapper {
            display: flex;
            flex-direction: column;
            align-items: center;  /* centra todo el contenido */
            }

            /* cuadro fijo para la firma, igual que antes */
            .firma-container {
            width: 120px;
            height: 120px;
            overflow: hidden;
            }

            /* imagen escalada y centrada */
            .firma-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
            margin: 0 auto;
            }

            /* aseguramos que los títulos estén pegados y centrados */
            .h3_nomre_firmas_dire,
            .texto_emosires_dire {
            margin: 4px 0 0;
            text-align: center;
            }


    </style>
</head>
<body>

    <div class="container">

        <div class="row">
            <div class="col-2 text-center border" style="margin-top: 0px">
            </div>

            <div class="col-8 text-center border" style="margin-top: 0px">
                <div class="img_logo">
                  <img src="{{ $basePathUtilidades . $fileName_logo }}" alt="Logo">
                </div>
            </div>

            <div class="col-2 text-center border" style="margin-top: 0px">
            </div>
        </div>

        <div class="row">
            <div class="col-2 text-center border ">
            </div>

            <div class="col-8 text-center border ">
                <h1 class="titulo">
                    El Registro Nacional Instituto Mexicano Naturales Ain Spa  en conjunto con {{ $name_escuela }}
                </h1>
            </div>

            <div class="col-2 text-center border ">
            </div>
        </div>

        <div class="row">
            <div class="col-2 text-center border ">
            </div>

            <div class="col-8 text-center border ">
                <p class="parrafo p-0">  Otorgan el presente reconocimiento con valor curricular <br> a:</p>
            </div>

            <div class="col-2 text-center border ">
            </div>
        </div>

        <div class="row">
            <div class="col-2 text-center border ">
            </div>

            <div class="col-8 text-center border">
                <h3 class="nombre_persona">
                    {!! $nombre !!}
                </h3>
            </div>

            <div class="col-2 text-center border ">
            </div>
        </div>


        <div class="row">
            <div class="col-2 text-center border p-2">
            </div>

            <div class="col-8 text-center border p-2">
                <p class="parrafo">  Por haber concluido exitosamente el curso :</p>
                <h2 class="curso"> {{ ucwords(strtolower($curso)) }}</h2>
                <p class="parrafo"> Realizado el {{ \Carbon\Carbon::parse($fecha)->isoFormat('D [de] MMMM [del] YYYY') }}. </p>
            </div>

            <div class="col-2 text-center border p-2">
            </div>
        </div>


        <div class="row">
            <div class="col-2 text-center border">
            </div>
            <div class="col-8 text-center border ">
                <p class="footer p-0 m-0">Organizado por la marca {{ $name_escuela }} </p>
                <p class="parrafo2 p-0 m-0">Agente  capacitador externo del Registro Nacional Instituto Mexicano Naturales Ain Spa</p>
            </div>
            <div class="col-2 text-center border">
            </div>
        </div>

        <div class="row">
            <div class="col-4 text-center border" style="margin-top:20px">
                <img src="{{ $basePath . 'sello-stps-reconocimiento.png'}}" style="width: 120px;">
            </div>

            <div class="col-4 text-center border"  style="margin-top:20px">
                <img src="{{ $basePath . 'sello-reconocimiento.webp'}}" style="width: 120px;" alt="{{ $basePath . 'sello-reconocimiento.webp'}}">
            </div>

            <div class="col-4" style="margin-top:20px">
                <div class="firma-wrapper">
                  <div class="firma-container">
                    <img
                      src="{{ $basePathUtilidades . $fileName_firma_director }}"
                      class="firma-img"
                      alt="Firma del director">
                  </div>
                  <h3 class="h3_nomre_firmas_dire">{{ $director }}</h3>
                  <h5 class="texto_emosires_dire">{{ $firma_directora }}</h5>
                </div>
            </div>
        </div>

    </div>

</body>
</html>
