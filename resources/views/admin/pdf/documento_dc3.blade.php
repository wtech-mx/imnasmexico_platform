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
            top: 7.5%;
            left: 15%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .container_horas {
            position: absolute;
            top: 45%;
            left: 10%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 650px;
        }

        .container_curp {
            position: absolute;
            top: 12.5%;
            left: 38.3%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 650px;
            letter-spacing: 22px;
        }

        .container_costo {
            position: absolute;
            top: 50%;
            left: 10%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 650px;
        }

        .container_fecha {
            position: absolute;
            top: 47%;
            left: 65.6%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 1000px;
        }

        .container2{
            position: absolute;
            top: 41.5%;
            left: 13.5%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .curso{
            font-size: 15px;
        }

        .nombre{
            font-family: 'Minion';
            font-size: 15px;
        }

        .horas{
            font-size: 15px;
            font-weight: lighter;
        }

        .costo{
            font-size: 15px;
            font-weight: lighter;
        }

        .curp{
            font-size: 15px;
            font-weight: lighter;
        }

        .fecha{
            font-size: 15px;
            letter-spacing: 25px;
        }

    </style>
</head>
<body>

        {{-- <img src="{{ asset('tipos_documentos/'.$tipo_documentos->img_portada) }}" style="width:100%;"> --}}
        {{-- <img src="tipos_documentos/{{ $tipo_documentos->img_portada }}" class="img_portada"> --}}
        <img src="https://plataforma.imnasmexico.com/tipos_documentos/{{ $tipo_documentos->img_portada }}" class="img_portada">
    @php
        // Verificar si $duracion_hrs está vacía y asignarle "48 horas" si es el caso
        $duracion_hrs = empty($duracion_hrs) ? '48' : $duracion_hrs;

    @endphp

    <div class="container_horas">
        <h4 class="horas"> {{ $duracion_hrs }}</h4>
    </div>

    <div class="container_costo">
        <h4 class="costo"> {{ $costo }}</h4>
    </div>

    <div class="container_curp">
        <h4 class="curp"> {{ $curp }}</h4>
    </div>

    <div class="container_fecha">
        <h4 class="fecha"> {{ $fecha_unida }}</h4>
    </div>

    <div class="container">
        <h4 class="nombre">{{ ucwords(strtolower($nombre)) }}</h4>
    </div>

    <div class="container2">
        <h4 class="curso">{{ ucwords(strtolower($curso)) }}</h4>
    </div>



</body>
</html>
