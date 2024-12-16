@extends('layouts.app_admin')

@section('template_title')
    Pedidos Laboratorio cosmica
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <div class="d-flex justify-content-between">

                    <h3 class="mb-3">Pedidos Laboratorio cosmica</h3>

                    <a type="button" class="btn btn-sm bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                        ¿Como fucniona?
                    </a>
                </div>
            </div>

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                <li class="nav-item" role="presentation" style="margin-left: 1rem">
                  <button class="btn btn-success  active" id="pills-autorizados-tab" data-bs-toggle="pill" data-bs-target="#pills-autorizados" type="button" role="tab" aria-controls="pills-respuesta_lab" aria-selected="false">
                   Pedidos Autorizados
                  </button>
                </li>

                <li class="nav-item" role="presentation" style="margin-left: 1rem">
                    <button class="btn btn-danger text-white" id="pills-pendientes-tab" data-bs-toggle="pill" data-bs-target="#pills-pendientes" type="button" role="tab" aria-controls="pills-respuesta_lab" aria-selected="false">
                     Pendientes
                    </button>
                </li>

                <li class="nav-item" role="presentation" style="margin-left: 1rem">
                    <button class="btn btn-dark text-white  " id="pills-confirmados-tab" data-bs-toggle="pill" data-bs-target="#pills-confirmados" type="button" role="tab" aria-controls="pills-respuesta_lab" aria-selected="false">
                      Pedidos Confirmados
                    </button>
                </li>
            </ul>

              <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade show active" id="pills-autorizados" role="tabpanel" aria-labelledby="pills-autorizados-tab" tabindex="0">
                    <div class="table-responsive">
                        <table class="table table-flush" id="datatable-search">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha de pedido</th>
                                    <th>Estatus</th>
                                    <th>Aciones</th>
                                </tr>
                            </thead>
                            @foreach ($bodegaPedidoRealizado as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->fecha_pedido)->translatedFormat('d F Y h:i a') }}</td>
                                    <td>{{ $item->estatus_lab }}</td>
                                    <td>
                                        <a class="btn btn-xs btn-primary text-white" target="_blank" href="{{ route('productos_autorizado.show_cosmica', $item->id) }}">
                                            <i class="fa fa-file"></i> Ver Pedido
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade " id="pills-pendientes" role="tabpanel" aria-labelledby="pills-pendientes-tab" tabindex="0">
                    <div class="table-responsive">
                        <table class="table table-flush" id="datatable-search2">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha de pedido</th>
                                    <th>Estatus</th>
                                    <th>Aciones</th>
                                </tr>
                            </thead>
                            @foreach ($bodegaPedidoPendiente as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->fecha_pedido)->translatedFormat('d F Y h:i a') }}</td>
                                    <td>{{ $item->estatus_lab }}</td>
                                    <td>
                                        <a class="btn btn-xs btn-primary text-white" target="_blank" href="{{ route('productos_autorizado.show_cosmica', $item->id) }}">
                                            <i class="fa fa-file"></i> Ver Pedido
                                        </a>
                                        <a class="btn btn-xs btn-danger text-white" target="_blank" href="{{ route('productos_stock_cosmica.imprimir', $item->id) }}">
                                            <i class="fa fa-file"></i> Descargar PDF
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-confirmados" role="tabpanel" aria-labelledby="pills-confirmados-tab" tabindex="0">
                    <div class="table-responsive">
                        <table class="table table-flush" id="datatable-search3">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha de pedido</th>
                                    <th>Fecha de Confrimacion</th>
                                    <th>Estatus</th>
                                    <th>Aciones</th>
                                </tr>
                            </thead>
                            @foreach ($bodegaPedidoConfirmado as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->fecha_pedido)->translatedFormat('d F Y h:i a') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->fecha_aprovado_lab)->translatedFormat('d F Y h:i a') }}</td>
                                    <td>{{ $item->estatus_lab }}</td>
                                    <td>
                                        <a class="btn btn-xs btn-success text-white" target="_blank" href="{{ route('productos_stock_cosmica.show', $item->id) }}">
                                            <i class="fa fa-file"></i> Ver
                                        </a>

                                        @if ($item->estatus_lab != 'Realizado')
                                            <a class="btn btn-xs btn-danger text-white" target="_blank" href="{{ route('productos_stock_cosmica.imprimir', $item->id) }}">
                                                <i class="fa fa-file"></i> Descargar PDF
                                            </a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </table>
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

    const dataTableSearch3 = new simpleDatatables.DataTable("#datatable-search3", {
        deferRender:true,
        paging: true,
        pageLength: 10
    });
</script>

@endsection
