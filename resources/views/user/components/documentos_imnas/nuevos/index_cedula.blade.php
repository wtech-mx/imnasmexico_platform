@extends('layouts.app_documenots')

@section('template_title')
    Cedula RN - {{ $tickets->nombre }}
@endsection

@php
$domain = request()->getHost();
$basePath = ($domain == 'plataforma.imnasmexico.com')
    ? asset('documentos_nuevos/cedula/') . '/'
    : asset('documentos_nuevos/cedula/') . '/';

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

    .container2 {
        position: relative;
        width: 480px; /* Ancho máximo basado en el tamaño del PDF */
        height: 668px; /* Altura basada en el tamaño del PDF */
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
    .col-3 { width: 18.70%; } /* 25% - 4.64% */
    .col-4 { width: 27.10%; } /* 33.33% - 4.64% */
    .col-5 { width: 37.02%; } /* 41.66% - 4.64% */
    .col-6 { width: 45.36%; } /* 50% - 4.64% */
    .col-7 { width: 53.69%; } /* 58.33% - 4.64% */
    .col-8 { width: 62.02%; } /* 66.66% - 4.64% */
    .col-9 { width: 70.36%; } /* 75% - 4.64% */
    .col-10 { width: 78.69%; } /* 83.33% - 4.64% */
    .col-11 { width: 87.02%; } /* 91.66% - 4.64% */
    .col-12 { width: 95.36%; } /* 100% - 4.64% */


    .border {
        border: 0px solid #000;
    }


    .img_registro_header{
        width: 100px;
    }

    .img_logoAfi_header{
        width: 80px;
    }

    .img_stps_registro_header{
        width: 110px;
    }

    .img_firmas_delanteras{
        width: 90px;
    }

    .h3_nomre_firmas{
        font-family: 'Montserrat_SemiBold';
        font-weight: 'regular';
        font-size: 10px;
        line-height: 9px;
    }

    .texto_emosires{
        font-family: 'Montserrat_LightItalic';
        font-weight: 'regular';
        font-size: 11px;
        margin-top: 4px!important;
        line-height: 10px;
    }

    .texto_documentos{
        font-size: 11px;
        font-family: 'Montserrat_LightItalic';
        font-weight: 'regular';
        color: #545454;
        line-height: 13px;
    }

    .titulo_cedula{
        font-size: 25px;
        font-family: 'Montserrat_Bold';
        font-weight: 'regular';
        line-height: 18px;
    }

    .titulo_especialidad{
        font-size: 25px;
        font-family: 'Montserrat_Bold';
        font-weight: 'regular';
        line-height: 23px;
        color:#2c6d77;
    }

    .especialidad{
        font-size: 12px;
        font-family: 'Montserrat_Regular';
        font-weight: 'regular';
        margin-top: 5px;
        margin-bottom: 5px;
    }

    .especialidad_trasera{
        font-size: 19px;
        font-family: 'Montserrat_Bold';
        font-weight: 'regular';
        line-height: 16px;
    }

    .texto_trasero{
        font-size: 7px;
        font-family: 'Montserrat_Regular';
        font-weight: 'regular';
        margin-top: 5px;
        margin-bottom: 5px;
        line-height: 12.5px;
        color: #3d3b3a;
    }

    .texto_trasero_strong{
        font-size: 11.5px;
        font-family: 'Montserrat_Bold';
        font-weight: 'regular';
        margin-top: 5px;
        margin-bottom: 5px;
        line-height: 15px;
        color: #3d3b3a;
    }

    .texto_principal_cedula{
        font-size: 13px;
        font-family: 'Montserrat_Regular';
        font-weight: 'regular';
        line-height: 15px;
    }

    .folio{
        font-size: 13px;
        font-family: 'Montserrat_SemiBold';
        font-weight: 'regular';
        margin-top: 5px;
        margin-bottom: 5px;
    }

    .folio_result{
        font-size: 12px;
        font-family: 'Montserrat_Bold';
        font-weight: 'regular';
    }

    .letra_sola{
        font-size: 11px;
        font-family: 'Montserrat_Regular';
        font-weight: 'regular';
    }

    .texto_footer{
        font-size: 9px;
        font-family: 'Montserrat_Regular';
        font-weight: 'regular';
    }

    .texto_footer2{
        font-size: 9px;
        font-family: 'Montserrat_Regular';
        font-weight: 'regular';
    }

    .vigencia{
        font-size: 13px;
        font-family: 'Montserrat_Bold';
        font-weight: 'regular';
    }

    .permanente{
        font-size: 23px;
        font-family: 'Montserrat_ExtraBold';
        font-weight: 'regular';
        line-height: 16px;
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
        margin-left: 20px;
        width: 130px;
        height: 180px;
        overflow: hidden;
        background: transparent;
        /* Ajuste condicional de top */
    }

    /* .img_logo{
        width: 90px;
        height: 90px;
        height: 120px;
        margin-left: auto;
        margin-right: auto;
    } */

    .img_logo {
        width: 90px;  /* Tamaño máximo permitido */
        height: 90px;
        margin-left: auto;
        margin-right: auto;
    }

    .img_logo img {
        max-width: 100%;  /* Evita que la imagen se estire */
        max-height: 100%;
        object-fit: contain; /* Mantiene la proporción sin cortar */
    }

    .img_logo_2{
        width: 60px;  /* Tamaño máximo permitido */
        height: 60px;
        margin-left: auto;
        margin-right: auto;
    }

    .img_logo_2 img{
        max-width: 100%;  /* Evita que la imagen se estire */
        max-height: 100%;
        object-fit: contain; /* Mantiene la proporción sin cortar */
    }

    /* .img_logo_2{
        width: 70px;
        height: 70px;
        height: 120px;
        position: relative;
        margin-left: auto;
        margin-right: auto;
    } */

</style>

@endsection

@section('content_documentos')

<div class="card-front">
    <div class="container2">

        <div class="row">
            <div class="col-4 text-center  " style="margin-top: 15px">
                <img class=""  style="width: 90px" src="{{ $basePath . 'registro_nacional.png'}}">
            </div>

            <div class="col-4 text-center  " style="margin-top: 15px">
                {{-- <div class="img_logo" style="background: url('{{ $basePathUtilidades . $fileName_logo }}') #ffffff00  50% / contain no-repeat;"></div> --}}

                <div class="img_logo">
                    <img src="{{ $basePathUtilidades . $user->logo }}" alt="Logo">
                </div>

            </div>

            <div class="col-4 text-center  " style="margin-top: 15px">
                <img class=""  style="width: 110px" src="{{ $basePath . 'stps.webp'}}">
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-center  ">


                <p class="texto_principal_cedula uppercase" style="margin:10px 0 10px 0;">
                    REGISTRO NACIONAL INSTITUTO MEXICANO NATURALES <br>
                    AIN SPA, LA SECRETARIA DEL TRABAJO Y PREVISION <br>
                    OTORGAN LA PRESENTE
                </p>

            </div>
        </div>

        <div class="row">
            <div class="col-12 text-center ">
                <h6 class="azul_fuerte titulo_cedula m-2 p-2">
                    CÉDULA DE IDENTIDAD
                </h6>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-center ">
                <p class="letra_sola m-2 p-2">
                A
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-4 text-center  ">
                <div class="oval-container">
                    <img class="oval" src="" alt="">
                </div>
            </div>

            <div class="col-8 text-center  ">
                <h1 class="azul_fuerte titulo_cedula p-0 m-0">
                    {{ $tickets->nombre }}
                </h1>

                <p class="especialidad uppercase p-0 m-0">en la especialidad de</p>

                <h2 class="azul_fuerte titulo_especialidad mt-2 mb-2">
                    {{ $tickets->nom_curso }}
                </h2>

                <p class="texto_documentos p-0 m-0" style="margin-top: 5px;margin-bottom: 0px">
                    En virtud de haber concluido satisfactoriamente
                    con los créditos honoríficos requeridos
                    con respecto al plan vigente. con fundamento en los
                    estatutos institucionales del Instituto Mexicano
                    naturales ain spa.
                </p>

            </div>
        </div>

        <div class="row">
            <div class="col-4 text-center  ">
                <img src="{{ $basePath . 'sello-registro-marca-de-agua.webp'}}" style="width: 105px; margin-left: 25px;">
            </div>

            <div class="col-4 text-center  ">
                <p class="folio my-auto" style="margin-top: 2s0px">
                    Folio<br>
                    <strong class="folio_result azul_fuerte">
                        {{ $tickets->folio }}
                    </strong>
                </p>
            </div>

            <div class="col-4 text-center">
                @php
                    echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$tickets->folio, 'QRCODE',2.0,2.0) . '" style="background: transparent; padding: px;"   />';
                @endphp
            </div>
        </div>

        <div class="row">
            <div class="col-4 text-center  ">
                <img src="{{ $basePath . 'juanpa.webp'}}" class="img_firmas_delanteras">
                <h3 class="h3_nomre_firmas uppercase m-2 p-2">Juan Pablo Soto</h3>
                <h5 class="texto_emosires m-1 p-1">Comite Dictaminador <br> RNIMNAS</h5>
            </div>

            <div class="col-4 text-center  ">
                <img src="{{ $basePath . 'carla.webp'}}" class="img_firmas_delanteras">
                <h3 class="h3_nomre_firmas uppercase m-2 p-2">Lic. Carla Rizo FLORES</h3>
                <h5 class="texto_emosires m-1 p-1">Directora General <br> IMNAS</h5>
            </div>

            <div class="col-4 text-center  ">
                <img src="{{ $basePath . 'maria.webp'}}" class="img_firmas_delanteras">
                <h3 class="h3_nomre_firmas uppercase m-2 p-2">Lic. Ma. Luisa Flores</h3>
                <h5 class="texto_emosires m-1 p-1">Emisor de certificados <br> RNIMNAS</h5>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-center  " style="margin-top: 10px">
                <p class="azul_fuerte texto_footer m-2 p-2">
                    Expedido en la Ciudad de México, el  {{ \Carbon\Carbon::parse($tickets->fecha_curso)->translatedFormat('d \d\e F \d\e\l Y') }}
                </p>
                <P class="texto_footer2 m-2 p-2">
                    La autenticidad del presente documento puede ser verificada escaneando el QR.
                </P>
            </div>
        </div>

    </div>

