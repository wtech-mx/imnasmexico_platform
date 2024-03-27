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

        .container_horas {
            position: absolute;
            top: 30%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 650px;
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

        .horas{
            font-size: 22px;
            font-weight: lighter;
        }

        .fecha{
            position:relative;
            top: 67%;
            left: 117px;
            font-size: 18px
        }

        .fecha_sello{
            position:relative;
            top: 72.5%;
            left: 208px;
            font-size: 13px
        }

    </style>
</head>
<body>

    @if(isset($sello))
        @if($sello == 'Si')
            {{-- <img src="{{ asset('tipos_documentos/'.$tipo_documentos->img_portada) }}" style="width:100%;"> --}}
            {{-- <img src="tipos_documentos/{{ $tipo_documentos->img_portada }}" class="img_portada"> --}}
            <img src="https://plataforma.imnasmexico.com/tipos_documentos/{{ $tipo_documentos->img_portada }}" class="img_portada">

        @else

            {{-- <img src="{{ asset('tipos_documentos/'.$tipo_documentos->img_reverso) }}" style="width:100%;"> --}}
            {{-- <img src="tipos_documentos/{{ $tipo_documentos->img_reverso }}" class="img_reverso"> --}}
            <img src="https://plataforma.imnasmexico.com/tipos_documentos/{{ $tipo_documentos->img_reverso }}" class="img_portada">
        @endif
    @else
        <img src="https://plataforma.imnasmexico.com/tipos_documentos/{{ $tipo_documentos->img_portada }}" class="img_portada">
    @endif


    @php
        // Verificar si $duracion_hrs está vacía y asignarle "48 horas" si es el caso
        $duracion_hrs = empty($duracion_hrs) ? '48' : $duracion_hrs;

    @endphp

    <div class="container_horas">
        <h4 class="horas">Otorga el presente reconocimiento con valor curricular de {{ $duracion_hrs }} horas a:</h4>
    </div>



    <div class="container">
        <h4 class="nombre">{{ ucwords(strtolower($nombre)) }}</h4>
    </div>

    <div class="container2">
        <h4 class="curso">{{ ucwords(strtolower($curso)) }}</h4>
    </div>




    @if($sello == 'Si')

        <h4 class="fecha">

            @php
                $fecha_timestamp = strtotime($fecha);
                $fecha_formateada = date('d-m-Y', $fecha_timestamp);
            @endphp

            {{$fecha_formateada}}
        </h4>

    @else

        <h4 class="fecha_sello">

            @php
                $fecha_timestamp = strtotime($fecha);
                $fecha_formateada = date('d-m-Y', $fecha_timestamp);
            @endphp

            {{$fecha_formateada}}
        </h4>

    @endif

</body>
</html>
