@extends('layouts.app_admin')

@section('template_title')
    Pagos por Fuera
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">


                            <h3 class="mb-3">Pendientes de Inscripción</h3>

                            @can('client-create')
                                <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    Crear
                                </a>
                            @endcan

                        </div>
                    </div>

                    @can('client-list')
                        <div class="card-body">
                            @include('admin.pagos_fuera.create')
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>Telefono</th>
                                            <th>Curso</th>
                                            <th>Modalidad</th>
                                            <th>Inscripcion</th>

                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pagos_fuera as $pago_fuera)
                                        @include('admin.pagos_fuera.modal_ins')
                                            <tr>
                                                <td>{{ $pago_fuera->nombre }}</td>
                                                <td>{{ $pago_fuera->correo }}</td>
                                                <td>{{ $pago_fuera->telefono }}</td>
                                                <td>{{ $pago_fuera->curso }}</td>
                                                @if ($pago_fuera->modalidad == "Online")
                                                    <td> <label class="badge" style="color: #009ee3;background-color: #009ee340;">Online</label> </td>
                                                @else
                                                    <td> <label class="badge" style="color: #746AB0;background-color: #746ab061;">Presencial</label> </td>
                                                @endif
                                                <td>
                                                    <input data-id="{{ $pago_fuera->id }}" class="toggle-class" type="checkbox"
                                                    data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                    data-on="Active" data-off="InActive" {{ $pago_fuera->inscripcion ? 'checked' : '' }}>
                                                </td>
                                                <td>
                                                    <a type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#showDataModal{{$pago_fuera->id}}" style="color: #ffff"><i class="fa fa-users"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
@endsection

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        searchable: true,
        fixedHeight: false
    });

    $(function() {
        $('.toggle-class').change(function() {
            var inscripcion = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');

            // Obtener el valor del token CSRF desde la etiqueta meta
            var token = $('meta[name="csrf-token"]').attr('content');

            // Enviar el token CSRF junto con los demás datos
            $.ajax({
                type: "POST",
                dataType: "json",
                url: '{{ route('ChangeInscripcionStatus.pagos') }}',
                data: {
                    '_token': token, // Agregar el token CSRF en los datos
                    'inscripcion': inscripcion,
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
