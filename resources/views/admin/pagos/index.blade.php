@extends('layouts.app_admin')

@section('template_title')
    Ordenes
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">

                            <h3 class="mb-3">Ordenes</h3>
                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>
                        </div>
                    </div>

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
                                                        Completado
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
