@extends('layouts.app_admin')

@section('template_title')
    Reporte Semanal
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="mb-3">Reporte Semanal</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="text-center mb-3">Total del Semana</h4>
                            <h5 class="text-center">
                                @php
                                    $totalPagado = 0;
                                    foreach ($orders as $order) {
                                        $order->pago;
                                        $totalPagado += $order->pago;
                                    }
                                @endphp
                                ${{ number_format($totalPagado, 2, '.', ',') }}

                            </h5>
                            <div class="d-flex justify-content-center mt-3">
                                <form method="POST" action="{{ route('reporte_semanal.store') }}" enctype="multipart/form-data" role="form">
                                    @csrf
                                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff"> Enviar Reporte</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-6">
                            <h4 class="text-center mb-3">Grafica  proximamente</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid mt-4">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <div class="d-flex justify-content-center mt-5">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="tickets-tab" data-bs-toggle="tab" data-bs-target="#tickets-tab-pane" type="button" role="tab" aria-controls="tickets-tab-pane" aria-selected="true">
                            Tickets
                          </button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders-tab-pane" type="button" role="tab" aria-controls="orders-tab-pane" aria-selected="false">
                            Ordenes
                          </button>
                    </ul>
                </div>

                <div class="tab-content" id="myTabContent">

                    <div class="tab-pane fade show active" id="tickets-tab-pane" role="tabpanel" aria-labelledby="tickets-tab" tabindex="0">

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

                    <div class="tab-pane fade" id="orders-tab-pane" role="tabpanel" aria-labelledby="orders-tab" tabindex="0">

                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <h3 class="mb-3">Ordenes de la Semana</h3>
                            </div>
                        </div>

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
