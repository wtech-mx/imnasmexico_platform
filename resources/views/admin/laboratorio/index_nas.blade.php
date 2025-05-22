@extends('layouts.app_admin')

@section('template_title')
    Pedidos Laboratorio NAS
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <div class="d-flex justify-content-between">

                    <h3 class="mb-3">Pedidos Laboratorio NAS</h3>

                    <a type="button" class="btn btn-sm bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                        ¿Como fucniona?
                    </a>
                </div>
            </div>

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                <li class="nav-item" role="presentation" style="margin-left: 1rem">
                  <button class="btn btn-dark  active" id="pills-autorizados-tab" data-bs-toggle="pill" data-bs-target="#pills-autorizados" type="button" role="tab" aria-controls="pills-respuesta_lab" aria-selected="false">
                   Pedidos
                  </button>
                </li>

                <li class="nav-item" role="presentation" style="margin-left: 1rem">
                    <button class="btn btn-info text-white" id="pills-pendientes-tab" data-bs-toggle="pill" data-bs-target="#pills-pendientes" type="button" role="tab" aria-controls="pills-respuesta_lab" aria-selected="false">
                     Pendientes
                    </button>
                </li>

                <li class="nav-item" role="presentation" style="margin-left: 1rem">
                    <button class="btn btn-secundary  " id="pills-confirmados-tab" data-bs-toggle="pill" data-bs-target="#pills-confirmados" type="button" role="tab" aria-controls="pills-respuesta_lab" aria-selected="false">
                      Pedidos Finalizados
                    </button>
                </li>

                <li class="nav-item" role="presentation" style="margin-left: 1rem">
                    <button class="btn btn-danger text-white" id="pills-cancelada-tab" data-bs-toggle="pill" data-bs-target="#pills-cancelada" type="button" role="tab" aria-controls="pills-respuesta_lab" aria-selected="false">
                     Cancelado
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
                                    <th>Dias retraso</th>
                                    <th>Estatus</th>
                                    <th>Aciones</th>
                                </tr>
                            </thead>
                            @foreach ($bodegaPedidoRealizado as $item)
                                @php
                                    $fechaAprobado = \Carbon\Carbon::parse($item->fecha_aprovado);
                                    $diasTranscurridos = $fechaAprobado->diffInDays(now());

                                    // Determinar la clase CSS según los días transcurridos
                                    if ($diasTranscurridos <= 3) {
                                        $claseFila = 'table-success'; // Verde
                                    } elseif ($diasTranscurridos <= 6) {
                                        $claseFila = 'table-warning'; // Amarillo
                                    } else {
                                        $claseFila = 'table-danger'; // Rojo
                                    }
                                @endphp
                                <tr class="{{ $claseFila }}">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $fechaAprobado->translatedFormat('d F Y h:i a') }}</td>
                                    <td>{{$diasTranscurridos}}</td>
                                    <td>{{ $item->estatus_lab }}</td>
                                    <td>
                                        <a class="btn btn-xs btn-primary text-white" target="_blank" href="{{ route('productos_autorizado.show', $item->id) }}">
                                            <i class="fa fa-file"></i> Ver Pedido
                                        </a>
                                        {{-- <a type="button" class="btn btn-sm bg-danger text-white" data-bs-toggle="modal" data-bs-target="#ordenes_lab_update_finalizar{{ $item->id }}">
                                            <i class="fa fa-file"></i> Comentario
                                        </a> --}}
                                        <a class="btn btn-xs btn-danger text-white" target="_blank" href="{{ route('productos_stock.imprimir', $item->id) }}">
                                            <i class="fa fa-file"></i> Descargar PDF
                                        </a>

                                        <a class="text-center text-white btn btn-sm"
                                            href="{{ route('pdf_etiqueta.bodega', ['tabla' => 'bodega_pedidos', 'id' => $item->id]) }}"
                                            style="background: #7d2de6;">
                                            <i class="fa fa-qrcode"></i>
                                        </a>

                                    </td>
                                </tr>
                                @include('admin.laboratorio.modal_finalizar')
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
                                    <th>Dias retraso</th>
                                    <th>Estatus</th>
                                    <th>Aciones</th>
                                </tr>
                            </thead>
                            @foreach ($bodegaPedidoPendiente as $item)
                                @php
                                    $fechaAprobado = \Carbon\Carbon::parse($item->fecha_aprovado);
                                    $diasTranscurridos = $fechaAprobado->diffInDays(now());

                                    // Determinar la clase CSS según los días transcurridos
                                    if ($diasTranscurridos <= 3) {
                                        $claseFila = 'table-success'; // Verde
                                    } elseif ($diasTranscurridos <= 6) {
                                        $claseFila = 'table-warning'; // Amarillo
                                    } else {
                                        $claseFila = 'table-danger'; // Rojo
                                    }
                                @endphp
                                <tr class="{{ $claseFila }}">
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $fechaAprobado->translatedFormat('d F Y h:i a') }}</td>
                                    <td>{{$diasTranscurridos}}</td>
                                    <td>{{ $item->estatus_lab }}</td>
                                    <td>
                                        <a class="btn btn-xs btn-primary text-white" target="_blank" href="{{ route('productos_autorizado.show', $item->id) }}">
                                            <i class="fa fa-file"></i> Ver Pedido
                                        </a>
                                        {{-- <a type="button" class="btn btn-sm bg-danger text-white" data-bs-toggle="modal" data-bs-target="#ordenes_lab_update_finalizar{{ $item->id }}">
                                            <i class="fa fa-file"></i> Comentario
                                        </a> --}}

                                        <a class="btn btn-xs btn-danger text-white" target="_blank" href="{{ route('productos_stock.imprimir', $item->id) }}">
                                            <i class="fa fa-file"></i> Descargar PDF
                                        </a>

                                        <a class="text-center text-white btn btn-sm"
                                            href="{{ route('pdf_etiqueta.bodega', ['tabla' => 'bodega_pedidos', 'id' => $item->id]) }}"
                                            style="background: #7d2de6;">
                                            <i class="fa fa-qrcode"></i>
                                        </a>

                                    </td>
                                </tr>
                                @include('admin.laboratorio.modal_finalizar')
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
                                        <a class="btn btn-xs btn-success text-white" target="_blank" href="{{ route('productos_stock.show', $item->id) }}">
                                            <i class="fa fa-file"></i> Ver
                                        </a>

                                        @if ($item->estatus != 'Realizado')
                                            <a class="btn btn-xs btn-danger text-white" target="_blank" href="{{ route('productos_stock.imprimir', $item->id) }}">
                                                <i class="fa fa-file"></i> Descargar PDF
                                            </a>
                                        @endif

                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-cancelada" role="tabpanel" aria-labelledby="pills-cancelada-tab" tabindex="0">
                    <div class="table-responsive">
                        <table class="table table-flush" id="datatable-search6">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha de pedido</th>
                                    <th>Estatus</th>
                                    <th>Aciones</th>
                                </tr>
                            </thead>
                            @foreach ($bodegaPedidoCancelado as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->fecha_pedido)->translatedFormat('d F Y h:i a') }}</td>
                                    <td>{{ $item->estatus_lab }}</td>
                                    <td>
                                        <a class="btn btn-xs btn-success text-white" target="_blank" href="{{ route('productos_stock.show', $item->id) }}">
                                            <i class="fa fa-file"></i> Ver
                                        </a>

                                        @if ($item->estatus != 'Realizado')
                                            <a class="btn btn-xs btn-danger text-white" target="_blank" href="{{ route('productos_stock.imprimir', $item->id) }}">
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

    const dataTableSearch6 = new simpleDatatables.DataTable("#datatable-search6", {
        deferRender:true,
        paging: true,
        pageLength: 10
    });
</script>

@endsection
