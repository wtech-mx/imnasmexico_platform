<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Titulo</title>
    @php
        $domain = request()->getHost();
        $basePath = ($domain == 'plataforma.imnasmexico.com')
                ? 'https://plataforma.imnasmexico.com/documentos_nuevos/titulo/'
                : 'documentos_nuevos/titulo/';
    @endphp

    @include('admin.pdf.nuevos.fuentes')

    <style>

        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        .container {
            position: relative;
            width: 100%;
            height:auto;
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
        .col-3 { width: 21.20%; } /* 25% - 4.64% */
        .col-4 { width: 30.90%; } /* 33.33% - 4.64% */
        .col-5 { width: 37.02%; } /* 41.66% - 4.64% */
        .col-6 { width: 45.36%; } /* 50% - 4.64% */
        .col-7 { width: 53.69%; } /* 58.33% - 4.64% */
        .col-8 { width: 62.70%; } /* 66.66% - 4.64% */
        .col-9 { width: 70.36%; } /* 75% - 4.64% */
        .col-10 { width: 78.69%; } /* 83.33% - 4.64% */
        .col-11 { width: 87.02%; } /* 91.66% - 4.64% */
        .col-12 { width: 96.10%; } /* 100% - 4.64% */

        .text-center {
            text-align: center;
        }

        .text-start{
            text-align: start;
        }

        .text-end{
            text-align: end;
        }

        .border {
            border: 1px solid #000;
        }

        .p-2{
            padding: 10px;
        }

        .img_registro_header{
            width: 150px;
        }

        .img_logoAfi_header{
            width: 130px;
        }

        .img_stps_registro_header{
            width: 200px;
        }

        .img_firmas_delanteras{
            width: 160px;
        }

        .img_traseras{
            width: 180px;

        }

        .h3_nomre_firmas{
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
            font-size: 17px;
            line-height: 19px;
            color:#010101;
        }

        .texto_emosires{
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            font-size: 20px;
            margin-top: 10px!important;
            line-height: 19px;
            color:#010101;
        }

        .m-0{
            margin: 0;
        }

        .p-0{
            padding: 0;
        }

        .my-auto{
            margin-top: auto;
            margin-bottom: auto;
        }

        .azul_fuerte{
            color: #2c6d77;
        }

        .azul_claro{
            color: #5bb4c2;
        }

        .texto_documentos{
            font-size: 16px;
            font-family: 'OpenSauceOne_Regular';
            font-weight: '300';
            margin-top: 20px;
            margin-bottom: 40px;
            color: #545454;
        }

        .texto_documentos_ligth{
            font-size: 20px;
            font-family: 'OpenSans_Regular';
            font-weight: 'regular';
            margin-top: 20px;
            margin-bottom: 40px;
        }

        .strong_folio{
            font-size: 23px;
            font-family: 'OpenSauceOne_Bold';
            font-weight: 'regular';
            margin-top: 20px;
            margin-bottom: 40px;
        }

        .titulo_cedula{
            font-size: 53px;
            font-family: 'Montserrat_ExtraBold';
            font-weight: 'regular';
            line-height:45px;
        }

        .titulo_name{
            font-size: 37px;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            line-height:18px;
        }

        .titulo_especialidad_trasero{
            font-size: 25px;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            line-height:18px;
        }

        .subtitulo_cedula{
            font-size: 29px;
            font-family: 'OPTIEngraversOldEnglish';
            font-weight: 'regular';
            line-height:33px;
        }

        .titulo_especialidad{
            font-size: 32px;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            line-height: 25px;

        }

        .capitalize{
            text-transform: capitalize;
        }

        .uppercase{
            text-transform: uppercase;
        }

        .especialidad{
            font-size: 10px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            margin-top: 20px;
            margin-bottom: 40px;
            margin-left: 50px;
            margin-right: 50px;
        }

        .especialidad_trasera{
            font-size: 37px;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
        }

        .texto_trasero{
            font-size:11px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            margin-top: 20px;
            line-height: 14px;
            color: #3d3b3a;
        }

        .texto_trasero3{
            font-size:11px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            color: #3d3b3a;
        }

        .texto_trasero4{
            font-size:10px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            color: #2c6d77;
        }

        .texto_trasero2{
            font-size:7px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            color: #3d3b3a;
            line-height: 10px;
        }

        .texto_principal_cedula{
            font-size: 19px;
            font-family: 'Montserrat_Medium';
            font-weight: 'regular';
            line-height: 18px; color: #545454;
        }

        .folio{
            font-size: 23px;
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
            margin-top: 20px;
            margin-bottom: 40px;
        }

        .folio_result{
            font-size: 15px;
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
        }

        .letra_sola{
            font-size: 13px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
        }

        .texto_footer{
            font-size: 11px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            color: #2c6d77;
        }

        .texto_footer2{
            font-size: 9px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
        }

        .tipo{
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            font-size: 0px;
            font-size: 15px;
            color:#000;
            margin: 0;
            padding: 0;
            line-height: 0;
         }

        .cea{
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            color:#2c6d77;
            font-size: 40px;
            margin: 0;
            padding: 0;
            line-height: 35px;
        }


        .oval {
            width: 100%;
            height: 100%;
            border-radius: 80%;
            background-color: transparent;
            background-size: cover;
            background-position: center center;
            background-image: url('{{ $basePath . 'foto.jpeg'}}');
        }

        .oval-container {
            margin-left: 65px;
            width: 310px;
            height: 400px;
            overflow: hidden;
            background: transparent;
            /* Ajuste condicional de top */
        }

        .certificado_titulo{
            font-size: 16px;
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
            line-height: 15px;
            color: #2c6d77;
        }

        .acuerdo{
            font-size: 35px;
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
            line-height:18px;
            color: #2c6d77;
        }

    </style>
</head>
<body>

    <div class="container">
        <!-- Contenido superpuesto sobre la imagen -->
        <div class="content">

            <div class="row" >
                <div class="col-4 text-center border " style="margin-top: 120px">
                </div>

                <div class="col-4 text-center border " style="margin-top: 120px">
                    <img class="" src="{{ $basePath . 'logo.png'}}" style="width: 80%">
                </div>

                <div class="col-4 text-center border " style="margin-top: 120px">
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center border">
                    <h5 class="azul_fuerte uppercase subtitulo_cedula  m-0 p-0">
                        Instituto Integral AM 360 a través de Registro <br>
                        Nacional Instituto Mexicano Naturales Ain Spa
                    </h5>
                </div>

            </div>

            <div class="row">

                <div class="col-4 text-center border ">
                    <div class="oval-container">
                        <div class="oval" style="">
                        </div>
                    </div>
                </div>

                <div class="col-8 text-center border ">

                    <p class="texto_documentos uppercase p-0 m-0" style="margin-bottom: 40px">
                        otorga a
                    </p>

                    <h1 class="h1_nombre azul_fuerte titulo_name p-0 m-0">JUNA DEL ARCON</h1>

                    <h2 class="azul_fuerte titulo_especialidad uppercase p-0" style="margin-bottom: 13px;margin-top:13px">
                        Cosmiatria y Cosmetologia
                    </h2>

                    <p class="texto_documentos uppercase p-0 m-0" style="margin-bottom: 40px">
                        En virtud de haber concluido <br>
                         satisfactoriamente con los créditos honoríficos <br>
                         requeridos con respecto al plan vigente. <br>
                         Con fundamento en los Estatutos Institucionales <br>
                         del Instituto Mexicano Naturales Ain Spa.
                    </p>

                </div>

            </div>

            <div class="row">
                <div class="col-6 text-center border ">
                    <img src="{{ $basePath . 'sello-registro-marca-de-agua.webp'}}" class="img_traseras">

                </div>

                <div class="col-6 text-center border ">
                    <p class="texto_principal_cedula uppercase" style="margin-bottom: 40px">
                        La Dirección General del Instituto Mexicano Naturales Ain Spa y <br>
                         del Registro Nacional Instituto Mexicano Naturales Ain Spa, <br>
                          expiden el siguiente reconocimiento
                    </p>
                </div>

            </div>

            <div class="row">
                <div class="col-4 text-center border ">
                    <img src="{{ $basePath . 'juanpa.webp'}}" class="img_firmas_delanteras">
                    <h3 class="h3_nomre_firmas uppercase m-0 p-0">Juan Pablo Soto</h3>
                    <h5 class="texto_emosires m-0 p-0">Comite Dictaminador <br> RNIMNAS</h5>
                </div>

                <div class="col-4 text-center border ">
                    <img src="{{ $basePath . 'carla.webp'}}" class="img_firmas_delanteras">
                    <h3 class="h3_nomre_firmas uppercase m-0 p-0">Lic. Carla Rizo FLORES</h3>
                    <h5 class="texto_emosires m-0 p-0">Directora General <br> IMNAS</h5>
                </div>

                <div class="col-4 text-center border ">
                    <img src="{{ $basePath . 'maria.webp'}}" class="img_firmas_delanteras">
                    <h3 class="h3_nomre_firmas uppercase m-0 p-0">Lic. Ma. Luisa Flores</h3>
                    <h5 class="texto_emosires m-0 p-0">Emisor de certificados <br> RNIMNAS</h5>
                </div>
            </div>

            <div class="row" >

                <div class="col-4 border  text-center" style="margin-top: 90px">
                    <img class="img_stps_registro_header " src="{{ $basePath . 'stps.webp'}}" style="">
                </div>

                <div class="col-4 border  text-center" style="margin-top: 90px">
                    <img class="" src="{{ $basePath . 'sello.webp'}}" style="width: 200px">
                </div>

                <div class="col-4 border  text-center"  style="margin-top: 90px;">
                    <img class="img_stps_registro_header " src="{{ $basePath . 'registro_nacional.png'}}" style="">
                </div>

            </div>


        </div>
    </div>

</body>
</html>
