@extends('layouts.app_documenots')

@section('template_title')
    Nueva Diploma RN
@endsection

@php
$domain = request()->getHost();
$basePath = ($domain == 'plataforma.imnasmexico.com')
    ? asset('documentos_nuevos/diploma/') . '/'
    : asset('documentos_nuevos/diploma/') . '/';

$basePathUtilidades = ($domain == 'plataforma.imnasmexico.com')
    ? asset('utilidades_documentos/') . '/'
    : asset('utilidades_documentos/') . '/';

$basePathUDoc = ($domain == 'plataforma.imnasmexico.com')
    ? asset('documentos_registro/') . '/'
    : asset('documentos_registro/') . '/';

$basePathFirmaDirect = ($domain == 'plataforma.imnasmexico.com')
    ? asset('documentos/') . '/'
    : asset('documentos/') . '/';
@endphp

@include('user.components.documentos_imnas.nuevos.fuentes')

@section('css_custom')
    <style>

        .container2 {
            position: relative;
            width: 480px;
            height: 800px;
            margin: 0 auto; /* Centrar el contenedor */
            overflow: hidden; /* Evitar desbordes */
            background-image: url('{{ $basePath . 'fondo.png'}}');
            background-size: cover; /* Asegura que la imagen cubra toda el área */
            background-position: center center; /* Centra la imagen */
            background-repeat: no-repeat; /* No repetir la imagen */
        }

        .img_registro_header{
            width: 100px;
        }

        .img_logoAfi_header{
            width: 130px;
        }

        .img_stps_registro_header{
            width: 120px;
        }

        .img_firmas_delanteras{
            width: 100px;
        }

        .img_firmas_delanteras_dire{
            width: 90px;
        }

        .img_traseras{
            width: 105px;
        }

        .h3_nomre_firmas{
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
            font-size: 9px;
            line-height: 19px;
            color:#010101;
        }

        .h3_nomre_firmas_dire{
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
            font-size: 8px;
            line-height: 16px;
            color:#010101;
        }

        .texto_emosires{
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            font-size: 10px;
            margin-top: 5px!important;
            line-height: 13px;
            color:#010101;
        }

        .texto_emosires_dire{
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            font-size: 8px;
            margin-top: 5px!important;
            line-height: 11px;
            color:#010101;
        }

        .texto_documentos{
            font-size: 9px;
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
            margin-top: 20px;
            margin-bottom: 40px;
            color: #545454;
        }

        .texto_documentos_ligth{
            font-size: 13px;
            font-family: 'OpenSans_Regular';
            font-weight: 'regular';
            margin-top: 20px;
            margin-bottom: 40px;
        }

        .strong_folio{
            font-size: 13px;
            font-family: 'OpenSauceOne_Bold';
            font-weight: 'regular';
            margin-top: 20px;
            margin-bottom: 30px;
        }

        .titulo_cedula{
            font-size: 30px;
            font-family: 'Montserrat_ExtraBold';
            font-weight: 'regular';
            line-height:45px;
        }

        .titulo_name{
            font-size: 25px;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            line-height:24px;
        }

        .titulo_especialidad_trasero{
            font-size: 25px;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            line-height:18px;
        }

        .subtitulo_cedula{
            font-size: 23px;
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
            line-height:13px;
        }

        .titulo_especialidad{
            font-size: 25px;
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
            font-size:6px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            line-height: 11px;
            color: #3d3b3a;
        }

        .texto_trasero3{
            font-size:7px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            color: #3d3b3a;
        }

        .texto_trasero4{
            font-size:7px;
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
            font-size: 8px;
            font-family: 'Montserrat_Medium';
            font-weight: 'regular';
            line-height: 11px; color: #545454;
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
            font-size: 7px;
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
            line-height: 23px;
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
            background-image: url('{{ $basePathUDoc. '/' .$user->telefono . '/' .$tickets->foto_cuadrada}}');
        }

        .oval-container {
            width: 130px;
            height: 180px;
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
            margin-left: 20px;
        }

        .acuerdo{
            font-size: 35px;
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
            line-height:18px;
            color: #2c6d77;
        }


        .img_logo {
            width: 70px;  /* Tamaño máximo permitido */
            height: 70px;
            margin-left: auto;
            margin-right: auto;
        }

        .img_logo img {
            max-width: 100%;  /* Evita que la imagen se estire */
            max-height: 100%;
            object-fit: contain; /* Mantiene la proporción sin cortar */
        }

    </style>
