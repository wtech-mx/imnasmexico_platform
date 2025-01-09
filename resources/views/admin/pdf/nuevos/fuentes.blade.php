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
            font-family: 'Montserrat_Light';
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path('fonts/Montserrat-Light.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Montserrat_Medium';
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path('fonts/Montserrat-Medium.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Montserrat_ExtraLight';
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path('fonts/Montserrat-ExtraLight.ttf') }}') format('truetype');
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
            src: url('{{ storage_path('fonts/OPTIEngraversOldEnglish.otf') }}') format('truetype');
        }

        @font-face {
            font-family: 'AlexBrush-Regular';
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path('fonts/Brush.otf') }}') format('truetype');
        }

        @font-face {
            font-family: 'AlexBrush_Regular';
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path('fonts/AlexBrush-Regular.ttf') }}') format('truetype');
        }

        @font-face {
            font-family: 'Montserrat_LightItalic';
            font-style: normal;
            font-weight: normal;
            src: url('{{ storage_path('fonts/Montserrat-LightItalic.ttf') }}') format('truetype');
        }

        .text-center {
            text-align: center;
        }

        .text-start{
            text-align: start;
        }

        .text-end{
            text-align: end;
        }

        .p-2{
            padding: 10px;
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

        .capitalize{
            text-transform: capitalize;
        }

        .uppercase{
            text-transform: uppercase;
        }


        body, html {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
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

</style>
