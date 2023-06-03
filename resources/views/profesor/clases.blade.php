
@extends('layouts.app_profesor')

@section('template_title')
    Clases
@endsection

@section('css_custom')

@endsection


@section('content')

<div class="row">

    <div class="col-12 mt-3 mb-3 mb-md-3  mb-lg-5 mt-lg-5" style="">
        <div class="container">
            <p class="text-center">
                <a class="btn btn-primary text-dark" href="{{ route('dashboard.index') }}" style="    background-color: #F5ECE4;border-radius: 19px;padding: 10px;border:solid 1px transparent;">
                    Regresar al calendario
                </a>
            </p>
        </div>

    </div>

    @if(count($cursos) > 0)

    @foreach ($cursos as $curso)
    <div class="col-12 col-md-12 mt-3 mb-3 col-md-3 mb-md-3 col-lg-6 mb-lg-5 mt-lg-5">
        <a href="{{ route('single_course.index', $curso->id) }}" style="display: contents;color: #836262;">
            <div class="container_card_class">

                <div class="row">
                    <div class="col-4">
                        <img src="{{asset('curso/'. $curso->foto) }}" alt="" style="width: 100%;">
                    </div>

                    <div class="col-8">
                        <h3 class="tittle_cursos mb-2">
                            #{{$curso->id}} - {{$curso->nombre}}
                        </h3>
                        <p class="text-left mb-3">
                            <strong class="btn_radios_modalidad">{{ $curso->modalidad}}</strong> <br>
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
                        </p>
                        <p class="text-left">
                                <strong class="text-dark">Fecha Inicial : </strong>
                                {{$fechaFormateada}} - {{$horaFormateada}} <br>

                                <strong class="text-dark">Fecha Final :</strong>
                                {{$fechaFormateada2}} - {{$horaFormateada2}} <br>

                                <strong class="text-dark">En lista : </strong> 55 Alumnas

                        </p>
                    </div>
                </div>
            </div>
        </a>
    </div>
    @endforeach

    @else
    <div class="col-12 mt-3 mb-3 mb-md-3  mb-lg-5 mt-lg-5" style="height: 88vh;">
        <div class="container">
            <p class="text-center">
                <a class="text-center text-white" >
                    No hay clases asignadas
                </a> <br> <br>

                <a class="btn btn-primary" href="{{ route('dashboard.index') }}">
                    Regresar
                </a>
            </p>
        </div>

    </div>
    @endif
</div>

@endsection


