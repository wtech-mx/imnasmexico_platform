@extends('layouts.app_admin')

@section('template_title')
   Editar Orden
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <h3 class="mb-3">Editar Orden</h3>

                            <a class="btn"  href="{{ route('pagos.index_pago') }}" style="background: {{$configuracion->color_boton_close}}; color: #ffff;margin-right: 3rem;">
                                Regresar
                            </a>
                        </div>
                    </div>
                    <div class="card-body">

                            <form method="POST" action="{{ route('pagos.update_pago', $orders->id) }}" enctype="multipart/form-data" role="form">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">

                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="nota">Num Orden</label>
                                            <input type="text" class="form-control" value="{{$orders->num_order}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="nota">Forma de Pago</label>
                                            <input type="text" class="form-control" value="{{$orders->forma_pago}}" disabled>
                                        </div>
                                    </div>
                                    @if ($orders->id_externo == NULL)
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label for="nota">Personal que subio el pago</label>
                                                <input type="text" class="form-control" value="Pago por pagina" disabled>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label for="nota">Personal que subio el pago</label>
                                                <input type="text" class="form-control" value="{{$orders->PagosFuera->usuario}}" disabled>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="nota">Fecha</label>
                                            <input type="text" class="form-control" value="{{$orders->fecha}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label for="nota">Estatus</label><br>
                                            <select class="form-control" name="estatus" id="estatus">
                                                @if ($orders->estatus == '0')
                                                    <option value="0" selected>En espera</option>
                                                    <option value="1">Completado</option>
                                                    <option value="2">Rechazado</option>
                                                @elseif ($orders->estatus == '1')
                                                    <option value="1" selected>Completado</option>
                                                    <option value="0">En espera</option>
                                                    <option value="2">Rechazado</option>
                                                @elseif ($orders->estatus == '2')
                                                    <option value="2" selected>Rechazado</option>
                                                    <option value="0">En espera</option>
                                                    <option value="1">Completado</option>
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="nota">Nombre</label>
                                            <input type="text" class="form-control" value="{{$orders->User->name}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="nota">Correo</label>
                                            <input type="text" class="form-control" value="{{$orders->User->email}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="form-group">
                                            <label for="nota">Razon Social</label>
                                            <input type="text" class="form-control" value="{{$orders->User->razon_social}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="nota">Telefono</label>
                                            <input type="text" class="form-control" value="{{$orders->User->telefono}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="nota">CFDI</label>
                                            <input type="text" class="form-control" value="{{$orders->User->cfdi}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="nota">RFC</label>
                                            <input type="text" class="form-control" value="{{$orders->User->rfc}}" disabled>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="nota">Direccion</label>
                                            <textarea class="form-control" cols="10" rows="1" disabled>{{$orders->User->direccion}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn">
                                        Actualizar
                                    </button>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('cursos.cambio', $orders->id) }}" enctype="multipart/form-data" role="form">
                                @csrf
                                <input type="hidden" name="_method" value="PATCH">
                                <div class="row">
                                    <h4>Cambio de curso</h4>
                                    <div class="col-5">
                                        <label for="">Nombre del curso</label>
                                        <select name="curso_ticket" id="curso_ticket" class="form-select d-inline-block cursos">
                                            <option value="">Seleccione Curso</option>
                                            @foreach ($cursos as $item)
                                            <option value="{{ $item->id }}">{{ $item->nombre }}  / {{ $item->fecha_inicial }} - {{ $item->modalidad }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-5">
                                        <label for="">Seleccione un ticket</label>
                                        <select class="form-control" id="ticket" name="ticket">
                                            <option value="">seleccione un curso</option>
                                        </select>
                                    </div>
                                    <div class="col-2">
                                        <br>
                                        <button type="submit" class="btn btn-secondary">
                                            Cambiar
                                        </button>
                                    </div>
                                </div>
                            </form>
                                <div class="modal-body">
                                    <div class="tab-content">
                                        <div class="row text-center">
                                            <div class="col-6" style="background-color: #bb546c; color: #fff;">Nombre</div>
                                            <div class="col-2" style="background-color: #bb546c; color: #fff;">Fecha Curso</div>
                                            <div class="col-2" style="background-color: #bb546c; color: #fff;">Precio</div>
                                            <div class="col-2" style="background-color: #bb546c; color: #fff;">Monto</div>
                                        </div>
                                        @foreach ($order_tickets as $order_ticket)
                                            <div class="row text-center mt-2">
                                                <div class="col-6">{{$order_ticket->CursosTickets->nombre}}</div>
                                                <div class="col-2">{{$order_ticket->Cursos->fecha_inicial}}</div>
                                                <div class="col-2">${{$order_ticket->CursosTickets->precio}}</div>
                                                <div class="col-2">${{$orders->pago}}</div>
                                            </div>
                                        @endforeach
                                </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('datatable')
<script src="{{ asset('assets/admin/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>

  <script type="text/javascript">

    $(document).ready(function() {
        $('.cursos').select2();
    });
  </script>

<script>
    $(document).ready(function () {
        $('#curso_ticket').on('change', function () {
                let id = $(this).val();
                console.log(id);
                //curso no esta en la tabla de automovil
            $('#ticket').empty();
                $('#ticket').append(`<option value="" disabled selected>Procesando..</option>`);
                $.ajax({
                type: 'GET',
                url: 'cambio/' + id,
                success: function (response) {
                var response = JSON.parse(response);
                console.log(response);
                //trae los automoviles relacionados con el curso
                $('#ticket').empty();
                $('#ticket').append(`<option value="" disabled selected>Seleccione ticket de curso</option>`);
                response.forEach(element => {
                    $('#ticket').append(`<option value="${element['id']}">${element['nombre']}</option>`);
                    });
                }
            });
        });
    });
</script>
@endsection
