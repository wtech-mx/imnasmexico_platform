<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
            width: 793px;
            height: 1120px;
            position: absolute;
        }

        .container {
            position: absolute;
            top: 35%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container2{
            position: absolute;
            top: 47%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .curso{
            font-size: 25px;
        }

        .nombre{
            font-family: 'Minion';
            font-size: 25px;
        }

        .fecha{
            position:relative;
            top: 67%;
            left: 117px;
            font-size: 18px
        }


    </style>
</head>
<body>
    {{-- <img src="{{ asset('tipos_documentos/'.$tipo_documentos->img_portada) }}" style="width:100%;"> --}}
    {{--<img src="tipos_documentos/{{ $tipo_documentos->img_portada }}" class="img_portada">--}}
    <img src="https://plataforma.imnasmexico.com/tipos_documentos/{{ $tipo_documentos->img_portada }}" class="img_portada">


    <div class="container">
        <h4 class="nombre">{{ ucwords(strtolower($nombre)) }}</h4>
    </div>

    <div class="container2">
        <h4 class="curso">{{ ucwords(strtolower($curso)) }}</h4>
    </div>

    <h4 class="fecha">{{ $fecha }}</h4>

</body>
</html>
