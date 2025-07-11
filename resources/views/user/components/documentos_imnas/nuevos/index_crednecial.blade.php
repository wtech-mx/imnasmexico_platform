@extends('layouts.app_documenots')

@section('template_title')
    Nuevo Credencial Plastificada RN -
@endsection

@php
$domain = request()->getHost();
$basePath = ($domain == 'plataforma.imnasmexico.com')
    ? asset('documentos_nuevos/credencial/') . '/'
    : asset('documentos_nuevos/credencial/') . '/';

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


        .card-3d-wrapper {
            width: 480px!important;
            height: 304px !important;
        }

        .container2 {
            position: relative;
            width: 480px;
            height: 305px;
            margin: 0 auto; /* Centrar el contenedor */
            overflow: hidden; /* Evitar desbordes */
            background-image: url('{{ $basePath . 'fondo.png'}}');
            background-size: cover; /* Asegura que la imagen cubra toda el área */
            background-position: center center; /* Centra la imagen */
            background-repeat: no-repeat; /* No repetir la imagen */
        }

        .container_trasero {
            position: relative;
            width: 480px;
            height: 305px;
            margin: 0 auto; /* Centrar el contenedor */
            overflow: hidden; /* Evitar desbordes */
            background-image: url('{{ $basePath . 'fondo_trasero.png'}}');
            background-size: cover; /* Asegura que la imagen cubra toda el área */
            background-position: center center; /* Centra la imagen */
            background-repeat: no-repeat; /* No repetir la imagen */
        }


        .text_qr{
            font-size: 7px;
            color:#3d3b3a;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            margin-left: 6px;
            padding: 0px;
            margin:0;
            margin-top: 6px;
        }

        .text_qr2{
            font-size: 7px;
            color:#3d3b3a;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            padding: 0px;
            margin:5px 0 0 0;
            line-height: 6.3px;

        }

        .tipo{
            font-family: 'Montserrat_Medium';
            font-weight: 'regular';
            font-size: 0px;
            font-size: 15px;
            color:#000;
            margin: 0;
            padding: 0;
            line-height: 45px;
            margin-top: 15px;
            margin-bottom: 13px;
         }

        .cea{
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            color:#2c6d77;
            font-size: 37px;
            margin: 0;
            padding: 0;
            line-height: 12px;
        }

        .text_datos{
            font-size: 10px;
            font-family: 'PTSans_Bold';
            font-weight: '600';
            line-height: 20px;
            text-align: end;
            color: #2c6d77;
            text-align: right; /* Alinea el texto a la derecha */
        }

        .text_datos_grande{
            font-size: 13px;
            font-family: 'PTSans_Bold';
            font-weight: '600';
            line-height: 6px;
            text-align: end;
            text-align: center;
            color: #2c6d77;
            margin: 0;
            padding: 0;
        }

        .text_datos_strong{
            font-size: 10px;
            font-family: 'PTSans_Bold';
            font-weight: '600';
            line-height: 6px;
            text-align: end;
            color: #737373;

        }

        .oval {
            width: 100%;
            height: 100%;
            border-radius: 0%;
            background-color: transparent;
            background-size: cover;
            background-position: center center;
            background-image: url('{{ $basePathUDoc. '/' .$user->telefono . '/' .$tickets->foto_cuadrada}}');
        }

        .oval {
            width: 150px;
            height: 170px;
            padding: 0;
            margin:0;
            text-align: center;
            margin-left: 4px;
        }

        .col_azul{
            /* background: url('{{ $basePath . 'franga.webp'}}');
            width:100%; */
        }

        .titulo_principal{
            font-size: 10px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            line-height: 23px;
            color: #fff;
        }

        .titulo_principal_strong{
            font-size: 10px;
            font-family: 'Montserrat_ExtraBold';
            font-weight: 'regular';
            line-height: 6px;
            color: #fff;
        }

        .folio{
            font-size: 7px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            line-height: 0px;
            text-align: center;
            color: #3d3b3a;
            padding: 12px 0 6px 0;
            margin:0;
        }

        .folio_num{
            font-size: 10px;
            font-family: 'Montserrat_ExtraBold';
            font-weight: 'regular';
            line-height: 5px;
            text-align: center;
            color: #2c6d77;
            padding:3px 0 6px 0;
            margin:0;
          }

        .img_grid_categorie{
            width: 80px;
            height: 92px;
            background: url('{{ $basePath . 'foto.jpeg'}}') #ffffff00  50% / cover no-repeat;
            text-align: center;
            margin-left:4px;
        }

        .titulo_trasero{
            font-size: 13px;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            line-height: 6px;
            text-align: center;
            color: #5bb4c2;
        }

        .h3_nomre_firmas{
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            font-size: 7px;
            color:#3d3b3a;
            margin:0;
        }

        .texto_emosires{
            font-family: 'Montserrat_LightItalic';
            font-weight: 'regular';
            font-size: 6px;
            color:#3d3b3a;
            line-height: 7px;
            margin:0;
        }

        .texto_trasero_1{
            font-size:7px;
            font-family: 'Montserrat_Medium';
            font-weight: 'regular';
            line-height: 7px;
            color: #3d3b3a;
            letter-spacing: 0.2px;
        }

        .texto_trasero{
            font-size:7px;
            font-family: 'Montserrat_Medium';
            font-weight: 'regular';
            color: #3d3b3a;
            line-height: 7px;
            letter-spacing: 0.2px;

        }


        .especialidad_trasera{
            font-size: 10px;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            line-height: 6px;
            text-align: center;
            color: #2c6d77;
        }

        .text_footer{
            font-size:4.5px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            line-height: 4px;
            color: #3d3b3a;
        }

        .strong_texto_trasero{
            font-size:6px;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            line-height: 7px;
            color: #3d3b3a;

        }

        .strong_texto_trasero_azul{
            font-size:6px;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            line-height: 7px;
            color: #2c6d77;

        }

        /* .img_logo{
            width: 44px;
            height: 44px;
            margin-top: 8px;
        } */

        .img_logo {
            width: 50px;  /* Tamaño máximo permitido */
            height: 50px;
            /* margin-left: auto;
            margin-right: auto; */
            margin-top: 12px;

        }

        .img_logo img {
            max-width: 100%;  /* Evita que la imagen se estire */
            max-height: 100%;
            object-fit: contain; /* Mantiene la proporción sin cortar */
        }

        .oval-container2 {
            width: 26px;
            height: 31px;
            position: absolute;
            overflow: hidden;
            top: 5%;
            left: 0%;
            background: #fff;
        }

        .oval2 img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.3;
        }



    </style>
