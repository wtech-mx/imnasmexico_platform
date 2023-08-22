@extends('layouts.app_admin')

@section('template_title')
    Todas las notas
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">

                            <h3 class="mb-3">Todas las notas</h3>

                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>

                            <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                Crear
                            </a>

                        </div>
                    </div>

                        <div class="card-body">
                            @include('admin.pagos_fuera.create')
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>Num.</th>
                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>Telefono</th>
                                            <th>Curso</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pagos_fuera as $pago_fuera)
                                        @include('admin.pagos_fuera.modal_ins')
                                            <tr>
                                                <td>{{ $pago_fuera->id }}</td>
                                                <td>{{ $pago_fuera->nombre }}</td>
                                                <td>{{ $pago_fuera->correo }}</td>
                                                <td>{{ $pago_fuera->telefono }}</td>
                                                <td>{{ $pago_fuera->curso }}</td>
                                                <td>
                                                    <a type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#showDataModal{{$pago_fuera->id}}" style="color: #ffff"><i class="fa fa-users"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('datatable')

<script>
    $(document).ready(function() {
        // Esconde el contenedor del campo "Abono" inicialmente
        $('#abono-container').hide();

        // Escucha el evento 'change' del checkbox 'Deudor'
        $('#deudor').change(function() {
            // Si el checkbox 'Deudor' está seleccionado, muestra el contenedor del campo "Abono"
            if ($(this).is(':checked')) {
            $('#abono-container').show();
            } else {
            // Si el checkbox 'Deudor' está deseleccionado, oculta el contenedor del campo "Abono" y borra el valor ingresado
            $('#abono-container').hide();
            $('#abono').val('');
            }
        });
    });

    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        searchable: true,
        fixedHeight: false
    });

    $(function() {
        // Asignar el evento a un elemento padre estático
        $('.table-responsive').on('change', '.toggle-class', function() {
            var inscripcion = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('ChangeInscripcionStatus.pagos') }}',
                data: {
                    'inscripcion': inscripcion,
                    'id': id
                },
                success: function(data) {
                    console.log(data.success)
                }
            });
        });
    });

</script>

@endsection
