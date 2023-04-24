@extends('layouts.app_admin')

@section('template_title')
    Reporte Mes
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="mb-3">Total del Mes</h3>
                    </div>
                </div>
                <div class="card-body">
                    <h3 class="text-center">
                        <b>${{ $totalPagadoFormateado }}</b>
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="mb-3">Tickets vendidos</h3>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-flush" id="datatable-search">
                        <thead class="text-center">
                            <tr class="tr_checkout">
                            <th >Nombre</th>
                            <th >Personas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cursosComprados as $curso)
                                <tr>
                                    <td>{{ $curso['nombre'] }}</td>
                                    <td>{{ $curso['total'] }} personas</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">

                            <h3 class="mb-3">Cursos Mes</h3>

                        </div>
                    </div>

                    @can('client-list')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search2">
                                    <thead class="text-center">
                                        <tr class="tr_checkout">
                                          <th >Num. Pedido</th>
                                          <th >Cliente</th>
                                          <th >Fecha de Compra</th>
                                          <th >Total</th>
                                          <th>Forma de Pago</th>
                                          <th>Estado</th>
                                          <th>Acciones</th>
                                        </tr>
                                      </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->User->name }}</td>
                                                <td>{{ $order->fecha }}</td>
                                                <td>{{ $order->pago }}</td>
                                                <td>{{ $order->forma_pago }}</td>
                                                <td>
                                                    @if ($order->estatus == '1')
                                                        Completado
                                                    @else
                                                        En espera
                                                    @endif
                                                </td>

                                                <td>
                                                    <a class="btn btn-sm btn-success" href="{{ route('pagos.edit_pago',$order->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
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
        deferRender:true,
        paging: true,
        pageLength: 10
    });

    const dataTableSearch2 = new simpleDatatables.DataTable("#datatable-search2", {
        deferRender:true,
        paging: true,
        pageLength: 10
    });
</script>

@endsection
