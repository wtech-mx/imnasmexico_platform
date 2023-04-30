@extends('layouts.app_admin')

@section('template_title')
    Reporte Dia
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="mb-3">Reporte</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h4 class="text-center mb-3">Total del dia</h4>
                            <h5 class="text-center">
                            <b>${{ $totalPagadoFormateado }}</b>
                            </h5>
                            <div class="d-flex justify-content-center mt-3">
                                <form method="POST" action="{{ route('reporte_email_dia.store') }}" enctype="multipart/form-data" role="form">
                                    @csrf
                                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff"> Enviar Reporte</button>
                                </form>
                            </div>
                        </div>
                        <div class="col-6">
                            <h4 class="text-center mb-3">Tickets vendidos</h4>
                            <h5 class="text-center">
                                @foreach($cursosComprados as $curso)
                                    <p>{{ $curso['nombre'] }}: <b>{{ $curso['total'] }} personas</b> </p>
                                @endforeach

                            </h5>
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

                    <div class="card-header">

                        <div class="d-flex justify-content-between">

                            <h3 class="mb-3">Ordenes</h3>

                        </div>
                    </div>

                    @can('client-list')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
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
</script>

@endsection
