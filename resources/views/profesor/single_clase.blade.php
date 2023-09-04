@extends('layouts.app_profesor')

@section('template_title')
    Clase de {{$curso->nombre}}
@endsection

@section('css_custom')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
@endsection

@section('main')bg-main @endsection

@section('content')

<div class="row">

    <div class="col-12 col-md-12 mt-3 mb-3 col-md-3 mb-md-3 col-lg-6 mb-lg-5 mt-lg-5">
        <div class="container_card_class">
            <p class="text-center">
                <img src="{{asset('curso/'. $curso->foto) }}" alt="" style="width: 80%;">
            </p>
        </div>
    </div>

    <div class="col-12 col-md-12 mt-3 mb-3 col-md-3 mb-md-3 col-lg-6 mb-lg-5 mt-lg-5">
        <div class="container_card_class">
            <div class="d-flex justify-content-start mb-3">
                    <a href="{{ route('clase.index') }}" class="" style="text-decoration: none;margin-right: 2rem;background:#fff; border-radius:16px;padding: 10px;color:#000;box-shadow: 15px 15px 19px -14px rgba(0,0,0,0.64);border: solid 5px #836262;">
                        <i class="fa fa-pencil"></i> Mis Clases
                    </a>

                    <a href="{{ route('dashboard.index') }}" class="" style="text-decoration: none;background:#fff; border-radius:16px;padding: 10px;color:#000;box-shadow: 15px 15px 19px -14px rgba(0,0,0,0.64);border: solid 5px #836262;">
                        <i class="fa fa-calendar"></i> Calendario
                    </a>
            </div>

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

                    <strong class="text-dark">En lista : </strong>
                    @php
                        $contador = 0;
                    @endphp
                    @foreach ($ordenes as $order)
                        @if ($order->Orders->estatus == '1')
                            @php
                                $contador++;
                            @endphp
                        @endif
                    @endforeach
                    {{ $contador }} <br>
                    <strong class="text-dark">Profesor Asignado :</strong> {{$profesor->name}}

            </p>
            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>telefono</th>
                            {{-- <th>email</th> --}}
                            <th>Check</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    @foreach ($ordenes as $order)

                    @if ($order->Orders->estatus == '1')

                    <tr>
                        <td>{{ $order->User->id }}</td>
                        <td>{{ $order->User->name }}</td>
                        <td>{{ str_repeat('*', strlen($order->User->telefono) - 4) . substr($order->User->telefono, -4) }}</td>
                        {{-- <td>{{ $order->User->email }}</td> --}}
                        <td>
                            <input data-id="{{ $order->Orders->id }}" class="toggle-class" type="checkbox"
                            data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                            data-on="Active" data-off="InActive" {{ $order->Orders->asistencia ? 'checked' : '' }}>
                        </td>
                        <td>
                            <a class="btn btn-sm btn-success text-white" target="_blank" href="https://api.whatsapp.com/send?phone={{ $order->User->telefono }}&text=Recordatorio%20de%20clase%3A%0AHola%20{{ $order->User->name }}%2C%20te%20recordamos%20que%20tu%20clase%20{{ $order->Cursos->nombre }}%2C%20inicia%20hoy%20a%20las%20{{ $order->Cursos->hora_inicial }}.%0ALa%20liga%20de%20clase%20la%20podrás%20encontrar%20en%20tu%20correo%20o%20ingresando%20a%20tu%20perfil%20con%20el%20número%20que%20proporcionaste%20%22{{ $order->User->telefono }}%22.%0A">
                                <i class="fa fa-whatsapp"></i>
                            </a>

                            <form method="POST" action="{{ route('cursos.correo' ,$order->id) }}" enctype="multipart/form-data" role="form" style="display: inline-block">
                                @csrf
                                <input type="hidden" name="email" id="email" value="{{ $order->User->email }}">
                                <input type="hidden" name="ticket" id="ticket" value="{{ $order->id_tickets }}">
                                <input type="hidden" name="id_usuario" id="id_usuario" value="{{ $order->id_usuario }}">
                                <input type="hidden" name="curso" id="curso" value="{{ $order->id_curso }}">
                                <button type="submit" class="btn btn-sm btn-primary" ><i class="fa fa-envelope"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </table>
            </div>
        </div>
    </div>



</div>

@endsection

@section('datatable')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>

$(document).ready(function() {
    $('#datatable-search').DataTable({
        searching: true,
        pageLength: 25,
        scrollY: '400px', // Ajusta la altura de la tabla según tus necesidades
        scrollCollapse: true,
        // Resto de las opciones y configuraciones que desees agregar
    });
});


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
