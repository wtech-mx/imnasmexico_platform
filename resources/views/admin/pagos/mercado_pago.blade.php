@extends('layouts.app_admin')

@section('template_title')
    Cursos
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">

                        <div class="d-flex justify-content-between">

                            <h3 class="mb-3">Mercado Pago</h3>

                        </div>
                    </div>

                    @can('client-list')
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search">
                                    <thead class="text-center">
                                        <tr class="tr_checkout">
                                          <th >Num. Pedido</th>
                                          <th>Correo</th>
                                          <th >Monto</th>
                                          <th >Curso</th>
                                          <th >Fecha</th>
                                        </tr>
                                      </thead>
                                    <tbody>
                                        @foreach ($pagos as $pago)
                                            <tr>
                                                <td>{{ $pago->id }}</td>
                                                @if ($pago->payer == null)
                                                    <td>/</td>
                                                @else
                                                    <td>{{$pago->payer->email}}</td>
                                                @endif
                                                <td>${{ $pago->transaction_amount }}</td>
                                                <td>{{ $pago->description }}</td>
                                                <td>{{ $pago->date_approved}}</td>

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