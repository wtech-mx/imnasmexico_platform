@extends('layouts.app_documenots')

@section('template_title')
   Nueva Tira de materias RN
@endsection

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Grey+Qo&display=swap" rel="stylesheet">
@php
    $domain = request()->getHost();
    $basePath = ($domain == 'plataforma.imnasmexico.com')
        ? asset('documentos_nuevos/tira/') . '/'
        : asset('documentos_nuevos/tira/') . '/';

    $basePathUtilidades = ($domain == 'plataforma.imnasmexico.com')
        ? asset('utilidades_documentos/') . '/'
        : asset('utilidades_documentos/') . '/';

$basePathUDoc = ($domain == 'plataforma.imnasmexico.com')
    ? asset('documentos_registro/') . '/'
    : asset('documentos_registro/') . '/';
@endphp
@include('user.components.documentos_imnas.nuevos.fuentes')

@section('css_custom')
    <style>
        .card-3d-wrap {
            width: 810px!important;
            height: 730px!important;
        }

        .card-3d-wrapper{
            height: 714px!important;
        }


        .tipo{
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            font-size: 0px;
            font-size: 15px;
            color:#000;
            margin: 0;
            padding: 0;
            line-height: 15px;
         }

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
            margin-left: 10px;
            width: 150px;
            height: 200px;
            overflow: hidden;
            background: transparent;
            /* Ajuste condicional de top */
        }

        .titulo_cedula{
            font-size: 16px;
            font-family: 'Montserrat_ExtraBold';
            font-weight: 'regular';
            line-height:45px;
            color: #545454;
        }

        .subtitulo_cedula{
            font-size: 12px;
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
            line-height:10px;
            color: #545454;
        }

        .texto_principal_cedula{
            font-size: 10px;
            font-family: 'Montserrat_Light';
            font-weight: 'regular';
            line-height: 11px;
            color: #545454;
        }

        .texto_prinipal_strong{
            font-size: 11px;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            line-height: 19px; color: #545454;
        }

        .folio{
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            font-size: 10px;
            color:#000;
            margin: 0;
            padding: 0;
            line-height: 0;
         }

        .folio_num{
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            color:#2c6d77;
            font-size: 12px;
            margin: 0;
            padding: 0;
            line-height: 25px;
        }

        .col_izquierda{
            color: #545454;
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
            font-size: 8px;
            line-height: 10px;

        }

        .col_derecha_texto{
            color: #2c6d77;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            font-size: 8px;
            line-height: 10px;

        }

        .col_derecha{
            color: #2c6d77;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            font-size: 12px;
        }

        .contenedor_materia{
            border: solid 1px #5bb4c2;
            border-radius: 50%;
            padding: 5px;
            color: #545454;
            font-size: 14px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
        }

        .certificado_titulo{
            font-size: 16px;
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
            line-height: 15px;
            color: #2c6d77;
            margin-left: 40px;
        }

        .titulo_name{
            font-size: 25px;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            line-height:18px;
        }


        .texto_trasero{
            font-size:7px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            margin-top: 20px;
            line-height: 9px;
            color: #3d3b3a;
        }

        .texto_trasero3{
            font-size:11px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            color: #3d3b3a;
        }


        .img_firmas_delanteras{
            width: 90px;
        }

        .img_logo {
            width: 80px;  /* Tamaño máximo permitido */
            height: 80px;
            margin-left: auto;
            margin-right: auto;
        }

        .img_logo img {
            max-width: 100%;  /* Evita que la imagen se estire */
            max-height: 100%;
            object-fit: contain; /* Mantiene la proporción sin cortar */
        }

        .h3_nomre_firmas{
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
            font-size: 8px;
            line-height: 19px;
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

        .texto_trasero4{
            font-size:6px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            color: #2c6d77;
        }


    </style>
@endsection

@section('content_documentos')

    <div class="card-front">
        <div class="container2">
            <div class="row">
                <div class="col-3 text-center  p-2 my-auto" style="margin-top: 0px">
                    <img class=" " src="{{ $basePath . 'registro_nacional.png'}}" style="width: 80px">
                </div>

                <div class="col-3 text-center  p-2 my-auto" style="margin-top: 0px">
                    <div class="img_logo">
                        <img src="{{ $basePathUtilidades . $user->logo }}" alt="Logo">
                    </div>
                    {{-- <div class="img_logo" style="background: url('{{ $basePathUtilidades . $fileName_logo }}') #ffffff00  50% / contain no-repeat;"></div> --}}
                </div>

                <div class="col-3 text-center  p-2 my-auto" style="margin-top: 0px">
                    <img class=" " src="{{ $basePath . 'stps.webp'}}" style="width: 100px">
                </div>

                <div class="col-3 text-center  p-2 my-auto" style="margin-top: 0px">
                    <h6 class="azul_claro tipo uppercase  p-0" style="margin-top: 30px">
                        TIPO
                    </h6>

                    <h6 class="azul_claro cea uppercase m-0 p-0">
                        CFC
                    </h6>
                </div>

            </div>

            <div class="row">
                <div class="col-4 text-center  p-2">
                    <div class="oval-container">
                        <img class="oval" src="">
                    </div>

                    <h6 class="azul_claro folio uppercase  p-0" style="margin-top: 20px">
                        folio
                    </h6>

                    <h6 class="azul_claro folio_num uppercase m-0 p-0">
                        {{$tickets->folio}}
                    </h6>
                </div>

                <div class="col-8 text-start ">
                    <h6 class="uppercase titulo_cedula m-0 p-0">
                        REGISTRO NACIONAL
                    </h6>
                    <h5 class="uppercase subtitulo_cedula  m-0 p-0">
                        INSTITUTO MEXICANO NATURALES AIN SPA
                    </h5>
                    <p class="texto_principal_cedula" style="">
                        La Coordinación de Asuntos Escolares y Apoyo a Estudiantes del
                         Registro Nacional Instituto Mexicano Naturales Ain Spa RIIMNAS,
                         con registro <strong class="texto_prinipal_strong"> CLAVE</strong> en la Secretaría del Trabajo y Previsión
                         Social STPS como Agente Capacitador Externo, hace constar que el/la
                          Alumno(a) <strong class="texto_prinipal_strong"> {{ $tickets->nombre }}</strong> , con número de folio <strong class="texto_prinipal_strong">CFC000918771</strong> con
                           CURP: <strong class="texto_prinipal_strong">JDAR090213MMCMLTA4</strong> , cursó la especialidad de <strong class="texto_prinipal_strong"> {{ $tickets->nombre }}</strong> ,
                            cubriendo todos los créditos correspondientes.
                        Para efectos de desempeño académico se expresa lo siguiente:
                    </p>
                </div>

            </div>

            <div class="row">
                <div class="col-4 text-start  p-2">
                    <table class="table" style="border: solid 1px #2c6d77;padding:20px 15px 20px 15px;">
                        <tbody class="m-0 p-0">
                            <tr class="m-0 p-0">
                                <td class="text-start col_izquierda uppercase m-0 p-0" >CREDITOS</td>
                                <td class="text-start col_derecha_texto">
                                    Obligatorios: 280 <br>
                                    Optativos: 0 <br>
                                    Totales: 280
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-4 text-start  p-2">
                    <table class="table" style="border: solid 1px #2c6d77;margin-left:20px;padding:26px 15px 26px 15px;">
                        <tbody>
                            <tr>
                                <td class="text-start col_izquierda uppercase" >% DE MATERIAS <br> APROBADAS</td>
                                <td class="text-start col_derecha"  style="padding-left: 15px">
                                    100%
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="col-4 text-start  p-2">
                    <table class="table" style="border: solid 1px #2c6d77;margin-left:10px;padding:26px 15px 26px 15px;">
                        <tbody>
                            <tr>
                                <td class="text-start col_izquierda uppercase" >Promedio general</td>
                                <td class="text-start col_derecha" style="padding-left: 15px">
                                    9.6
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="row">
                <div class="col-12 text-left " style="padding:0px 20px 20px 20px;">

                </div>

            </div>
        </div>
    </div>

    <div class="card-back">
        <div class="container2">
            <div class="row">
                <div class="col-3 text-center  p-2 my-auto" style="margin-top: 0px">
                    <img class=" " src="{{ $basePath . 'registro_nacional.png'}}" style="width: 80px">
                </div>

                <div class="col-3 text-center  p-2 my-auto" style="margin-top: 0px">
                    <div class="img_logo">
                        <img src="{{ $basePathUtilidades . $user->logo }}" alt="Logo">
                    </div>
                    {{-- <div class="img_logo" style="background: url('{{ $basePathUtilidades . $fileName_logo }}') #ffffff00  50% / contain no-repeat;"></div> --}}
                </div>

                <div class="col-3 text-center  p-2 my-auto" style="margin-top: 0px">
                    <img class=" " src="{{ $basePath . 'stps.webp'}}" style="width: 100px">
                </div>

                <div class="col-3 text-center  p-2" style="margin-top: 30px">
                    @php
                        echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$tickets->folio, 'QRCODE',1.8,1.8) . '" style=""   />';
                    @endphp
                </div>

                <div class="row">
                    <div class="col-12   ">
                        <p class="certificado_titulo text-end">
                            CERTIFICADO ANTE EL REGISTRO NACIONAL <br>
                            INSTITUTO MEXICANO NATURALES AIN SPA
                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-center  ">
                        <h1 class="azul_fuerte titulo_name p-0" style="">  ACUERDO LEGAL
                        </h1>
                    </div>

                    <div class="col-4 text-center  ">

                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-start " >
                        <p class="texto_trasero uppercase" style="margin-left:30px;">
                            <strong>ESTATUTOS LEGALES ANTE NOTARIO PÚBLICO, GERARDO GONZÁLEZ-MEZA HOFFMANN:</strong> <br><br>

                            INSTRUMENTO NÚMERO SETENTA Y CINCO MIL SEISCIENTOS SETENTA Y TRES. LIBRO MIL CIENTO CUARENTA Y TRES. CIUDAD DE MÉXICO. A.- LA MODIFICACIÓN AL OBJETO SOCIAL Y LA CONSECUENTE REFORMA AL ARTÍCULO SEGUNDO DE LOS ESTATUTOS SOCIALES; y, B.- LA REFORMA AL ARTÍCULO SEXTO DE LOS ESTATUTOS SOCIALES, que resultan de LA PROTOCOLIZACIÓN del acta de Asamblea General Extraordinaria de Socios de "INSTITUTO MEXICANO NATURALES AIN SPA", SOCIEDAD CIVIL.
                            <br><br>
                            Artículo 5º de la Constitución Política de los Estados Unidos Mexicanos: “A ninguna persona podrá impedirse que se dedique a la profesión, industria, comercio o trabajo que le acomode siendo lícitos... Nadie puede ser privado del producto de su trabajo, sino por resolución judicial.
                            <br><br>
                            Artículo 153 de la Ley General del Trabajo apartado I, III y IV. En general, mejorar el nivel educativo, la competencia laboral y las habilidades de los trabajadores.
                            <br><br>
                            Registrado ante la Secretaría del Trabajo y Previsión Social, el Instituto Mexicano Naturales Ain Spa, como agente capacitador externo con número de registro: clave_Rfc
                            <br><br>
                            XIV.- Que leído y explicado íntegramente por el suscrito notario este instrumento a la compareciente, manifestó su plena comprensión y conformidad con él y lo firmó el día 17 de Junio del 2016, mismo momento en que lo autorizo definitivamente.- Doy fe.
                            <br><br>
                            Por lo antes descrito el Instituto Mexicano Naturales Ain Spa, para efectos legales de acreditación ante terceros, da el siguiente nombramiento conforme a derecho e inscrito en el Registro Nacional Instituto Mexicano Naturales Ain Spa RNIMNAS, al haber aprobado y cumplido con todos los requisitos que exige el plan de estudios especializado en:

                        </p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-start   m-0"  >
                        <h1 class="azul_fuerte titulo_name "  style="margin-left:30px;">
                            {{ $tickets->nombre }}
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-start  m-0 p-0" >
                        <p class="texto_trasero3 uppercase m-0"  style="margin-left:45px!important;">
                            este reconocimiento es <strong>inválido</strong> , si no tiene todas las firmas y sellos que lo que acrediten.
                        </p>
                    </div>
                </div>

                <div class="row">

                    <div class="row">
                        <div class="col-4 text-center  " style="padding: 0 0 0 48px;">
                            <img src="{{ $basePath . 'juanpa.webp'}}" class="img_firmas_delanteras" style="margin-top: 30px">
                            <h3 class="h3_nomre_firmas uppercase m-0 p-0">Juan Pablo Soto</h3>
                            <h5 class="texto_emosires m-0 p-0">Comite Dictaminador <br> RNIMNAS</h5>
                        </div>

                        <div class="col-4 text-center  ">
                            <img src="{{ $basePath . 'carla.webp'}}" class="img_firmas_delanteras">
                            <h3 class="h3_nomre_firmas uppercase m-0 p-0">Lic. Carla Rizo FLORES</h3>
                            <h5 class="texto_emosires m-0 p-0">Directora General <br> IMNAS</h5>
                        </div>

                        <div class="col-4 text-center  ">
                            <img src="{{ $basePath . 'maria.webp'}}" class="img_firmas_delanteras" style="margin-top: 30px">
                            <h3 class="h3_nomre_firmas uppercase m-0 p-0">Lic. Ma. Luisa Flores</h3>
                            <h5 class="texto_emosires m-0 p-0">Emisor de certificados <br> RNIMNAS</h5>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 text-center   m-0"  >
                        <p class="texto_trasero4" style="padding:20px 45px 0px 45px;">
                            CALLE SUR 109-A No. 260, COL. HEROES DE CHURUBUSCO. DEL. IZTAPALAPA. CIUDAD DE MEXICO. CP.09090 <br>
                            (55) 54459315, (55) 56468832, (55) 43367085, (55) 43367086, (55) 55323297, (55) 55329757 <br>
                            www.imnasmexico.com <br>
                            ESTE DOCUMENTO NO ES VÁLIDO SI ES MUTILADO. PRESENTA BORRADURAS, TACHADURAS O ENMENDADURAS.
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
