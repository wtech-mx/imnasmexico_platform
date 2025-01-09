<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Credencial</title>
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
        .col-6 { width: 39.90%; } /* 50% - 4.64% */
        .col-7 { width: 53.69%; } /* 58.33% - 4.64% */
        .col-8 { width: 56.30%; } /* 66.66% - 4.64% */
        .col-9 { width: 70.36%; } /* 75% - 4.64% */
        .col-10 { width: 78.69%; } /* 83.33% - 4.64% */
        .col-11 { width: 87.02%; } /* 91.66% - 4.64% */
        .col-12 { width: 89.50%; } /* 100% - 4.64% */

        .text_qr{
            font-size: 3px;
        }

        .tipo{
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            font-size: 0px;
            font-size: 6px;
            color:#000;
            margin: 0;
            padding: 0;
            line-height: 0;
         }

        .cea{
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            color:#2c6d77;
            font-size: 18px;
            margin: 0;
            padding: 0;
            line-height: 10px;
        }

        .text_datos{
            font-size: 8px;
            font-family: 'OpenSans_Regular';
            font-weight: 'regular';
            line-height: 6px;

        }

        .oval-container {
            width: 92px;
            height: 112px;
        }

        .oval {
            width: 90px;
            height: 112px;
        }

        .col_azul{
            background: #5bb4c2;
        }

        .titulo_principal{
            font-size: 10px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            line-height: 6px;
            color: #000;
        }

        .titulo_principal_strong{
            font-size: 10px;
            font-family: 'Montserrat_ExtraBold';
            font-weight: 'regular';
            line-height: 6px;
            color: #000;
        }

    </style>
</head>
<body>

    <div class="container">

        <div class="row">
            <div class="col-8 text-start border ">
                <div class="col_azul">
                    <p class="titulo_principal">
                        <strong class="titulo_principal_strong">REGISTRO NACIONAL</strong> <br>
                        INSTITUTO MEXICANO NATURALES AIN SPA
                    </p>
                </div>

            </div>
            <div class="col-2 text-center border">
                <img class="" src="{{ $basePath . 'logo.png'}}" style="width: 40px">
            </div>
            <div class="col-2 text-center border">
                <img class="" src="{{ $basePath . 'registro_nacional.png'}}" style="width: 60px">
            </div>
        </div>

        <div class="row">
            <div class="col-3 text-center border ">
                <img class="" src="{{ $basePath . 'qr.png'}}" style="width: 40px">

                <p class="text_qr uppercase">Escanea PARA Verifica la <br> autenticidad de este <br> documento </p>
                <h6 class="azul_claro tipo uppercase m-0 p-0">
                    TIPO
                </h6>

                <h6 class="azul_claro cea uppercase m-0 p-0">
                    CFC
                </h6>
            </div>

            <div class="col-5  border ">
                <p class="text_datos" style="">
                    <strong>Nombre</strong> <br>
                    ruiz de alarcon
                    Juana

                     <br><strong>curp</strong> <br>
                    JUANA1234567MMCLTA4

                     <br><strong>nacionalidad</strong> <br>
                    mexicana

                     <br><strong>especialidad</strong> <br>
                    Cosmiatria y Cosmetologia
                </p>
            </div>

            <div class="col-4 text-start border ">
                <div class="oval-container">
                    <img class="oval" src="{{ $basePath . 'foto.jpeg'}}" style="" />
                </div>
            </div>

        </div>

    </div>

</body>
</html>
