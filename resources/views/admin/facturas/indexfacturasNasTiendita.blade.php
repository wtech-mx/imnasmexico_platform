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

                    <a class="btn" id="regresar_btn" style="background: {{$configuracion->color_boton_close}}; color: #fff"><i class="fas fa-arrow-left"></i> Regresar </a>

                    <h3 class="mb-3">Facturas Tiendita</h3>

                    <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                        ¿Como funciona?
                    </a>
                </div>

            </div>

            <div class="col-12 p-2">
                <a href="{{ route(name: 'facturas.index') }}" class="btn btn-primary">Cursos Pag</a>
                <a href="{{ route(name: 'facturas.indexfacturasCosmica') }}" class="btn btn-success">Cosmica</a>
                <a href="{{ route(name: 'facturas.indexfacturasNas') }}" class="btn btn-dark">NAS</a>
                <a href="{{ route(name: 'facturas.indexfacturasNasTiendita') }}" class="btn btn-secondary">Tiendita</a>
                <a href="{{ route(name: 'facturas.indexfacturasCursos') }}" class="btn btn-info">Cursos por Fuera</a>
            </div>

            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>User Admin</th>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Orden</th>
                            <th>Folio</th>
                            <th>Estatus</th>
                            <th>Total</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    @foreach ($facturas as $factura)
                    <tr>
                        <td>{{ $factura->id }}</td>
                        <td>{{ $factura->User->name }}</td>
                        <td>{{ $factura->NotasNasTiendita->User->name }}</td>
                        <td>{{ $factura->NotasNasTiendita->User->telefono  }}</td>
                        <td>#{{ $factura->NotasNasTiendita->id }}</td>

                        <td>
                            {{ $factura->NotasNasTiendita->folio }}
                        </td>

                        <td>
                            {{ $factura->estatus }}
                        </td>

                        <td>
                            @php
                                 $precio = number_format($factura->NotasNasTiendita->total, 2, '.', ',');
                            @endphp
                            $ {{ $precio }}
                        </td>

                        <td>
                            @can('factura-ver')
                                <a type="button" class="btn btn-sm bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#update_cliente_{{ $factura->id }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    <i class="fa fa-fw fa-eye"></i>
                                </a>
                            @endcan

                            @can('factura-compra')
                                <a target="_blank" class="btn btn-sm btn-warning" href="{{ route('pagos.edit_pago',$factura->NotasNasTiendita->id) }}">
                                    <i class="fa fa-fw fa-pencil"></i>
                                </a>
                            @endcan

                            @can('factura-subir')
                                <a type="button" class="btn btn-sm btn-dark"data-bs-toggle="modal" data-bs-target="#factura{{ $factura->id }}">
                                    <i class="fa fa-money"></i>
                                </a>
                            @endcan
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
