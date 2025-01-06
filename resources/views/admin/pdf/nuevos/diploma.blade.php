<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini-Grid PDF</title>
    @php
        $domain = request()->getHost();
        $basePath = ($domain == 'plataforma.imnasmexico.com')
                ? 'https://plataforma.imnasmexico.com/documentos_nuevos/diploma/'
                : 'documentos_nuevos/diploma/';
    @endphp
    <style>

        @font-face {
            font-family: 'Montserrat_Bold';
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path('fonts/Montserrat-Bold.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Montserrat_ExtraBold';
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path('fonts/Montserrat-ExtraBold.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Montserrat_Medium';
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path('fonts/Montserrat-Medium.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Montserrat_Regular';
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path('fonts/Montserrat-Regular.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Montserrat_SemiBold';
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path('fonts/Montserrat-SemiBold.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'OpenSans_Regular';
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path('fonts/OpenSans-Regular.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'OpenSauceOne_Bold';
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path('fonts/OpenSauceOne-Bold.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'OpenSauceOne_Regular';
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path('fonts/OpenSauceOne-Regular.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'OPTIEngraversOldEnglish';
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path('fonts/OPTIEngraversOldEnglish.ttf') }}') format('truetype');
        }


        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

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
            width: 100px;
        }

        .img_logoAfi_header{
            width: 80px;
        }

        .img_stps_registro_header{
            width: 110px;
        }

        .img_firmas_delanteras{
            width: 100px;
        }

        .h3_nomre_firmas{
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
            font-size: 10px;
            line-height: 9px;
        }

        .texto_emosires{
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            font-size: 10px;
            margin-top: 10px!important;
            line-height: 9px;
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
            font-size: 10px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            font-style: italic;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .titulo_cedula{
            font-size: 23px;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
        }

        .titulo_especialidad{
            font-size: 25px;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
            line-height: 20px;

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
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .especialidad_trasera{
            font-size: 17px;
            font-family: 'Montserrat_Bold';
            font-weight: 'regular';
        }

        .texto_trasero{
            font-size: 9.5px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            margin-top: 5px;
            margin-bottom: 5px;
            line-height: 7px;
            text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.3);
        }

        .texto_principal_cedula{
            font-size: 11px;
            font-family: 'Montserrat_Regular';
            font-weight: 'regular';
            line-height: 10px;
        }

        .folio{
            font-size: 13px;
            font-family: 'Montserrat_SemiBold';
            font-weight: 'regular';
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .folio_result{
            font-size: 15px;
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
            background-image: url('{{ $basePath . 'foto.jpeg'}}');
        }

        .oval-container {
            margin-left: 20px;
            width: 128px;
            height: 176px;
            overflow: hidden;
            background: transparent;
            /* Ajuste condicional de top */
        }

    </style>
</head>
<body>

    <div class="container">
        <!-- Contenido superpuesto sobre la imagen -->
        <div class="content">
            <div class="row">
                <div class="col-4 text-center border ">
                    <img class="img_registro_header" src="{{ $basePath . 'registro_nacional.png'}}">
                </div>
                <div class="col-4 text-center border ">
                    <img class="img_logoAfi_header" src="{{ $basePath . 'sello-registro-marca-de-agua.webp'}}">
                </div>
                <div class="col-4 text-center border ">
                    <img class="img_stps_registro_header" src="{{ $basePath . 'stps.webp'}}">
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center border">
                    <p class="texto_principal_cedula">
                        REGISTRO NACIONAL INSTITUTO MEXICANO NATURALES <br>
                         AIN SPA, LA SECRETARIA DEL TRABAJO Y PREVISION <br>
                          SOCIAL E INSTITUTO INTEGRAL AM 360 OTORGAN la <br> PRESENTE
                    </p>
                </div>

            </div>

            <div class="row">
                <div class="col-12 text-center border">
                    <h6 class="azul_fuerte titulo_cedula m-0 p-0">
                        CÉDULA DE IDENTIDAD
                    </h6>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center border">
                    <p class="letra_sola m-0 p-0">
                       A
                    </p>
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

                    <h1 class="h1_nombre azul_fuerte titulo_cedula p-0 m-0">JUNA DEL ARCON</h1>

                    <p class="especialidad uppercase p-0 m-0">en la especialidad de</p>

                    <h2 class="azul_fuerte titulo_especialidad p-0 m-0">
                        Cosmiatria y Cosmetologia
                    </h2>

                    <p class="texto_documentos p-0 m-0" style="margin-bottom: 10px">
                        En virtud de haber concluido satisfactoriamente
                        con los créditos honoríficos requeridos
                        con respecto al plan vigente. con fundamento en los
                        estatutos institucionales del Instituto Mexicano
                        naturales ain spa.
                    </p>

                </div>
            </div>

            <div class="row">
                <div class="col-4 text-center border ">
                    <img src="{{ $basePath . 'sello-registro-marca-de-agua.webp'}}" style="width: 110px; margin-left: 25px;">
                </div>

                <div class="col-4 text-center border ">
                    <p class="folio my-auto" style="margin-top: 30px">
                        Folio: <br>
                        <strong class="folio_result azul_fuerte">CFC000918771</strong>
                    </p>
                </div>

                <div class="col-4 text-center border ">
                    <img src="{{ $basePath . 'sello-registro-marca-de-agua.webp'}}" style="width: 110px">
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
                    <p class="azul_fuerte texto_footer m-0 p-0">
                        Expedido en la Ciudad de México, día 10 de noviembre de 2024.
                    </p>
                    <P class="texto_footer2 m-0 p-0">
                        La autenticidad del presente documento puede ser verificada escaneando el QR.
                    </P>
                </div>
            </div>

        </div>
    </div>

    <div class="container">
        <!-- Contenido superpuesto sobre la imagen -->

            <div class="row" >
                <div class="col-3 border  text-center"  style="margin-top: 15px;">
                    <img class="img_registro_header " src="{{ $basePath . 'registro_nacional.png'}}" style="">
                </div>

                <div class="col-3 border  text-center" style="margin-top: 15px">
                    <img class="" src="{{ $basePath . 'mundo.webp'}}" style="width: 80px">
                </div>

                <div class="col-3 border  text-center" style="margin-top: 15px">
                    <img class="" src="{{ $basePath . 'mundo.webp'}}" style="width: 80px">
                </div>

                <div class="col-3 border  text-center" style="margin-top: 15px">
                    <img class="img_stps_registro_header " src="{{ $basePath . 'stps.webp'}}" style="">
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-center border">
                    <h6 class="azul_fuerte titulo_cedula m-0 p-0">
                        ACUERDO LEGAL
                    </h6>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-start border">
                    <p class="texto_trasero uppercase" style="margin-right: 20px;margin-left: 20px;">
                        <strong>ESTATUTOS LEGALES ANTE NOTARIO PÚBLICO, GERARDO GONZÁLEZ-MEZA HOFFMANN:</strong> <br><br>

                        INSTRUMENTO NÚMERO SETENTA Y CINCO MIL SEISCIENTOS SETENTA Y TRES. LIBRO MIL CIENTO CUARENTA Y TRES. CIUDAD DE MÉXICO. A.- LA MODIFICACIÓN AL OBJETO SOCIAL Y LA CONSECUENTE REFORMA AL ARTÍCULO SEGUNDO DE LOS ESTATUTOS SOCIALES; y, B.- LA REFORMA AL ARTÍCULO SEXTO DE LOS ESTATUTOS SOCIALES, que resultan de LA PROTOCOLIZACIÓN del acta de Asamblea General Extraordinaria de Socios de "INSTITUTO MEXICANO NATURALES AIN SPA", SOCIEDAD CIVIL.
                        <br><br>
                        Artículo 5º de la Constitución Política de los Estados Unidos Mexicanos: “A ninguna persona podrá impedirse que se dedique a la profesión, industria, comercio o trabajo que le acomode siendo lícitos... Nadie puede ser privado del producto de su trabajo, sino por resolución judicial.
                        <br><br>
                        Artículo 153 de la Ley General del Trabajo apartado I, III y IV. En general, mejorar el nivel educativo, la competencia laboral y las habilidades de los trabajadores.
                        <br><br>
                        Registrado ante la Secretaría del Trabajo y Previsión Social, el Instituto Mexicano Naturales Ain Spa, como agente capacitador externo con número de registro: RIFC680910-879-0013
                        <br><br>
                        XIV.- Que leído y explicado íntegramente por el suscrito notario este instrumento a la compareciente, manifestó su plena comprensión y conformidad con él y lo firmó el día _________________________________________, mismo momento en que lo autorizo definitivamente.- Doy fe.
                        <br><br>
                        Por lo antes descrito el Instituto Mexicano Naturales Ain Spa, para efectos legales de acreditación ante terceros, da el siguiente nombramiento conforme a derecho e inscrito en el Registro Nacional Instituto Mexicano Naturales Ain Spa RNIMNAS, al haber aprobado y cumplido con todos los requisitos que exige el plan de estudios especializado en:

                    </p>
                </div>
            </div>

            <div class="col-12 text-center border">
                <h2 class="especialidad_trasera azul_fuerte"  style="margin-right: 20px;margin-left: 20px;">Cosmiatria y Cosmetologia </h2>
            </div>

            <div class="row">
                <div class="col-12 text-start border">
                    <p class="especialidad_trasera azul_fuerte uppercase"  style="margin-bottom: 0;margin-right: 20px;margin-left: 20px;margin-top:0;">Cosmiatria y Cosmetologia </p>
                </div>
            </div>

            <div class="row">
                <div class="col-12 text-start border">
                    <p class="texto_trasero uppercase"  style="margin-right: 20px;margin-left: 20px;">
                        este reconocimiento es inválido, si no tiene todas las firmas y sellos que lo que acrediten.
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-6 border  text-center" style="margin-top: 10px">
                    <h6 class="azul_claro permanente uppercase m-0 p-0">
                        <strong class="vigencia m-0 p-0" style="color: #000;">Vigencia</strong> <br>
                        permanente
                    </h6>
                </div>
                <div class="col-3 border  text-center" style="margin-top: 10px">
                    <h6 class="azul_claro permanente uppercase m-0 p-0">
                        <strong class="vigencia m-0 p-0" style="color: #000;">TIPO</strong> <br>
                        CEA
                    </h6>
                </div>
                <div class="col-3 border  text-center" style="margin-top: 10px">
                    <h6 class="azul_claro permanente uppercase m-0 p-0">
                        <strong class="vigencia m-0 p-0" style="color: #000;">TIPO</strong> <br>
                        CEA
                    </h6>
                </div>

            </div>

            <div class="row">
                <div class="col-12 text-center border m-0 p-0">
                    <P class="texto_footer2 ">La autenticidad del presente documento puede ser verificada escaneando el QR.</p>
                    </div>
            </div>

    </div>


</body>
</html>
