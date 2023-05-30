@extends('layouts.app_profesor')

@section('template_title')
    Clase
@endsection

@section('css_custom')

@endsection

@section('content')

<div class="row">

    <div class="col-12 col-md-12 mt-3 mb-3 col-md-3 mb-md-3 col-lg-12 mb-lg-5 mt-lg-5">
        <div class="container_card_class">
            <div class="d-flex justify-content-evenly">

                <img src="{{asset('curso/'. $curso->foto) }}" alt="" >

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

                        <strong>Lista : </strong> 55 Alumnas
                        <ul class="nav nav-pills nav-fill p-1" id="pills-tab" role="tablist">
                            @foreach ($ordenes as $order)
                                @if ($order->Orders->estatus == '1')
                                <li class="nav-item" role="presentation">
                                        {{ $order->User->name }}

                                        <form method="POST" action="{{ route('cursos.correo' ,$order->id) }}" enctype="multipart/form-data" role="form" style="display: inline-block">
                                            @csrf
                                            <input type="hidden" name="email" id="email" value="{{ $order->User->email }}">
                                            <input type="hidden" name="ticket" id="ticket" value="{{ $order->id_tickets }}">
                                            <input type="hidden" name="id_usuario" id="id_usuario" value="{{ $order->id_usuario }}">
                                            <input type="hidden" name="curso" id="curso" value="{{ $order->id_curso }}">
                                            <button type="submit" class="btn btn-sm btn-primary" ><i class="fas fa-envelope"></i></button>
                                        </form>
                                </li>
                                @endif
                            @endforeach
                        </ul>
                </p>
            </div>
        </div>
    </div>
</div>

@endsection


