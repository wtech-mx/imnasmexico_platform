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

        $basePathUtilidades = ($domain == 'plataforma.imnasmexico.com')
            ? 'https://plataforma.imnasmexico.com/utilidades_documentos/'
            : 'utilidades_documentos/';
    @endphp

    @include('admin.pdf.nuevos.fuentes')

    <style>
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


        .border {
            border: 0px solid #000;
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

        .img_firmas_delanteras_dire{
            width: 130px;
        }

        .img_traseras{
            width: 220px;
        }

        .h3_nomre_firmas{
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
            font-size: 17px;
            line-height: 19px;
            color:#010101;
        }

        .h3_nomre_firmas_dire{
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
            font-size: 11px;
            line-height: 14px;
            color:#010101;
        }

        .texto_emosires{
            font-family: 'Montserrat_LightItalic';
            font-weight: 'regular';
            font-size: 20px;
            margin-top: 10px!important;
            line-height: 19px;
            color:#010101;
        }

        .texto_emosires_dire{
            font-family: 'Montserrat_LightItalic';
            font-weight: 'regular';
            font-size: 15px;
            margin-top: 5px!important;
            line-height: 17px;
            color:#010101;
        }

        .texto_documentos{
            font-size: 33px;
            font-family: 'AlexBrush_Regular';
            font-weight: 'regular';
            margin-top: 20px;
            margin-bottom: 40px;
            color: #747474;
            line-height: 22px;
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
            font-size: 40px;
            font-family: 'OPTIEngraversOldEnglish';
            font-weight: 'regular';
            line-height:18px;
        }

        .titulo_especialidad_trasero{
            font-size: 30px;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            line-height:18px;
        }

        .subtitulo_cedula{
            font-size: 29px;
            font-family: 'OPTIEngraversOldEnglish';
            font-weight: 'regular';
            line-height:22px;
        }

        .titulo_especialidad{
            font-size: 32px;
            font-family: 'OPTIEngraversOldEnglish';
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
            font-size:16px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            margin-top: 20px;
            line-height: 15px;
            margin-left: 50px;
            margin-right: 50px;
            color: #010101;
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
            font-size: 22px;
            font-family: 'Montserrat_Light';
            font-weight: 'normal';
            line-height: 18px;
            color: #747474;
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
            font-size: 70px;
            margin: 0;
            padding: 0;
            line-height: 65px;
        }

        .oval {
            width: 100%;
            height: 100%;
            border-radius: 80%;
            background-color: transparent;
            background-size: cover;
            background-position: center center;
            /* background-image: url('{{ $basePath . 'foto.jpeg'}}'); */
        }

        .oval-container {
            margin-left: 65px;
            width: 330px;
            height: 460px;
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

        .lista{
            color:#2c6d77;
            font-size: 20px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
        }

        .lista_strong{
            color:#010101;
            font-size: 20px;
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
        }

        /* .img_logo{
            width: 300px;
            height: 300px;
            margin-left: auto;
            margin-right: auto;
        } */

        .img_logo {
            width: 300px;  /* Tamaño máximo permitido */
            height: 300px;
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
                <div class="col-4 text-center border " style="margin-top: 120px">
                </div>

                <div class="col-4 text-center border " style="margin-top: 120px">
                    <div class="img_logo">
                        <img src="{{ $basePathUtilidades . $fileName_logo }}" alt="Logo">
                    </div>
                    {{-- <div class="img_logo" style="background: url('{{ $basePathUtilidades . $fileName_logo }}') #ffffff00  50% / contain no-repeat;"></div> --}}
                </div>

                <div class="col-4 text-center border " style="margin-top: 120px">
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center border" style="margin-top: 10px;margin-bottom: 0px;">
                    <h5 class="azul_fuerte subtitulo_cedula " style="margin-right:60px;margin-left:60px;">
                        {{ $name_escuela }} a través de Registro
                        Nacional Instituto Mexicano Naturales Ain Spa
                    </h5>
                </div>

            </div>

            <div class="row">

                <div class="col-4 text-center border ">

                    <div class="oval-container">
                        <img class="oval" src="{{ $basePathUtilidades . $fileName }}" alt="Imagen">
                    </div>
                </div>

                <div class="col-8 text-center border ">
                    <p class="texto_documentos  p-0 m-0" style="margin-bottom: 40px">
                        otorga a
                    </p>

                    <h1 class="azul_fuerte titulo_name p-0 m-0" style="margin-bottom:40px">
                        {!! $nombre !!}
                    </h1>

                    <p class="texto_documentos  p-0 m-0" style="margin-bottom: 40px">
                        el título de
                    </p>

                    <h2 class="azul_fuerte titulo_especialidad  p-0" style="margin-bottom: 20px;">
                        {{ ucwords(strtolower($curso)) }}
                    </h2>

                    <p class="texto_documentos p-0 m-0" style="margin-bottom: 40px">
                        En virtud de haber concluido <br>
                         satisfactoriamente con los créditos honoríficos <br>
                         requeridos con respecto al plan vigente. <br>
                         Con fundamento en los Estatutos Institucionales <br>
                         del Instituto Mexicano Naturales Ain Spa.
                    </p>

                </div>

            </div>

            <div class="row">
                <div class="col-4 text-center border ">
                    <img src="{{ $basePath . 'sello-registro-marca-de-agua.webp'}}" class="img_traseras">
                </div>

                <div class="col-8 text-center border ">
                    <p class="texto_principal_cedula uppercase" style="margin-bottom: auto;margin-top: 60px">
                        Expedido en la Ciudad de México,<br>  el dia {{ \Carbon\Carbon::parse($fecha)->isoFormat('D [de] MMMM [del] YYYY') }}
                    </p>
                </div>

            </div>

            <div class="row">

                @if($orden_firmas == 'Predeterminada')

                    @if($fileName_firma_director != 'https://plataforma.imnasmexico.com/cursos/no-image.jpg')

                        <div class="col-3 text-center">
                            <img src="{{ $basePath . 'juanpa.webp'}}" class="img_firmas_delanteras_dire">
                            <h3 class="h3_nomre_firmas_dire capitalize m-0 p-0">Juan Pablo Soto</h3>
                            <h5 class="texto_emosires_dire capitalize m-0 p-0">Comite Dictaminador <br> RNIMNAS</h5>
                        </div>

                        <div class="col-3 text-center">
                            <img src="{{ $basePath . 'carla.webp'}}" class="img_firmas_delanteras_dire">
                            <h3 class="h3_nomre_firmas_dire capitalize m-0 p-0">Lic. Carla Rizo FLORES</h3>
                            <h5 class="texto_emosires_dire capitalize m-0 p-0">Directora General <br> IMNAS</h5>
                        </div>

                        <div class="col-3 text-center">
                            <img src="{{ $basePath . 'maria.webp'}}" class="img_firmas_delanteras_dire">
                            <h3 class="h3_nomre_firmas_dire capitalize m-0 p-0">Lic. Ma. Luisa Flores</h3>
                            <h5 class="texto_emosires_dire capitalize m-0 p-0">Emisor de certificados <br> RNIMNAS</h5>
                        </div>

                        <div class="col-3 text-center">
                            <img src="{{ $basePathUtilidades . $fileName_firma_director}}" class="img_firmas_delanteras_dire">
                            <h3 class="h3_nomre_firmas_dire capitalize m-0 p-0">{{ $director }}</h3>
                            <h5 class="texto_emosires_dire capitalize m-0 p-0">{{ $firma_directora }}</h5>
                        </div>

                        @else

                        <div class="col-4 text-center border ">
                            <img src="{{ $basePath . 'juanpa.webp'}}" class="img_firmas_delanteras">
                            <h3 class="h3_nomre_firmas capitalize m-0 p-0">Juan Pablo Soto</h3>
                            <h5 class="texto_emosires capitalize m-0 p-0">Comite Dictaminador <br> RNIMNAS</h5>
                        </div>

                        <div class="col-4 text-center border ">
                            <img src="{{ $basePath . 'carla.webp'}}" class="img_firmas_delanteras">
                            <h3 class="h3_nomre_firmas capitalize m-0 p-0">Lic. Carla Rizo FLORES</h3>
                            <h5 class="texto_emosires capitalize m-0 p-0">Directora General <br> IMNAS</h5>
                        </div>

                        <div class="col-4 text-center border ">
                            <img src="{{ $basePath . 'maria.webp'}}" class="img_firmas_delanteras">
                            <h3 class="h3_nomre_firmas capitalize m-0 p-0">Lic. Ma. Luisa Flores</h3>
                            <h5 class="texto_emosires capitalize m-0 p-0">Emisor de certificados <br> RNIMNAS</h5>
                        </div>

                    @endif

                @else

                @if($fileName_firma_director != 'https://plataforma.imnasmexico.com/cursos/no-image.jpg')

                    <div class="col-3 text-center">
                        <img src="{{ $basePath . 'carla.webp'}}" class="img_firmas_delanteras_dire">
                        <h3 class="h3_nomre_firmas_dire capitalize m-0 p-0">Lic. Carla Rizo FLORES</h3>
                        <h5 class="texto_emosires_dire capitalize m-0 p-0">Directora General <br> IMNAS</h5>
                    </div>

                    <div class="col-3 text-center">
                        <img src="{{ $basePathUtilidades . $fileName_firma_directorOtra}}" class="img_firmas_delanteras_dire">
                        <h3 class="h3_nomre_firmas_dire capitalize m-0 p-0">{{ $titular2 }}</h3>
                        <h5 class="texto_emosires_dire capitalize m-0 p-0">{{ $texto_firma_personalizada2 }}</h5>
                    </div>

                    <div class="col-3 text-center">
                        <img src="{{ $basePathUtilidades . $fileName_firma_director}}" class="img_firmas_delanteras_dire">
                        <h3 class="h3_nomre_firmas_dire capitalize m-0 p-0">{{ $titular1 }}</h3>
                        <h5 class="texto_emosires_dire capitalize m-0 p-0">{{ $texto_firma_personalizada }}</h5>
                    </div>

                    <div class="col-3 text-center">
                        <img src="{{ $basePath . 'maria.webp'}}" class="img_firmas_delanteras_dire">
                        <h3 class="h3_nomre_firmas_dire capitalize m-0 p-0">Lic. Ma. Luisa Flores</h3>
                        <h5 class="texto_emosires_dire capitalize m-0 p-0">Emisor de certificados <br> RNIMNAS</h5>
                    </div>

                @endif

                @endif



            </div>


            <div class="row" >

                <div class="col-4 border  text-center" style="margin-top: 30px">
                    <img class="img_stps_registro_header " src="{{ $basePath . 'stps.webp'}}" style="margin-top: 70px">
                </div>

                <div class="col-4 border  text-center" style="margin-top: 30px;">
                    <img class="" src="{{ $basePath . 'sello.webp'}}" style="width: 220px;">
                </div>

                <div class="col-4 border  text-center"  style="margin-top: 30px;">
                    <img class="img_stps_registro_header " src="{{ $basePath . 'registro_nacional.png'}}" style="margin-top: 50px">
                </div>

            </div>

        </div>
    </div>

    <div class="container">
        <!-- Contenido superpuesto sobre la imagen -->
        <div class="content">

            <div class="row" >
                <div class="col-4 text-center border " style="margin-top: 120px">
                </div>

                <div class="col-4 text-center border " style="margin-top: 120px">
                    <div class="img_logo">
                        <img src="{{ $basePathUtilidades . $fileName_logo }}" alt="Logo">
                    </div>
                    {{-- <div class="img_logo" style="background: url('{{ $basePathUtilidades . $fileName_logo }}') #ffffff00  50% / contain no-repeat;"></div> --}}
                </div>

                <div class="col-4 text-center border " style="margin-top: 120px">
                </div>
            </div>

            <div class="row">
                <!-- Primera columna -->
                <div class="col-6 text-start border">
                    <p class="uppercase lista" style="margin-left: 90px;">
                        <strong class="lista_strong"> Nombre: </strong>{!! $nombre !!} <br>
                        <strong class="lista_strong"> curp:</strong> {{$curp}} <br>
                        <strong class="lista_strong"> carrera:</strong>  {{ ucwords(strtolower($curso)) }} <br>
                        <strong class="lista_strong"> nacionalidad:</strong> mexicana <br>
                        <strong class="lista_strong"> vigencia:</strong> permanente <br>
                    </p>
                </div>

                <!-- Segunda columna -->
                <div class="col-3 text-center border">
                    <p style="margin-top: 70px">
                        @php
                            echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$folio, 'QRCODE',3.8,3.8) . '" style=""   />';
                        @endphp
                    </p>
                </div>

                <!-- Tercera columna -->
                <div class="col-3 text-center border">
                    <h6 class="azul_claro tipo uppercase m-0 p-0" style="margin-top: 70px">
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
                <div class="col-12 text-start border  m-0">
                    <h1 class="azul_fuerte titulo_especialidad_trasero " style="padding:0px 45px 0px 90px;">
                        {{ ucwords(strtolower($curso)) }}
                    </h1>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-start border p-0"  style="margin-bottom: 30px">
                    <p class="texto_trasero uppercase m-0" style="padding:0px 45px 0px 40px">
                        este reconocimiento es <strong>inválido</strong> , si no tiene todas las firmas y sellos que lo que acrediten.
                    </p>
                </div>
            </div>

            <div class="row">

                @if($fileName_firma_director != 'https://plataforma.imnasmexico.com/cursos/no-image.jpg')

                    <div class="col-3 text-center" style="margin-left: 30px">
                        <img src="{{ $basePath . 'sello-registro-marca-de-agua.webp'}}" style="width: 200px;margin-top: 10px" >
                    </div>

                    <div class="col-3 text-center">
                        <img src="{{ $basePath . 'carla.webp'}}" class="img_firmas_delanteras_dire">
                        <h3 class="h3_nomre_firmas_dire capitalize m-0 p-0">Lic. Carla Rizo FLORES</h3>
                        <h5 class="texto_emosires_dire capitalize m-0 p-0">Directora General <br> IMNAS</h5>
                    </div>

                    <div class="col-3 text-center">
                        <img src="{{ $basePathUtilidades . $fileName_firma_director}}" class="img_firmas_delanteras_dire">
                        <h3 class="h3_nomre_firmas_dire capitalize m-0 p-0">{{ $director }}</h3>
                        <h5 class="texto_emosires_dire capitalize m-0 p-0">{{ $firma_directora }}</h5>
                    </div>

                    <div class="col-3">
                        <img class="" src="{{ $basePath . 'sello.webp'}}" style="width: 150px;">
                    </div>

                @else

                    <div class="col-4 text-center border ">
                        <img src="{{ $basePath . 'sello-registro-marca-de-agua.webp'}}" style="width: 270px;margin-top: 10px" >
                    </div>

                    <div class="col-4 text-center border ">
                        <img src="{{ $basePath . 'carla.webp'}}" style="width: 230px;">
                        <h3 class="h3_nomre_firmas uppercase m-0 p-0">Lic. Carla Rizo FLORES</h3>
                        <h5 class="texto_emosires m-0 p-0">Directora General <br> IMNAS</h5>
                    </div>

                    <div class="col-4 text-center border ">
                        <img class="" src="{{ $basePath . 'sello.webp'}}" style="width: 210px;">
                    </div>

                @endif


            </div>

            <div class="row" >

                <div class="col-4 border  text-center" >
                    <img class="" src="{{ $basePath . 'stps.webp'}}" style="width:220px;"  >
                </div>

                <div class="col-4 border  text-center" style="">
                </div>

                <div class="col-4 border  text-center"  style="">
                    <img class=" " src="{{ $basePath . 'registro_nacional.png'}}" style="width:160px;">
                </div>

            </div>


        </div>
    </div>


</body>
</html>
