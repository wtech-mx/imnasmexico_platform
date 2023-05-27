@extends('layouts.app_admin')

@section('template_title')
    Facturas
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="mb-3">Facturas</h3>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Correo</th>
                            <th>Orden</th>
                            <th>Estatus</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    @foreach ($facturas as $factura)
                    <tr>
                        <td>{{ $factura->id }}</td>
                        <td>{{ $factura->User->name }}</td>
                        <td>{{ $factura->User->telefono }}</td>
                        <td>{{ $factura->User->email }}</td>
                        <td>
                            # {{ $factura->Orders->id }}
                        </td>
                        <td>
                            {{ $factura->estatus }}
                        </td>
                        <td>${{ $factura->Orders->pago }}</td>
                        <td>
                            <a type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#update_cliente_{{ $factura->id }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                <i class="fa fa-fw fa-eye"></i>
                            </a>
                            <a target="_blank" class="btn btn-sm btn-warning" href="{{ route('pagos.edit_pago',$factura->Orders->id) }}">
                                <i class="fa fa-fw fa-pencil"></i>
                            </a>
                            <a type="button" class="btn btn-sm btn-success"data-bs-toggle="modal" data-bs-target="#factura{{ $factura->id }}">
                                <i class="fa fa-money"></i>
                            </a>
                        </td>
                    </tr>
                    @include('admin.facturas.modal_view')
                    @include('admin.facturas.modal_facturas')
                    @endforeach
                </table>
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
</script>

@endsection
