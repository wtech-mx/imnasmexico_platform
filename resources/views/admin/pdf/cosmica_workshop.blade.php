<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Diploma Cosmica</title>
    <style>
        * {
            padding: 0px;
            margin: 0px;
        }

        @font-face {
            font-family: 'Minion';
            src: url('file:///E:/laragon/www/imnasmexico_platform/public/assets/admin/fonts/Minion.ttf');
        }

        .img_portada {
            width: 100%;
            /* height: 904.5px; */
            position: absolute;
        }

        .container {
            position: absolute;
            top: 51.5%;
            left: 25%;

            text-align: left;
        }

        .nombre{
            font-family: 'Minion';
            font-size: 40px;
        }

        .fecha{
            position:relative;
            top: 70%;
            left: 26%;
            font-size: 40px
        }


    </style>
</head>
<body>

    {{-- <img src="{{ asset('tipos_documentos/'.$tipo_documentos->img_portada) }}" style="width:100%;"> --}}
    {{-- <img src="tipos_documentos/{{ $tipo_documentos->img_portada }}" class="img_portada"> --}}
    <img src="https://plataforma.imnasmexico.com/tipos_documentos/{{ $tipo_documentos->img_portada }}" class="img_portada">

    <div class="container">
        <h4 class="nombre">{{ ucwords(strtolower($nombre)) }}</h4>
    </div>

    <h4 class="fecha">
            @php
                $fecha_timestamp = strtotime($fecha);
                $fecha_formateada = date('d-m-Y', $fecha_timestamp);
            @endphp
            {{$fecha_formateada}}
    </h4>

</body>
</html>
