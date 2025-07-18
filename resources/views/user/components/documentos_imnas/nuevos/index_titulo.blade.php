@extends('layouts.app_documenots')

@section('template_title')
   Nuevo Titulo Honorifico RN -
@endsection

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Grey+Qo&display=swap" rel="stylesheet">

@php
    $domain = request()->getHost();
    $basePath = ($domain == 'plataforma.imnasmexico.com')
        ? asset('documentos_nuevos/titulo/') . '/'
        : asset('documentos_nuevos/titulo/') . '/';

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
            width: 100%;
            height:auto;
            margin: 0 auto; /* Centrar el contenedor */
            overflow: hidden; /* Evitar desbordes */
            background-image: url('{{ $basePath . 'fondo.png'}}');
            background-size: cover; /* Asegura que la imagen cubra toda el área */
            background-position: center center; /* Centra la imagen */
            background-repeat: no-repeat; /* No repetir la imagen */
        }

        .img_registro_header{
            width: 150px;
        }

        .img_logoAfi_header{
            width: 130px;
        }

        .img_stps_registro_header{
            width: 70px;
        }

        .img_firmas_delanteras{
            width: 70px;
        }

        .img_firmas_delanteras_dire{
            width: 60px;
        }

        .img_traseras{
            width: 130px;
            margin-left: 30px;
        }

        .h3_nomre_firmas{
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
            font-size: 8px;
            line-height: 19px;
            color:#010101;
        }

        .h3_nomre_firmas_dire{
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
            font-size: 6px;
            line-height: 13px;
            color:#010101;
        }

        .texto_emosires{
            font-family: 'Montserrat_LightItalic';
            font-weight: 'regular';
            font-size: 10px;
            margin-top: 5px !important;
            line-height: 11px;
            color: #010101;
        }

        .texto_emosires_dire{
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            font-size: 6px;
            margin-top: 5px!important;
            line-height: 9px;
            color:#010101;
        }

        .texto_documentos{
            font-size: 17px;
            font-family: 'AlexBrush_Regular';
            font-weight: 'regular';
            margin-top: 20px;
            margin-bottom: 40px;
            color: #747474;
            line-height: 15px;
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
            font-size: 18px;
            font-family: 'OPTIEngraversOldEnglish';
            font-weight: 'regular';
            line-height:18px;
        }

        .titulo_especialidad_trasero{
            font-size: 18px;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            line-height:18px;
        }

        .subtitulo_cedula{
            font-size: 20px;
            font-family: 'OPTIEngraversOldEnglish';
            font-weight: 'regular';
            line-height:22px;
        }

        .titulo_especialidad{
            font-size: 27px;
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
            font-size:6px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            line-height: 9px;
            margin-left: 40px;
            margin-right: 40px;
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
            font-size: 13px;
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
            font-size: 35px;
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
            background-image: url('{{ $basePathUDoc. '/' .$user->telefono . '/' .$tickets->foto_cuadrada}}');

        }

        .oval-container {
            margin-left: 30px;
            width: 140px;
            height: 170px;
            overflow: hidden;
            background: transparent;
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
            font-size: 7px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
        }

        .lista_strong{
            color:#010101;
            font-size: 7px;
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
            width: 105px;  /* Tamaño máximo permitido */
            height: 105px;
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
                    <div class="col-4 text-center  " style="margin-top: 30px">
                    </div>

                    <div class="col-4 text-center  " style="margin-top: 30px">
                        <div class="img_logo">
                            <img src="{{ $basePathUtilidades . $user->logo }}" alt="Logo">
                        </div>
                        {{-- <div class="img_logo" style="background: url('{{ $basePathUtilidades . $fileName_logo }}') #ffffff00  50% / contain no-repeat;"></div> --}}
                    </div>

                    <div class="col-4 text-center  " style="margin-top: 30px">
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-center " style="margin-top: 0px;margin-bottom: 0px;">
                        <h5 class="azul_fuerte subtitulo_cedula " style="margin-right:25px;margin-left:20px;">
                            {{ $user->escuela }} a través de Registro
                            Nacional Instituto Mexicano Naturales Ain Spa
                        </h5>
                    </div>

                </div>

                <div class="row">

                    <div class="col-4 text-center  ">

                        <div class="oval-container">
                            <img class="oval" src="">
                        </div>
                    </div>

                    <div class="col-8 text-center  ">
                        <p class="texto_documentos  p-0 m-0" style="margin-bottom: 40px">
                            otorga a
                        </p>

                        <h1 class="azul_fuerte titulo_name p-0 m-0" style="margin-bottom:40px">
                            {{ $tickets->nombre }}
                        </h1>

                        <p class="texto_documentos  p-0 m-0" style="margin-bottom: 40px">
                            el Título Honorífico en la Especialidad de:
                        </p>

                        <h2 class="azul_fuerte titulo_especialidad  p-0" style="margin-bottom: 10px;">
                            {{ $tickets->nom_curso }}
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
                    <div class="col-4 text-center  ">
                        <img src="{{ $basePath . 'sello-registro-marca-de-agua.webp'}}" class="img_traseras">
                    </div>

                    <div class="col-8 text-center  my-auto">
                        <p class="texto_principal_cedula uppercase" style="">
                            Expedido en la Ciudad de México,<br>  el dia {{ \Carbon\Carbon::parse($tickets->fecha_curso)->translatedFormat('d \d\e F \d\e\l Y') }}
                        </p>
                    </div>

                </div>

                <div class="row">

                    @if($tickets->orden_firmas == 'Predeterminada')
                        @if($tickets?->User?->RegistroImnasEscuela?->firma != 'https://plataforma.imnasmexico.com/cursos/no-image.jpg')

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
                                <h5 class="texto_emosires_dire capitalize m-0 p-0">{{ $tickets?->texto_director }} {{ $tickets?->texto_firma_personalizada  }}</h5>
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

                    @elseif($tickets->orden_firmas == 'Alterna')

                        @if($tickets?->User?->RegistroImnasEscuela?->firma != 'https://plataforma.imnasmexico.com/cursos/no-image.jpg')

                            <div class="col-3 text-center">
                                <img src="{{ $basePath . 'carla.webp'}}" class="img_firmas_delanteras_dire">
                                <h3 class="h3_nomre_firmas_dire capitalize m-0 p-0">Lic. Carla Rizo FLORES</h3>
                                <h5 class="texto_emosires_dire capitalize m-0 p-0">Directora General <br> IMNAS</h5>
                            </div>

                            <div class="col-3 text-center">
                                <img src="{{ $basePathFirmaDirect  . '/' . $tickets?->User?->telefono . '/' . $tickets?->User?->RegistroImnasEscuela?->otra_firma_director }}" class="img_firmas_delanteras_dire">
                                <h3 class="h3_nomre_firmas_dire capitalize m-0 p-0">{{ $tickets->titular2 }}</h3>
                                <h5 class="texto_emosires_dire capitalize m-0 p-0">{{ $tickets->texto_firma_personalizada2 }}</h5>
                            </div>

                            <div class="col-3 text-center">
                                <img src="{{ $basePathFirmaDirect  . '/' . $tickets?->User?->telefono . '/' . $tickets?->User?->RegistroImnasEscuela?->firma }}" class="img_firmas_delanteras_dire">
                                <h3 class="h3_nomre_firmas_dire capitalize m-0 p-0">{{ $tickets->titular1 }}</h3>
                                <h5 class="texto_emosires_dire capitalize m-0 p-0">{{ $tickets->texto_firma_personalizada }}</h5>
                            </div>

                            <div class="col-3 text-center">
                                <img src="{{ $basePath . 'maria.webp'}}" class="img_firmas_delanteras_dire">
                                <h3 class="h3_nomre_firmas_dire capitalize m-0 p-0">Lic. Ma. Luisa Flores</h3>
                                <h5 class="texto_emosires_dire capitalize m-0 p-0">Emisor de certificados <br> RNIMNAS</h5>
                            </div>

                        @endif

                    @else

                    @if($tickets?->User?->RegistroImnasEscuela?->firma != 'https://plataforma.imnasmexico.com/cursos/no-image.jpg')

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
                        <h5 class="texto_emosires_dire capitalize m-0 p-0">{{ $tickets?->texto_director }} {{ $tickets?->texto_firma_personalizada  }}</h5>
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
                    @endif

                </div>

                <div class="row" >

                    <div class="col-4   text-center" style="margin-top: 0px">
                        <img class="img_stps_registro_header " src="{{ $basePath . 'stps.webp'}}" style="margin-top: 5px">
                    </div>

                    <div class="col-4   text-center" style="margin-top: 0px;">
                        <img class="" src="{{ $basePath . 'sello.webp'}}" style="width: 60px;">
                    </div>

                    <div class="col-4   text-center"  style="margin-top: 0px;">
                        <img class="img_stps_registro_header " src="{{ $basePath . 'registro_nacional.png'}}" style="margin-top: 00px">
                    </div>

                </div>

            </div>
        </div>


    </div>

    <div class="card-back">

        <div class="container2">
            <!-- Contenido superpuesto sobre la imagen -->
            <div class="content">

                <div class="row" >
                    <div class="col-4 text-center  " style="margin-top: 30px">
                    </div>

                    <div class="col-4 text-center p-1 " style="margin-top: 30px">
                        <div class="img_logo">
                            <img src="{{ $basePathUtilidades . $user->logo }}" alt="Logo">
                        </div>
                        {{-- <div class="img_logo" style="background: url('{{ $basePathUtilidades . $fileName_logo }}') #ffffff00  50% / contain no-repeat;"></div> --}}
                    </div>

                    <div class="col-4 text-center  " style="margin-top: 30px">
                    </div>
                </div>

                <div class="row">
                    <!-- Primera columna -->
                    <div class="col-6 text-start ">
                        <p class="uppercase lista" style="margin-left: 40px;">
                            <strong class="lista_strong"> Nombre: </strong>{{ $tickets->nombre }} <br>
                            <strong class="lista_strong"> {{ $tickets->idocurp ?? 'CURP' }} :</strong> {{ $tickets->curp_escrito }}  <br>
                            <strong class="lista_strong"> carrera:</strong> {{ $tickets->nom_curso }} <br>
                            <strong class="lista_strong"> nacionalidad:</strong> mexicana <br>
                            <strong class="lista_strong"> vigencia:</strong> permanente <br>
                        </p>
                    </div>

                    <!-- Segunda columna -->
                    <div class="col-3 text-center ">
                        <p style="margin-top: 70px">

                        </p>
                    </div>

                    <!-- Tercera columna -->
                    <div class="col-3 text-center  my-auto">
                        <h6 class="azul_claro tipo uppercase m-0 p-0" style="">
                            TIPO
                        </h6>
                        <h6 class="azul_claro cea uppercase m-0 p-0">
                            CFC
                        </h6>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-start " >
                        <p class="texto_trasero uppercase" style="">
                            <strong>ESTATUTOS LEGALES ANTE NOTARIO PÚBLICO, GERARDO GONZÁLEZ-MEZA HOFFMANN:</strong> <br><br>

                            INSTRUMENTO NÚMERO SETENTA Y CINCO MIL SEISCIENTOS SETENTA Y TRES. LIBRO MIL CIENTO CUARENTA Y TRES. CIUDAD DE MÉXICO. A.- LA MODIFICACIÓN AL OBJETO SOCIAL Y LA CONSECUENTE REFORMA AL ARTÍCULO SEGUNDO DE LOS ESTATUTOS SOCIALES; y, B.- LA REFORMA AL ARTÍCULO SEXTO DE LOS ESTATUTOS SOCIALES, que resultan de LA PROTOCOLIZACIÓN del acta de Asamblea General Extraordinaria de Socios de "INSTITUTO MEXICANO NATURALES AIN SPA", SOCIEDAD CIVIL.
                            <br><br>
                            Artículo 5º de la Constitución Política de los Estados Unidos Mexicanos: “A ninguna persona podrá impedirse que se dedique a la profesión, industria, comercio o trabajo que le acomode siendo lícitos... Nadie puede ser privado del producto de su trabajo, sino por resolución judicial.
                            <br><br>
                            Artículo 153 de la Ley General del Trabajo apartado I, III y IV. En general, mejorar el nivel educativo, la competencia laboral y las habilidades de los trabajadores.
                            <br><br>
                            Registrado ante la Secretaría del Trabajo y Previsión Social, el Instituto Mexicano Naturales Ain Spa, como agente capacitador externo con número de registro:  {{ $user->clave_clasificacion }}
                            <br><br>
                            XIV.- Que leído y explicado íntegramente por el suscrito notario este instrumento a la compareciente, manifestó su plena comprensión y conformidad con él y lo firmó el día 17 de Junio del 2016 , mismo momento en que lo autorizo definitivamente.- Doy fe.
                            <br><br>
                            Por lo antes descrito el Instituto Mexicano Naturales Ain Spa, para efectos legales de acreditación ante terceros, da el siguiente nombramiento conforme a derecho e inscrito en el Registro Nacional Instituto Mexicano Naturales Ain Spa RNIMNAS, al haber aprobado y cumplido con todos los requisitos que exige el plan de estudios especializado en:

                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-start   m-0">
                        <h1 class="azul_fuerte titulo_especialidad_trasero " style="padding:0px 0px 0px 40px;">
                            {{ $tickets->nom_curso }}
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-start  p-0"  style="">
                        <p class="texto_trasero uppercase m-0" style="padding:0px 45px 0px 50px">
                            este reconocimiento es <strong>inválido</strong> , si no tiene todas las firmas y sellos que lo que acrediten.
                        </p>
                    </div>
                </div>

                <div class="row">

                    @if($tickets?->firma_director == 'si')

                        <div class="col-3 text-center  my-auto" style="padding: 0 0 0 45px;">
                            <img src="{{ $basePath . 'sello-registro-marca-de-agua.webp'}}" style="width: 60px;" >
                        </div>

                        <div class="col-3 text-center my-auto" style="padding: 0 0 0 45px;">
                            <img src="{{ $basePath . 'carla.webp'}}" style="width: 80px;">
                            <h3 class="h3_nomre_firmas_dire uppercase m-0 p-0">Lic. Carla Rizo FLORES</h3>
                            <h5 class="texto_emosires_dire m-0 p-0">Directora General <br> IMNAS</h5>
                        </div>

                        <div class="col-3 text-center my-auto">
                            <img src="{{ $basePathFirmaDirect  . '/' . $tickets?->User?->telefono . '/' . $tickets?->User?->RegistroImnasEscuela?->firma }}" class="img_firmas_delanteras_dire">
                            <h3 class="h3_nomre_firmas_dire capitalize m-0 p-0">{{ $tickets?->User?->name ?? '' }}</h3>
                            <h5 class="texto_emosires_dire capitalize m-0 p-0"> {{ $tickets?->texto_director }}{{ $tickets?->texto_firma_personalizada  }}</h5>
                        </div>

                        <div class="col-3 text-center  my-auto">
                            <img class="" src="{{ $basePath . 'sello.webp'}}" style="width: 40px;">
                        </div>

                    @else

                        <div class="col-4 text-center  my-auto" style="padding: 0 0 0 45px;">
                            <img src="{{ $basePath . 'sello-registro-marca-de-agua.webp'}}" style="width: 100px;" >
                        </div>

                        <div class="col-4 text-center  ">
                            <img src="{{ $basePath . 'carla.webp'}}" style="width: 80px;">
                            <h3 class="h3_nomre_firmas uppercase m-0 p-0">Lic. Carla Rizo FLORES</h3>
                            <h5 class="texto_emosires m-0 p-0">Directora General <br> IMNAS</h5>
                        </div>

                        <div class="col-4 text-center  my-auto">
                            <img class="" src="{{ $basePath . 'sello.webp'}}" style="width: 70px;">
                        </div>

                    @endif

                </div>

                <div class="row" >

                    <div class="col-4 text-center" style="">
                        <img class="" src="{{ $basePath . 'stps.webp'}}" style="width:60px;"  >
                    </div>

                    <div class="col-4 text-center" style="">
                    </div>

                    <div class="col-4 text-center"  style="">
                        <img class=" " src="{{ $basePath . 'registro_nacional.png'}}" style="width:50px;">
                    </div>

                </div>


            </div>
        </div>

    </div>
@endsection