</div>

<div class="card-back">
    <div class="container2">

        <div class="row" >
            <div class="col-3   text-center"  style="margin-top: 15px;">
                <img class=" " src="{{ $basePath . 'registro_nacional.png'}}" style="margin-left:30px;width: 90px">
            </div>

            <div class="col-3   text-center" style="margin-top: 15px">
                <img class="" src="{{ $basePath . 'mundo.webp'}}" style="width: 80px">
            </div>

            <div class="col-3   text-center" style="margin-top: 20px">
                {{-- <div class="img_logo_2" style="background: url('{{ $basePathUtilidades . $fileName_logo }}') #ffffff00  50% / contain no-repeat;"></div> --}}

                <div class="img_logo_2">
                    <img src="{{ $basePathUtilidades . $user->logo }}" alt="Logo">
                </div>
            </div>

            <div class="col-3   text-center" style="">
                <img class="" src="{{ $basePath . 'stps.webp'}}" style="margin-right: 40px;width: 110px;margin-top:8px;">
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-center ">
                <h6 class="azul_claro titulo_cedula m-2 p-2" style="margin-bottom: 10px">
                    ACUERDO LEGAL
                </h6>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-start ">
                <p class="texto_trasero uppercase" style="margin-right: 20px;margin-left: 20px;">
                    <strong class="texto_trasero_strong">ESTATUTOS LEGALES ANTE NOTARIO PÚBLICO, GERARDO GONZÁLEZ-MEZA HOFFMANN:</strong> <br><br>

                    INSTRUMENTO NÚMERO SETENTA Y CINCO MIL SEISCIENTOS SETENTA Y TRES. LIBRO MIL CIENTO CUARENTA Y TRES. CIUDAD DE MÉXICO. A.- LA MODIFICACIÓN AL OBJETO SOCIAL Y LA CONSECUENTE REFORMA AL ARTÍCULO SEGUNDO DE LOS ESTATUTOS SOCIALES; y, B.- LA REFORMA AL ARTÍCULO SEXTO DE LOS ESTATUTOS SOCIALES, que resultan de LA PROTOCOLIZACIÓN del acta de Asamblea General Extraordinaria de Socios de "INSTITUTO MEXICANO NATURALES AIN SPA", SOCIEDAD CIVIL.
                    <br><br>
                    Artículo 5º de la Constitución Política de los Estados Unidos Mexicanos: “A ninguna persona podrá impedirse que se dedique a la profesión, industria, comercio o trabajo que le acomode siendo lícitos... Nadie puede ser privado del producto de su trabajo, sino por resolución judicial.
                    <br><br>
                    Artículo 153 de la Ley General del Trabajo apartado I, III y IV. En general, mejorar el nivel educativo, la competencia laboral y las habilidades de los trabajadores.
                    <br><br>
                    Registrado ante la Secretaría del Trabajo y Previsión Social, el Instituto Mexicano Naturales Ain Spa, como agente capacitador externo con número de registro:
                    <br><br>
                    XIV.- Que leído y explicado íntegramente por el suscrito notario este instrumento a la compareciente, manifestó su plena comprensión y conformidad con él y lo firmó el día 17 de Junio del 2016 , mismo momento en que lo autorizo definitivamente.- Doy fe.
                    <br><br>
                    Por lo antes descrito el Instituto Mexicano Naturales Ain Spa, para efectos legales de acreditación ante terceros, da el siguiente nombramiento conforme a derecho e inscrito en el Registro Nacional Instituto Mexicano Naturales Ain Spa RNIMNAS, al haber aprobado y cumplido con todos los requisitos que exige el plan de estudios especializado en:

                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-start ">
                <p class="especialidad_trasera azul_fuerte uppercase"  style="margin-bottom: 0;margin-right: 20px;margin-left: 20px;margin-top:0;">

                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-12 text-start ">
                <p class="texto_trasero uppercase"  style="margin-right: 20px;margin-left: 20px;">
                    este reconocimiento es inválido, si no tiene todas las firmas y sellos que lo que acrediten.
                </p>
            </div>
        </div>

        <div class="row">
            <div class="col-6   text-center" style="margin-top: 10px">
                <h6 class="azul_claro permanente uppercase m-2 p-2">
                    <strong class="vigencia m-2 p-2" style="color: #000;">Vigencia</strong> <br>
                    permanente
                </h6>
            </div>
            <div class="col-3   text-center" style="margin-top: 10px">
                @php
                    echo ' <img src="data:image/png;base64,' . DNS2D::getBarcodePNG('https://plataforma.imnasmexico.com/buscador/folio?folio='.$tickets->folio, 'QRCODE',2.0,2.0) . '" style="background: transparent; padding: px;"   />';
                @endphp
            </div>
            <div class="col-3   text-center" style="margin-top: 10px">
                <h6 class="azul_claro permanente uppercase m-2 p-2">
                    <strong class="vigencia m-2 p-2" style="color: #000;">TIPO</strong> <br>
                    CEA
                </h6>
            </div>

        </div>

        <div class="row">
            <div class="col-12 text-center m-2 p-2">
                <P class="texto_footer2 ">La autenticidad del presente documento puede ser verificada escaneando el QR.</p>
                </div>
        </div>
    </div>

</div>

@endsection