@endsection

@section('content_documentos')

    <div class="card-front">
        <div class="container2 p-2" style="">

            <div class="row">
                <div class="col-8 text-start  " style="">
                    <p class="titulo_principal" style="margin-top: 22px">
                        <strong class="titulo_principal_strong">REGISTRO NACIONAL</strong> <br>
                        INSTITUTO MEXICANO NATURALES AIN SPA
                    </p>
                </div>
                <div class="col-2 text-center ">
                    {{-- <div class="img_logo" style="background: url('{{ $basePathUtilidades . $fileName_logo }}') #ffffff00  50% / contain no-repeat;"></div> --}}
                    <div class="img_logo">
                        <img src="{{ $basePathUtilidades . $user->logo }}" alt="Logo">
                    </div>
                </div>
                <div class="col-2 text-center ">
                    <img class="" src="{{ $basePath . 'registro_nacional.png'}}" style="width: 58px;margin-top: 16px;margin-left:10px;">

                </div>
            </div>

            <div class="row">
                <div class="col-3 text-center  ">

                    @php
                        echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$tickets->folio, 'QRCODE',2.0,2.0) . '" style="background: transparent; margin-top: 10px;"   />';
                    @endphp

                    <p class="text_qr uppercase">Escanea PARA Verifica la <br> autenticidad de este <br> documento </p>

                    <h6 class="azul_claro tipo uppercase m-0 p-0">
                        TIPO
                    </h6>

                    <h6 class="azul_claro cea uppercase m-0 p-0">
                        CFC
                    </h6>
                </div>

                <div class="col-5   " style="position: relative">

                    <div class="oval-container2">
                        <div class="oval2">
                            <img src="{{ $basePathUDoc. '/' .$user->telefono . '/' .$tickets->foto_cuadrada }}" alt="Imagen Ovalada">
                        </div>
                    </div>

                    <p class="text_datos uppercase" style="">
                        <strong class="text_datos_strong">Nombre</strong> <br>
                        {{ $tickets->nombre }}

                        <br><br><strong class="text_datos_strong"> {{ $tickets->idocurp ?? 'CURP' }}</strong> <br>
                        {{ $tickets->curp_escrito }}

                        <br><br><strong class="text_datos_strong">nacionalidad</strong> <br>
                        mexicana

                        <br><br><strong class="text_datos_strong">especialidad</strong> <br>
                        {{ $tickets->nom_curso }}

                        <br><br><strong class="text_datos_strong">vigencia:</strong> <br>
                    </p>
                    <p class="text_datos_grande uppercase" style="">
                        permanente
                    </p>
                </div>

                <div class="col-4 text-start  " style="padding-left: 0px;padding-right: 15px;">
                    <h6 class="azul_claro folio uppercase ">
                        Folio
                    </h6>

                    <h6 class="azul_claro folio_num uppercase ">
                        {{ $tickets->folio }}
                    </h6>

                    {{-- <div class="img_grid_categorie" style=""></div> --}}

                    <div class="oval-container">
                        <img class="oval" src="">
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="card-back">

        <div class="container_trasero">

            <div class="row">
                <div class="col-12 ">
                    <p class="titulo_trasero uppercase mt-3">CÉDULA DE IDENTIDAD permanente</p>
                </div>
            </div>

            <div class="row">
                <div class="col-4 text-center  " style="padding: 0 10px 0 10px">
                    @php
                        echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$tickets->folio, 'QRCODE',2.5,2.5) . '" style="background: transparent; margin-top: 10px;"   />';
                    @endphp
                    <p class="text_qr2 uppercase">Escanea PARA Verifica la <br> autenticidad de este <br> documento </p>
                    <img src="{{ $basePath . 'carla.webp'}}" style=" width:50px;">
                    <h3 class="h3_nomre_firmas uppercase ">Lic. Carla Rizo FLORES</h3>
                    <h5 class="texto_emosires ">Directora General <br> IMNAS</h5>
                </div>

                <div class="col-8 " style="padding: 0;margin:0;width:68.5%;">
                    <p class="texto_trasero_1 uppercase " style="margin-right: 15px;text-align: right;">
                        <strong class="strong_texto_trasero">ESTATUTOS LEGALES ANTE NOTARIO PÚBLICO, GERARDO GONZÁLEZ-MEZA HOFFMANN:</strong> <br><br>
                        INSTRUMENTO NÚMERO SETENTA Y CINCO MIL SEISCIENTOS SETENTA Y TRES. LIBRO MIL CIENTO CUARENTA Y TRES. CIUDAD DE MÉXICO. A.- LA MODIFICACIÓN AL OBJETO SOCIAL Y LA CONSECUENTE REFORMA AL ARTÍCULO SEGUNDO DE LOS ESTATUTOS SOCIALES; y, B.- LA REFORMA AL ARTÍCULO SEXTO DE LOS ESTATUTOS SOCIALES, que resultan de LA PROTOCOLIZACIÓN del acta de Asamblea General Extraordinaria de Socios de "INSTITUTO MEXICANO NATURALES AIN SPA", SOCIEDAD CIVIL.
                    </p>
                    <p class="texto_trasero " style="margin-right: 15px;text-align: right;margin-top:0;">
                        <br>
                        Artículo 5º de la Constitución Política de los Estados Unidos Mexicanos: “A ninguna persona podrá impedirse que se dedique a la profesión, industria, comercio o trabajo que le acomode siendo lícitos... Nadie puede ser privado del producto de su trabajo, sino por resolución judicial.
                        <br><br>
                        Registrado ante la Secretaría del Trabajo y Previsión Social, el Instituto Mexicano Naturales Ain Spa, como agente capacitador externo con número de registro
                        <strong class="strong_texto_trasero_azul">{{ $user->clave_clasificacion }}</strong>
                        <br><br>
                        Artículo 153 de la Ley General del Trabajo apartado I, III y IV. En general, mejorar el nivel educativo, la competencia laboral y las habilidades de los trabajadores.
                        Por lo antes descrito el Instituto Mexicano Naturales Ain Spa, para efectos legales de acreditación ante terceros, da el siguiente nombramiento conforme a derecho e inscrito en el Registro Nacional Instituto Mexicano Naturales Ain Spa RNIMNAS, al haber aprobado y cumplido con todos los requisitos que exige el plan de estudios especializado en
                    </p>

                    <h1 class="especialidad_trasera uppercase">{{ $tickets->nom_curso }}</h1>

                    <p class="text_footer text-center uppercase p-0 m-0">
                        este reconocimiento es inválido, si no tiene todas las firmas y sellos que lo que acrediten.
                    </p>
                </div>
            </div>

        </div>


    </div>

@endsection
