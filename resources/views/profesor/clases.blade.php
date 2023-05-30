
@extends('layouts.app_profesor')

@section('template_title')
    Clases
@endsection

@section('css_custom')

@endsection

@section('content')

<div class="row">
    @foreach ($cursos as $curso)
    <div class="col-12 col-md-12 mt-3 mb-3 col-md-3 mb-md-3 col-lg-6 mb-lg-5 mt-lg-5">
        <a href="{{ route('clase.index', $curso->id) }}" style="display: contents;">
            <div class="container_card_class">
                <div class="d-flex justify-content-evenly">

                        <img src="{{asset('curso/'. $curso->foto) }}" alt="" style="width: 10%;">

                        <p class="text-center">
                            {{$curso->nombre}} <br>
                            <strong>{{ $curso->modalidad}}</strong> <br>
                                @php

                                $fecha_inicial = $curso->fecha_inicial;
                                $date = new DateTime($fecha_inicial);
                                $dia = $date->format('j');
                                $mes = $date->format('M');
                                $fechaFormateada = $dia . ' ' . $mes;

                                $fecha_final = $curso->fecha_inicial;
                                $date = new DateTime($fecha_final);
                                $dia = $date->format('j');
                                $mes = $date->format('M');
                                $fechaFormateada2 = $dia . ' ' . $mes;

                                $hora = $curso->hora_inicial;
                                $time = DateTime::createFromFormat('H:i:s', $hora);
                                $horaFormateada = $time->format('H:i');

                                $horafinal = $curso->hora_final;
                                $time = DateTime::createFromFormat('H:i:s', $horafinal);
                                $horaFormateada2 = $time->format('H:i');

                                @endphp
                                <strong>Fecha Inicial : </strong>
                                {{$fechaFormateada}} - {{$horaFormateada}} <br>

                                <strong>Fecha Final :</strong>
                                {{$fechaFormateada2}} - {{$horaFormateada2}} <br>

                                <strong>En lista : </strong> 55 Alumnas

                        </p>

                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>

@endsection


