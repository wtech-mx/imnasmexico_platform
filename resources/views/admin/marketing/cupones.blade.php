@extends('layouts.app_admin')

@section('template_title')
    Cupones
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->


            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="mb-3">Cupones</h3>

                    @can('cupon-create')
                    <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_cupon" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                        Crear Cupon
                    </a>
                    @endcan

                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                            <th>id</th>
                            <th>nombre</th>
                            <th>tipo_de_descuento</th>
                            <th>importe</th>
                            <th>fecha_inicio</th>
                            <th>fecha_fin</th>
                            <th>estado</th>
                            <th width="280px">Acciones</th>
                        </tr>
                    </thead>
                    @foreach ($cupones as $cupon)
                    <tr>
                        <td>{{ $cupon->id }}</td>
                        <td>{{ $cupon->nombre }}</td>
                        <td>{{ $cupon->tipo_de_descuento }}</td>
                        <td>{{ $cupon->importe }}</td>
                        <td>{{ $cupon->fecha_inicio }}</td>
                        <td>{{ $cupon->fecha_fin }}</td>
                        <td>{{ $cupon->estado }}</td>
                        <td>
                            @can('cupon-edit')
                                <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#update_cupon_{{ $cupon->id }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                    <i class="fa fa-fw fa-edit"></i>
                                </a>
                            @endcan
                        </td>
                    </tr>
                    @include('admin.marketing.modal_cupon_edit')
                    @endforeach

                </table>
            </div>

          </div>
        </div>
      </div>
</div>
@include('admin.marketing.modal_cupon_create')

@endsection

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });
</script>

@endsection
