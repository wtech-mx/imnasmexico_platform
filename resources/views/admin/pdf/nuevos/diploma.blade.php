<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diploma</title>
    @php
        $domain = request()->getHost();
        $basePath = ($domain == 'plataforma.imnasmexico.com')
                ? 'https://plataforma.imnasmexico.com/documentos_nuevos/diploma/'
                : 'documentos_nuevos/diploma/';
        $basePathUtilidades = ($domain == 'plataforma.imnasmexico.com')
            ? 'https://plataforma.imnasmexico.com/utilidades_documentos/'
            : 'utilidades_documentos/';
    @endphp

    @include('admin.pdf.nuevos.fuentes')

    <style>

        .container {
            position: relative;
            width: 812px;
            height:1280px;
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
        .col-2 { width: 12.02%; } /* 16.66% - 4.64% */
        .col-3 { width: 21.20%; } /* 25% - 4.64% */
        .col-4 { width: 29.40%; } /* 33.33% - 4.64% */
        .col-5 { width: 37.02%; } /* 41.66% - 4.64% */
        .col-6 { width: 45.36%; } /* 50% - 4.64% */
        .col-7 { width: 53.69%; } /* 58.33% - 4.64% */
        .col-8 { width: 62.70%; } /* 66.66% - 4.64% */
        .col-9 { width: 70.36%; } /* 75% - 4.64% */
        .col-10 { width: 78.69%; } /* 83.33% - 4.64% */
        .col-11 { width: 87.02%; } /* 91.66% - 4.64% */
        .col-12 { width: 96.10%; } /* 100% - 4.64% */


        .img_registro_header{
            width: 150px;
        }

        .img_logoAfi_header{
            width: 130px;
        }

        .img_stps_registro_header{
            width: 160px;
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
            margin-top: 5px!important;
            line-height: 19px;
            color:#010101;
        }

        .texto_documentos{
            font-size: 16px;
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
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
            font-size: 19px;
            font-family: 'OpenSauceOne_Bold';
            font-weight: 'regular';
            margin-top: 20px;
            margin-bottom: 30px;
        }

        .titulo_cedula{
            font-size: 50px;
            font-family: 'Montserrat_ExtraBold';
            font-weight: 'regular';
            line-height:45px;
        }

        .titulo_name{
            font-size: 37px;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            line-height:22px;
        }

        .titulo_especialidad_trasero{
            font-size: 25px;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            line-height:18px;
        }

        .subtitulo_cedula{
            font-size: 33px;
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
            line-height:18px;
        }

        .titulo_especialidad{
            font-size: 30px;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            line-height: 25px;

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
            font-size:8px;
            font-family: 'Montserrat_LightItalic';
            font-weight: 'regular';
            color: #3d3b3a;
            line-height: 7px;
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
            /* background-image: url('{{ $basePath . 'foto.jpeg'}}'); */
            background-image: url('{{ $basePathUtilidades . $fileName }}');

        }

        .oval-container {
            margin-left: 10px;
            width: 230px;
            height: 290px;
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
            margin-left: 40px;
        }

        .acuerdo{
            font-size: 35px;
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
            line-height:18px;
            color: #2c6d77;
        }
/*
        .img_logo{
            width: 110px;
            height: 110px;
            margin-left: auto;
            margin-right: auto;
        } */

        .img_logo {
            width: 110px;  /* Tamaño máximo permitido */
            height: 110px;
            margin-left: auto;
            margin-right: auto;
        }

        .img_logo img {
            max-width: 100%;  /* Evita que la imagen se estire */
            max-height: 100%;
            object-fit: contain; /* Mantiene la proporción sin cortar */
        }


    </style>
</head>
<body>

    <div class="container">
        <!-- Contenido superpuesto sobre la imagen -->
        <div class="content">

            <div class="row" >
                <div class="col-3 border  text-center"  style="margin-top: 90px;">
                    <img class="img_registro_header " src="{{ $basePath . 'registro_nacional.png'}}" style="">
                </div>

                <div class="col-3 border  text-center" style="margin-top: 90px">
                    <div class="img_logo">
                        <img src="{{ $basePathUtilidades . $fileName_logo }}" alt="Logo">
                    </div>

                    {{-- <div class="img_logo" style="background: url('{{ $basePathUtilidades . $fileName_logo }}') #ffffff00  50% / contain no-repeat;"></div> --}}
                </div>

                <div class="col-3 border  text-center" style="margin-top: 90px">
                    <img class="img_stps_registro_header " src="{{ $basePath . 'stps.webp'}}" style="">

                </div>

                <div class="col-3 border  text-center" style="margin-top: 90px">
                    <img class="" src="{{ $basePath . 'mundo.webp'}}" style="width: 100px">
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center border">
                    <p class="texto_principal_cedula uppercase" style="margin-bottom: px">
                        La Dirección General del Instituto Mexicano Naturales Ain Spa y <br>
                         del Registro Nacional Instituto Mexicano Naturales Ain Spa, <br>
                          expiden el siguiente reconocimiento
                    </p>
                </div>

            </div>

            <div class="row">
                <div class="col-12 text-center border">
                    <h6 class="azul_fuerte uppercase titulo_cedula m-0 p-0">
                        diploma
                    </h6>
                    <h5 class="azul_fuerte uppercase subtitulo_cedula  m-0 p-0">
                        de profesionalización
                    </h5>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center border">
                    <p class="letra_sola p-0" style="margin-top: 20p,margin-bottom: 40px">
                       A
                    </p>
                </div>
            </div>

            <div class="row">

                <div class="col-8 text-center border ">
                    <h1 class="h1_nombre azul_fuerte titulo_name p-0 m-0">
                        {!! $nombre !!}
                    </h1>

                    <h2 class="azul_fuerte texto_documentos_ligth uppercase p-0 "style="margin-bottom: 13px;margin-top:13px">
                        con numero de folio <strong class="strong_folio">{{ $folio }}</strong>
                    </h2>

                    <p class="texto_documentos uppercase p-0 m-0" style="margin-bottom: 40px">
                        después de haber cumplido los requisitos, <br>
                        duración, y Evaluación del Programa Vigente <br>
                        Correspondiente a
                    </p>

                    <h2 class="azul_fuerte titulo_especialidad uppercase p-0" style="margin-bottom: 13px;margin-top:13px">
                        {{ ucwords(strtolower($curso)) }}
                    </h2>


                    <p class="texto_documentos uppercase p-0 m-0" style="margin-bottom: 40px">
                        Revisado y acreditado por la Comisión Mixta, a <br>
                        través de un Portafolio de Evidencias, Prácticas y <br>
                        Exámenes de Suficiencia <br>
                    </p>
                </div>

                <div class="col-4 text-center border ">
                    <div class="oval-container">
                        <div class="oval" style="">
                        </div>
                    </div>
                    <p>
                        @php
                            echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$folio, 'QRCODE',2,2) . '" style=""   />';
                        @endphp
                    </p>
                    <p class="texto_trasero2" style="padding:0px 45px 0px 45px;">
                        REGISTRO ÚNICO
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

            <div class="row">
                <div class="col-12 text-center border ">
                    <p class="azul_fuerte texto_footer uppercase  p-0"  style="margin-top:40px">
                        Expedido en la Ciudad de México,  el dia {{ \Carbon\Carbon::parse($fecha)->isoFormat('D [de] MMMM [del] YYYY') }}. Este documento respalda 120 hrs <br>
                        totales del Curso, así como Documentos Anexos correspondientes con vigencia PERMANENTE <br>
                        ESTE DOCUMENTO NO ES VÁLIDO SI ES MUTILADO. PRESENTA BORRADURAS, TACHADURAS O ENMENDADURAS.
                    </p>
                </div>
            </div>

        </div>
    </div>

    <div class="container">
        <!-- Contenido superpuesto sobre la imagen -->

            <div class="row" >
                <div class="col-3 border  text-center"  style="margin-top: 90px;">
                    <img class="img_registro_header " src="{{ $basePath . 'registro_nacional.png'}}" style="">
                </div>

                <div class="col-3 border  text-center" style="margin-top: 90px">
                    {{-- <div class="img_logo" style="background: url('{{ $basePathUtilidades . $fileName_logo }}') #ffffff00  50% / contain no-repeat;"></div> --}}
                    <div class="img_logo">
                        <img src="{{ $basePathUtilidades . $fileName_logo }}" alt="Logo">
                    </div>
                </div>

                <div class="col-3 border  text-center" style="margin-top: 90px">
                    <img class="img_stps_registro_header " src="{{ $basePath . 'stps.webp'}}" style="">

                </div>

                <div class="col-3 border  text-center" style="margin-top: 90px">
                    <img class="" src="{{ $basePath . 'mundo.webp'}}" style="width: 100px">

                </div>
            </div>


            <div class="row">
                <div class="col-12  border ">
                    <p class="certificado_titulo text-end">
                        CERTIFICADO ANTE EL REGISTRO NACIONAL <br>
                        INSTITUTO MEXICANO NATURALES AIN SPA
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-8 text-center border ">
                    <h1 class="azul_fuerte titulo_name p-0" style="margin-top: 20px;margin-left:150px;">
                        ACUERDO LEGAL
                    </h1>
                </div>

                <div class="col-4 text-center border ">

                    <h6 class="azul_claro tipo uppercase m-0 p-0">
                        TIPO
                    </h6>

                    <h6 class="azul_claro cea uppercase m-0 p-0">
                        CFC
                    </h6>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-start border" >
                    <p class="texto_trasero uppercase" style="padding:0px 45px 0px 45px;">
                        <strong>ESTATUTOS LEGALES ANTE NOTARIO PÚBLICO, GERARDO GONZÁLEZ-MEZA HOFFMANN:</strong> <br><br>

                        INSTRUMENTO NÚMERO SETENTA Y CINCO MIL SEISCIENTOS SETENTA Y TRES. LIBRO MIL CIENTO CUARENTA Y TRES. CIUDAD DE MÉXICO. A.- LA MODIFICACIÓN AL OBJETO SOCIAL Y LA CONSECUENTE REFORMA AL ARTÍCULO SEGUNDO DE LOS ESTATUTOS SOCIALES; y, B.- LA REFORMA AL ARTÍCULO SEXTO DE LOS ESTATUTOS SOCIALES, que resultan de LA PROTOCOLIZACIÓN del acta de Asamblea General Extraordinaria de Socios de "INSTITUTO MEXICANO NATURALES AIN SPA", SOCIEDAD CIVIL.
                        <br><br>
                        Artículo 5º de la Constitución Política de los Estados Unidos Mexicanos: “A ninguna persona podrá impedirse que se dedique a la profesión, industria, comercio o trabajo que le acomode siendo lícitos... Nadie puede ser privado del producto de su trabajo, sino por resolución judicial.
                        <br><br>
                        Artículo 153 de la Ley General del Trabajo apartado I, III y IV. En general, mejorar el nivel educativo, la competencia laboral y las habilidades de los trabajadores.
                        <br><br>
                        Registrado ante la Secretaría del Trabajo y Previsión Social, el Instituto Mexicano Naturales Ain Spa, como agente capacitador externo con número de registro: {{ $clave_rfc }}
                        <br><br>
                        XIV.- Que leído y explicado íntegramente por el suscrito notario este instrumento a la compareciente, manifestó su plena comprensión y conformidad con él y lo firmó el día 17 de Junio del 2016 , mismo momento en que lo autorizo definitivamente.- Doy fe.
                        <br><br>
                        Por lo antes descrito el Instituto Mexicano Naturales Ain Spa, para efectos legales de acreditación ante terceros, da el siguiente nombramiento conforme a derecho e inscrito en el Registro Nacional Instituto Mexicano Naturales Ain Spa RNIMNAS, al haber aprobado y cumplido con todos los requisitos que exige el plan de estudios especializado en:

                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-start border  m-0"  >
                    <h1 class="azul_fuerte titulo_especialidad_trasero " style="padding:0px 45px 0px 45px;">
                        {{ ucwords(strtolower($curso)) }}
                    </h1>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-start border m-0 p-0" >
                    <p class="texto_trasero3 uppercase m-0" style="padding:0px 45px 0px 45px;">
                        este reconocimiento es <strong>inválido</strong> , si no tiene todas las firmas y sellos que lo que acrediten.
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-4 text-center border ">
                    <img src="{{ $basePath . 'sello-constancia.webp'}}" class="img_traseras">
                </div>

                <div class="col-4 text-center border ">
                    <p class="texto_trasero2" style="padding:0px 45px 0px 45px;">
                        La autenticidad del <br> presente documento <br> puede ser verificada en
                    </p>

                    @php
                        echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$folio, 'QRCODE',2.2,2.2) . '" style=""   />';
                    @endphp

                </div>

                <div class="col-4 text-center border ">
                    <img src="{{ $basePath . 'sello-registro-marca-de-agua.webp'}}" class="img_traseras">
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center border  m-0"  >
                    <p class="texto_trasero4" style="padding:0px 45px 0px 45px;">
                        CALLE SUR 109-A No. 260, COL. HEROES DE CHURUBUSCO. DEL. IZTAPALAPA. CIUDAD DE MEXICO. CP.09090 <br>
                        (55) 54459315, (55) 56468832, (55) 43367085, (55) 43367086, (55) 55323297, (55) 55329757 <br>
                        www.imnasmexico.com <br>
                        ESTE DOCUMENTO NO ES VÁLIDO SI ES MUTILADO. PRESENTA BORRADURAS, TACHADURAS O ENMENDADURAS.
                </div>
            </div>

    </div>

</body>
</html>
