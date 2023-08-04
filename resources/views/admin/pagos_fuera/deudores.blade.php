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

                            <h3 class="mb-3">Deudores</h3>
                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>

                        </div>
                    </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="thead">
                                        <tr>
                                            <th>Num</th>
                                            <th>Nombre</th>
                                            <th>Correo</th>
                                            <th>Telefono</th>
                                            <th>Abono</th>
                                            <th>Pago Completo</th>

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
                                                <td>${{ $pago_fuera->abono }}</td>
                                                <td>
                                                    <input data-id="{{ $pago_fuera->id }}" class="toggle-class" type="checkbox"
                                                    data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                    data-on="Active" data-off="InActive" {{ $pago_fuera->deudor ? 'checked' : '' }}>
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
        // Asignar el evento a un elemento padre estático
        $('.table-responsive').on('change', '.toggle-class', function() {
            var abono = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');

            $.ajax({
                type: "GET",
                dataType: "json",
                url: '{{ route('ChangeDeudorStatus.pagos') }}',
                data: {
                    'abono': abono,
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