@endsection

@section('content_documentos')
    <div class="card-front">

        <div class="container2">
            <!-- Contenido superpuesto sobre la imagen -->
            <div class="content">

                <div class="row" >
                    <div class="col-3  text-center"  style="margin-top: 60px;">
                        <img class="img_registro_header " src="{{ $basePath . 'registro_nacional.png'}}" style="">
                    </div>

                    <div class="col-3  text-center" style="margin-top: 60px">
                        <div class="img_logo" style="margin-top:5px;">
                            <img src="{{ $basePathUtilidades . $user->logo }}" alt="Logo">
                        </div>

                        {{-- <div class="img_logo" style="background: url('{{ $basePathUtilidades . $fileName_logo }}') #ffffff00  50% / contain no-repeat;"></div> --}}
                    </div>

                    <div class="col-3  text-center" style="margin-top: 60px">
                        <img class="img_stps_registro_header " src="{{ $basePath . 'stps.webp'}}" style="">

                    </div>

                    <div class="col-3  text-center" style="margin-top: 60px">
                        <img class="" src="{{ $basePath . 'mundo.webp'}}" style="width: 60px">
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-center ">
                        <p class="texto_principal_cedula uppercase" style="margin-bottom: px">
                            La Dirección General del Instituto Mexicano Naturales Ain Spa y <br>
                             del Registro Nacional Instituto Mexicano Naturales Ain Spa, <br>
                              expiden el siguiente reconocimiento
                        </p>
                    </div>

                </div>

                <div class="row">
                    <div class="col-12 text-center ">
                        <h6 class="azul_fuerte uppercase titulo_cedula m-0 p-0">
                            diploma
                        </h6>
                        <h5 class="azul_fuerte uppercase subtitulo_cedula  m-0 p-0">
                            de profesionalización
                        </h5>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-center ">
                        <p class="letra_sola p-0" style="margin-top: 5px;margin-bottom: 5px">
                           A
                        </p>
                    </div>
                </div>

                <div class="row">

                    <div class="col-8 text-center  ">
                        <h1 class="h1_nombre azul_fuerte titulo_name p-0 m-0">
                            {{ $tickets->nombre }}
                        </h1>

                        <h2 class="azul_fuerte texto_documentos_ligth uppercase p-0 "style="margin-bottom: 13px;margin-top:13px">
                            con numero de folio <strong class="strong_folio">{{ $tickets->folio }}</strong>
                        </h2>

                        <p class="texto_documentos uppercase p-0 m-0" style="margin-bottom: 40px">
                            después de haber cumplido los requisitos, <br>
                            duración, y Evaluación del Programa Vigente <br>
                            Correspondiente a
                        </p>

                        <h2 class="azul_fuerte titulo_especialidad uppercase p-0" style="margin-bottom: 13px;margin-top:13px">
                            {{ $tickets->nom_curso }}
                        </h2>


                        <p class="texto_documentos uppercase p-0 m-0" style="margin-bottom: 40px">
                            Revisado y acreditado por la Comisión Mixta, a <br>
                            través de un Portafolio de Evidencias, Prácticas y <br>
                            Exámenes de Suficiencia <br>
                        </p>
                    </div>

                    <div class="col-4 text-center  ">
                        <div class="oval-container">
                            <div class="oval" style="">
                            </div>
                        </div>
                        <p>
                            @php
                                echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$tickets->folio, 'QRCODE',1.8,1.8) . '" style="background: transparent; margin-top: 10px;"   />';
                            @endphp
                        </p>
                        <p class="texto_trasero2" style="padding:0px 20px 0px 20px;">
                            REGISTRO ÚNICO
                        </p>
                    </div>

                </div>

                <div class="row">

                    @if($tickets?->firma_director == 'si')

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
                            <img src="{{ $basePathFirmaDirect  . '/' . $tickets?->User?->telefono . '/' . $tickets?->User?->RegistroImnasEscuela?->firma }}" class="img_firmas_delanteras_dire">
                            <h3 class="h3_nomre_firmas_dire capitalize m-0 p-0">{{ $tickets?->User?->name ?? '' }}</h3>
                            <h5 class="texto_emosires_dire capitalize m-0 p-0"> {{ $tickets?->texto_director }}</h5>
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
                            <img src="{{ $basePath . 'carla.webp'}}" class="img_firmas_delanteras">
                            <h3 class="h3_nomre_firmas capitalize m-0 p-0">Lic. Ma. Luisa Flores</h3>
                            <h5 class="texto_emosires capitalize m-0 p-0">Emisor de certificados <br> RNIMNAS</h5>
                        </div>

                    @endif

                </div>

                <div class="row">
                    <div class="col-12 text-center  ">
                        <p class="azul_fuerte texto_footer uppercase  p-0"  style="margin-top:20px">
                            Expedido en la Ciudad de México,  el dia Fecha. Este documento respalda 120 hrs <br>
                            totales del Curso, así como Documentos Anexos correspondientes con vigencia PERMANENTE <br>
                            ESTE DOCUMENTO NO ES VÁLIDO SI ES MUTILADO. PRESENTA BORRADURAS, TACHADURAS O ENMENDADURAS.
                        </p>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <div class="card-back">

        <div class="container2">
            <!-- Contenido superpuesto sobre la imagen -->

                <div class="row" >
                    <div class="col-3   text-center"  style="margin-top: 60px;">
                        <img class="img_registro_header " src="{{ $basePath . 'registro_nacional.png'}}" style="">
                    </div>

                    <div class="col-3   text-center" style="margin-top: 60px">
                        <div class="img_logo" style="margin-top:5px;">
                            <img src="{{ $basePathUtilidades . $user->logo }}" alt="Logo">
                        </div>
                    </div>

                    <div class="col-3   text-center" style="margin-top: 60px">
                        <img class="img_stps_registro_header " src="{{ $basePath . 'stps.webp'}}" style="">

                    </div>

                    <div class="col-3   text-center" style="margin-top: 60px">
                        <img class="" src="{{ $basePath . 'mundo.webp'}}" style="width: 60px">

                    </div>
                </div>

                <div class="row">
                    <div class="col-12   ">
                        <p class="certificado_titulo text-start">
                            CERTIFICADO ANTE EL REGISTRO NACIONAL <br>
                            INSTITUTO MEXICANO NATURALES AIN SPA
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8 text-center  ">
                        <h1 class="azul_fuerte titulo_name p-0" style="margin-top: 10px;margin-left:150px;">
                            ACUERDO LEGAL
                        </h1>
                    </div>

                    <div class="col-4 text-center  ">

                        <h6 class="azul_claro tipo uppercase m-0 p-0">
                            TIPO
                        </h6>

                        <h6 class="azul_claro cea uppercase m-0 p-0">
                            CFC
                        </h6>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-start " >
                        <p class="texto_trasero uppercase" style="padding:0px 20px 0px 20px;">
                            <strong>ESTATUTOS LEGALES ANTE NOTARIO PÚBLICO, GERARDO GONZÁLEZ-MEZA HOFFMANN:</strong> <br><br>

                            INSTRUMENTO NÚMERO SETENTA Y CINCO MIL SEISCIENTOS SETENTA Y TRES. LIBRO MIL CIENTO CUARENTA Y TRES. CIUDAD DE MÉXICO. A.- LA MODIFICACIÓN AL OBJETO SOCIAL Y LA CONSECUENTE REFORMA AL ARTÍCULO SEGUNDO DE LOS ESTATUTOS SOCIALES; y, B.- LA REFORMA AL ARTÍCULO SEXTO DE LOS ESTATUTOS SOCIALES, que resultan de LA PROTOCOLIZACIÓN del acta de Asamblea General Extraordinaria de Socios de "INSTITUTO MEXICANO NATURALES AIN SPA", SOCIEDAD CIVIL.
                            <br><br>
                            Artículo 5º de la Constitución Política de los Estados Unidos Mexicanos: “A ninguna persona podrá impedirse que se dedique a la profesión, industria, comercio o trabajo que le acomode siendo lícitos... Nadie puede ser privado del producto de su trabajo, sino por resolución judicial.
                            <br><br>
                            Artículo 153 de la Ley General del Trabajo apartado I, III y IV. En general, mejorar el nivel educativo, la competencia laboral y las habilidades de los trabajadores.
                            <br><br>
                            Registrado ante la Secretaría del Trabajo y Previsión Social, el Instituto Mexicano Naturales Ain Spa, como agente capacitador externo con número de registro:{{ $user->clave_clasificacion }}
                            <br><br>
                            XIV.- Que leído y explicado íntegramente por el suscrito notario este instrumento a la compareciente, manifestó su plena comprensión y conformidad con él y lo firmó el día 17 de Junio del 2016 , mismo momento en que lo autorizo definitivamente.- Doy fe.
                            <br><br>
                            Por lo antes descrito el Instituto Mexicano Naturales Ain Spa, para efectos legales de acreditación ante terceros, da el siguiente nombramiento conforme a derecho e inscrito en el Registro Nacional Instituto Mexicano Naturales Ain Spa RNIMNAS, al haber aprobado y cumplido con todos los requisitos que exige el plan de estudios especializado en:

                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-start   m-0"  >
                        <h1 class="azul_fuerte titulo_especialidad_trasero " style="padding:0px 20px 0px 20px;">
                            {{ $tickets->nom_curso }}
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-start  m-0 p-0" >
                        <p class="texto_trasero3 uppercase m-0" style="padding:0px 20px 0px 20px;">
                            este reconocimiento es <strong>inválido</strong> , si no tiene todas las firmas y sellos que lo que acrediten.
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-4 text-center  ">
                        <img src="{{ $basePath . 'sello-constancia.webp'}}" class="img_traseras">
                    </div>

                    <div class="col-4 text-center  ">
                        <p class="texto_trasero2" style="">
                            La autenticidad del <br> presente documento <br> puede ser verificada en
                        </p>
                        @php
                            echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$tickets->folio, 'QRCODE',1.8,1.8) . '" style="background: transparent; padding: px;margin-bottom: 6px;"   />';
                        @endphp
                    </div>

                    <div class="col-4 text-center  ">
                        <img src="{{ $basePath . 'sello-registro-marca-de-agua.webp'}}" class="img_traseras">
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-center   m-0"  >
                        <p class="texto_trasero4" style="padding:0px 20px 0px 20px;">
                            CALLE SUR 109-A No. 260, COL. HEROES DE CHURUBUSCO. DEL. IZTAPALAPA. CIUDAD DE MEXICO. CP.09090 <br>
                            (55) 54459315, (55) 56468832, (55) 43367085, (55) 43367086, (55) 55323297, (55) 55329757 <br>
                            www.imnasmexico.com <br>
                            ESTE DOCUMENTO NO ES VÁLIDO SI ES MUTILADO. PRESENTA BORRADURAS, TACHADURAS O ENMENDADURAS.
                    </div>
                </div>

        </div>

    </div>

@endsection
