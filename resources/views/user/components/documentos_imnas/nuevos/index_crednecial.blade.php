@extends('layouts.app_documenots')

@section('template_title')
    Nueva - Credencial Plastificada RN -
@endsection

@php

$domain = request()->getHost();
$basePath = ($domain == 'plataforma.imnasmexico.com')
    ? asset('documentos_nuevos/credencial/') . '/'
    : asset('documentos_nuevos/credencial/') . '/';

$basePathUtilidades = ($domain == 'plataforma.imnasmexico.com')
    ? asset('utilidades_documentos/') . '/'
    : asset('utilidades_documentos/') . '/';

            if (isset($tickets->foto_cuadrada)) {
                $palabras = explode(' ', ucwords(strtolower($tickets->nom_curso)));
                $nombreCompleto = explode(' ', $tickets->nombre);

                $foto = $tickets->foto_cuadrada;
                $firma = $tickets->firma;

                $basePathDocumentos = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/documentos_registro/'
                    : asset('documentos_registro/');
            }else{


                if ($tickets == null) {

                    $palabras = explode(' ', ucwords(strtolower($tickets_externo->cliente)));
                    $firma = null;
                    $nombreCurso = $tickets_externo->curso;
                    $nombreCompleto = explode(' ', $tickets_externo->cliente);
                    $foto = $tickets_externo->foto;

                }else {

                    $foto = $tickets->User->Documentos->foto_tam_infantil;
                    $firma = $tickets->User->Documentos->firma;

                    $palabras = explode(' ', ucwords(strtolower($tickets->Cursos->nombre)));

                    $nombreCompleto = explode(' ', $tickets->User->name);


                    $basePathDocumentos = ($domain == 'plataforma.imnasmexico.com')
                    ? 'https://plataforma.imnasmexico.com/documentos/'
                    : asset('documentos/');
                }


            }

            $cantidad_palabras = count($palabras);
            $folio = isset($tickets->folio) ? $tickets->folio : $tickets_externo->folio;

            if ( isset($tickets->curp_escrito)) {
                $curp = $tickets->curp_escrito;
            }else{
                $curp = $tickets->User->curp_escrito ?? '';

            }

            $cursoNombre = isset($tickets->Cursos->nombre)
            ? $tickets->Cursos->nombre
            : (isset($cursoNombre)
                ? $tickets->nom_curso
                : $tickets_externo->curso);
@endphp

