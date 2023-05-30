@extends('layouts.app_profesor')

@section('template_title')
    Clase de {{$curso->nombre}}
@endsection

@section('css_custom')

@endsection

@section('content')

<div class="row">

    <div class="col-12 col-md-12 mt-3 mb-3 col-md-3 mb-md-3 col-lg-6 mb-lg-5 mt-lg-5">
        <div class="container_card_class">
            <img src="{{asset('curso/'. $curso->foto) }}" alt="" style="width: 10%;">
        </div>
    </div>

    <div class="col-12 col-md-12 mt-3 mb-3 col-md-3 mb-md-3 col-lg-6 mb-lg-5 mt-lg-5">
        <div class="container_card_class">
            <h3 class="tittle_cursos mb-2">
                #{{$curso->id}} - {{$curso->nombre}}
            </h3>
            <p class="text-left">
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

    <div class="col-12 col-md-12 mt-3 mb-3 col-md-3 mb-md-3 col-lg-6 mb-lg-5 mt-lg-5">
        <div class="container_card_class">
            <ul style="list-style-type:circle">
                @foreach ($ordenes as $order)
                    @if ($order->Orders->estatus == '1')
                    <li >
                            {{ $order->User->name }}
                            <a class="btn btn-sm btn-success text-white" target="_blank" href="https://api.whatsapp.com/send?phone={{ $order->User->telefono }}&text=Recordatorio%20de%20clase%3A%0AHola%20{{ $order->User->name }}%2C%20te%20recordamos%20que%20tu%20clase%20{{ $order->Cursos->nombre }}%2C%20inicia%20hoy%20a%20las%20{{ $order->Cursos->hora_inicial }}.%0ALa%20liga%20de%20clase%20la%20podrás%20encontrar%20en%20tu%20correo%20o%20ingresando%20a%20tu%20perfil%20con%20el%20número%20que%20proporcionaste%20%22{{ $order->User->telefono }}%22.%0A">
                                <i class="fa fa-whatsapp"></i>
                            </a>

                            <form method="POST" action="{{ route('cursos.correo' ,$order->id) }}" enctype="multipart/form-data" role="form" style="display: inline-block">
                                @csrf
                                <input type="hidden" name="email" id="email" value="{{ $order->User->email }}">
                                <input type="hidden" name="ticket" id="ticket" value="{{ $order->id_tickets }}">
                                <input type="hidden" name="id_usuario" id="id_usuario" value="{{ $order->id_usuario }}">
                                <input type="hidden" name="curso" id="curso" value="{{ $order->id_curso }}">
                                <button type="submit" class="btn btn-sm btn-primary" >Correo</button>
                            </form>

                            <input data-id="{{ $order->Orders->id }}" class="toggle-class" type="checkbox"
                            data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                            data-on="Active" data-off="InActive" {{ $order->Orders->asistencia ? 'checked' : '' }}>
                    </li>
                    @endif
                @endforeach
            </ul>
        </div>

    </div>

</div>

@endsection

@section('datatable')

<script>
    $(function() {
        $('.toggle-class').change(function() {
            var asistencia = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');

            // Obtener el valor del token CSRF desde la etiqueta meta
            var token = $('meta[name="csrf-token"]').attr('content');

            // Enviar el token CSRF junto con los demás datos
            $.ajax({
                type: "POST",
                dataType: "json",
                url: '{{ route('ChangeAsistenciaStatus.clase') }}',
                data: {
                    '_token': token, // Agregar el token CSRF en los datos
                    'asistencia': asistencia,
                    'id': id
                },
                success: function(data) {
                    console.log(data.success);
                }
            });
        });
    });
</script>

@endsection