@section('css_custom')
<style>

    .border {
        border: 0px solid #000;
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
        color:#3d3b3a;
        font-family: 'Montserrat_Regular';
        font-weight: 'regular';
        margin-left: 6px;
        padding: 0px;
        margin:0;
        margin-top: 6px;
    }

    .text_qr2{
        font-size: 5px;
        color:#3d3b3a;
        font-family: 'Montserrat_Regular';
        font-weight: 'regular';
        padding: 0px;
        margin:5px 0 0 0;
        line-height: 4.3px;

    }

    .tipo{
        font-family: 'Montserrat_Medium';
        font-weight: 'regular';
        font-size: 0px;
        font-size: 6px;
        color:#000;
        margin: 0;
        padding: 0;
        line-height: 0;
        margin-top: 15px;
        margin-bottom: 13px;
     }

    .cea{
        font-family: 'Montserrat_Bold';
        font-weight: 'regular';
        color:#2c6d77;
        font-size: 25px;
        margin: 0;
        padding: 0;
        line-height: 10px;
    }

    .text_datos{
        font-size: 8px;
        font-family: 'PTSans_Bold';
        font-weight: '600';
        line-height: 6px;
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
        font-size: 8px;
        font-family: 'PTSans_Bold';
        font-weight: '600';
        line-height: 6px;
        text-align: end;
        color: #737373;

    }

    .oval-container {

    }

    .oval {
        width: 80px;
        height: 92px;
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
        font-size: 8px;
        font-family: 'Montserrat_Regular';
        font-weight: 'regular';
        line-height: 7px;
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
        font-size: 5px;
        font-family: 'Montserrat_Regular';
        font-weight: 'regular';
        line-height: 0px;
        text-align: center;
        color: #3d3b3a;
        padding: 12px 0 6px 0;
        margin:0;
    }

    .folio_num{
        font-size: 8px;
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
        font-size: 5px;
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
        font-size:4px;
        font-family: 'Montserrat_Medium';
        font-weight: 'regular';
        line-height: 4px;
        color: #3d3b3a;
        letter-spacing: 0.2px;
    }

    .texto_trasero{
        font-size:4px;
        font-family: 'Montserrat_Medium';
        font-weight: 'regular';
        color: #3d3b3a;
        line-height: 3.5px;
        letter-spacing: 0.2px;

    }


    .especialidad_trasera{
        font-size: 8px;
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
        font-size:4px;
        font-family: 'Montserrat_Bold';
        font-weight: 'regular';
        line-height: 7px;
        color: #3d3b3a;

    }

    .strong_texto_trasero_azul{
        font-size:4px;
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
        width: 38px;  /* Tamaño máximo permitido */
        height: 38px;
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

        <div class="container2" style="">

            <div class="row">
                <div class="col-8 text-start border " style="padding: 0 0 0 6px">
                    <p class="titulo_principal" style="margin-top: 22px">
                        <strong class="titulo_principal_strong">REGISTRO NACIONAL</strong> <br>
                        INSTITUTO MEXICANO NATURALES AIN SPA
                    </p>
                </div>
                <div class="col-2 text-center border">
                    {{-- <div class="img_logo" style="background: url('{{ $basePathUtilidades . $fileName_logo }}') #ffffff00  50% / contain no-repeat;"></div> --}}
                    <div class="img_logo">
                        <img src="" alt="Logo">
                    </div>
                </div>
                <div class="col-2 text-center border">
                    <img class="" src="{{ $basePath . 'registro_nacional.png'}}" style="width: 40px;margin-top: 16px;margin-left:20px;">

                </div>
            </div>

            <div class="row">
                <div class="col-3 text-center border ">
                    @php
                        echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$folio, 'QRCODE',1.6,1.6) . '" style="margin-top:10px;"   />';
                    @endphp
                    <p class="text_qr uppercase">Escanea PARA Verifica la <br> autenticidad de este <br> documento </p>

                    <h6 class="azul_claro tipo uppercase m-0 p-0">
                        TIPO
                    </h6>

                    <h6 class="azul_claro cea uppercase m-0 p-0">
                        CFC
                    </h6>
                </div>

                <div class="col-5  border " style="position: relative">

                    <div class="oval-container2">
                        <div class="oval2">
                            <img src="" alt="Imagen Ovalada">
                        </div>
                    </div>

                    <p class="text_datos uppercase" style="">
                        <strong class="text_datos_strong">Nombre</strong> <br>


                        <br><br><strong class="text_datos_strong">curp</strong> <br>
                        {{ $curp }}

                        <br><br><strong class="text_datos_strong">nacionalidad</strong> <br>
                        mexicana

                        <br><br><strong class="text_datos_strong">especialidad</strong> <br>

                        <br><br><strong class="text_datos_strong">vigencia:</strong> <br>
                    </p>
                    <p class="text_datos_grande uppercase" style="">
                        permanente
                    </p>
                </div>

                <div class="col-4 text-start border " style="padding-left: 0px;padding-right: 15px;">
                    <h6 class="azul_claro folio uppercase ">
                        Folio
                    </h6>

                    <h6 class="azul_claro folio_num uppercase ">
                        {{ $folio }}
                    </h6>

                    {{-- <div class="img_grid_categorie" style=""></div> --}}

                    <div class="oval-container">
                        <img class="oval" src="" alt="Imagen">
                    </div>

                </div>
            </div>

        </div>

    </div>

    <div class="card-back">


        <div class="container_trasero">

            <div class="row">
                <div class="col-12 border">
                    <p class="titulo_trasero uppercase">CÉDULA DE IDENTIDAD permanente</p>
                </div>
            </div>

            <div class="row">
                <div class="col-4 text-center border " style="padding: 0 10px 0 10px">
                    @php
                        echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$folio, 'QRCODE',2,2) . '" style=""   />';
                    @endphp
                    <p class="text_qr2 uppercase">Escanea PARA Verifica la <br> autenticidad de este <br> documento </p>
                    <img src="{{ $basePath . 'carla.webp'}}" style=" width:50px;">
                    <h3 class="h3_nomre_firmas uppercase ">Lic. Carla Rizo FLORES</h3>
                    <h5 class="texto_emosires ">Directora General <br> IMNAS</h5>
                </div>

                <div class="col-8 border" style="padding: 0;margin:0;width:68.5%;">
                    <p class="texto_trasero_1 uppercase " style="margin-right: 15px;text-align: right;">
                        <strong class="strong_texto_trasero">ESTATUTOS LEGALES ANTE NOTARIO PÚBLICO, GERARDO GONZÁLEZ-MEZA HOFFMANN:</strong> <br><br>
                        INSTRUMENTO NÚMERO SETENTA Y CINCO MIL SEISCIENTOS SETENTA Y TRES. LIBRO MIL CIENTO CUARENTA Y TRES. CIUDAD DE MÉXICO. A.- LA MODIFICACIÓN AL OBJETO SOCIAL Y LA CONSECUENTE REFORMA AL ARTÍCULO SEGUNDO DE LOS ESTATUTOS SOCIALES; y, B.- LA REFORMA AL ARTÍCULO SEXTO DE LOS ESTATUTOS SOCIALES, que resultan de LA PROTOCOLIZACIÓN del acta de Asamblea General Extraordinaria de Socios de "INSTITUTO MEXICANO NATURALES AIN SPA", SOCIEDAD CIVIL.
                    </p>
                    <p class="texto_trasero " style="margin-right: 15px;text-align: right;margin-top:0;">
                        <br>
                        Artículo 5º de la Constitución Política de los Estados Unidos Mexicanos: “A ninguna persona podrá impedirse que se dedique a la profesión, industria, comercio o trabajo que le acomode siendo lícitos... Nadie puede ser privado del producto de su trabajo, sino por resolución judicial.
                        <br><br>
                        Registrado ante la Secretaría del Trabajo y Previsión Social, el Instituto Mexicano Naturales Ain Spa, como agente capacitador externo con número de registro:
                        <strong class="strong_texto_trasero_azul"></strong>
                        <br><br>
                        Artículo 153 de la Ley General del Trabajo apartado I, III y IV. En general, mejorar el nivel educativo, la competencia laboral y las habilidades de los trabajadores.
                        Por lo antes descrito el Instituto Mexicano Naturales Ain Spa, para efectos legales de acreditación ante terceros, da el siguiente nombramiento conforme a derecho e inscrito en el Registro Nacional Instituto Mexicano Naturales Ain Spa RNIMNAS, al haber aprobado y cumplido con todos los requisitos que exige el plan de estudios especializado en
                    </p>

                    <h1 class="especialidad_trasera uppercase"></h1>

                    <p class="text_footer text-center uppercase p-0 m-0">
                        este reconocimiento es inválido, si no tiene todas las firmas y sellos que lo que acrediten.
                    </p>
                </div>
            </div>

        </div>

    </div>

@endsection
