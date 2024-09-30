@extends('layouts.app_admin')

@section('template_title')
    Ordenes a laboratorio
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

                    <h3 class="mb-3">Ordenes a laboratorio NAS</h3>

                    <a type="button" class="btn btn-sm bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                        ¿Como fucniona?
                    </a>
                </div>
            </div>

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="btn btn-warning active" id="pills-pendiente-tab" data-bs-toggle="pill" data-bs-target="#pills-pendiente" type="button" role="tab" aria-controls="pills-pendiente" aria-selected="true">
                    Realizado
                  </button>
                </li>

                <li class="nav-item" role="presentation" style="margin-left: 1rem">
                  <button class="btn btn-success" id="pills-aprobado-tab" data-bs-toggle="pill" data-bs-target="#pills-aprobado" type="button" role="tab" aria-controls="pills-aprobado" aria-selected="false">
                    Aprobado
                  </button>
                </li>

                <li class="nav-item" role="presentation" style="margin-left: 1rem">
                  <button class="btn btn-primary  " id="pills-respuesta_lab-tab" data-bs-toggle="pill" data-bs-target="#pills-respuesta_lab" type="button" role="tab" aria-controls="pills-respuesta_lab" aria-selected="false">
                    Respuesta del laboratorio
                  </button>
                </li>

              </ul>

              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-pendiente" role="tabpanel" aria-labelledby="pills-pendiente-tab" tabindex="0">
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
                                    <td>{{ $item->estatus }}</td>
                                    <td>
                                        <a class="btn btn-xs btn-success text-white" target="_blank" href="{{ route('productos_stock.show', $item->id) }}">
                                            <i class="fa fa-file"></i> Ver
                                        </a>

                                        @if ($item->estatus != 'Realizado')
                                            <a class="btn btn-xs btn-danger text-white" target="_blank" href="{{ route('productos_stock.imprimir', $item->id) }}">
                                                <i class="fa fa-file"></i> Descargar PDF
                                            </a>
                                        @endif

                                        <a class="btn btn-xs btn-warning text-white" target="_blank" href="{{ route('ordenes_nas.firma', $item->id) }}">
                                            <i class="fa fa-file"></i> Liga para aprobar
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-aprobado" role="tabpanel" aria-labelledby="pills-aprobado-tab" tabindex="0">
                    <div class="table-responsive">
                        <table class="table table-flush" id="datatable-search2">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha de pedido</th>
                                    <th>Fecha de Aprovado</th>
                                    <th>Estatus</th>
                                    <th>Aciones</th>
                                </tr>
                            </thead>
                            @foreach ($bodegaPedidoAprobado as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->fecha_pedido)->translatedFormat('d F Y h:i a') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->fecha_aprovado)->translatedFormat('d F Y h:i a') }}</td>
                                    <td>{{ $item->estatus }}</td>
                                    <td>
                                        <a class="btn btn-xs btn-success text-white" target="_blank" href="{{ route('productos_stock.show', $item->id) }}">
                                            <i class="fa fa-file"></i> Ver
                                        </a>

                                        @if ($item->estatus != 'Realizado')
                                            <a class="btn btn-xs btn-danger text-white" target="_blank" href="{{ route('productos_stock.imprimir', $item->id) }}">
                                                <i class="fa fa-file"></i> Descargar PDF
                                            </a>
                                        @endif

                                        <a class="btn btn-xs btn-warning text-white" target="_blank" href="{{ route('ordenes_nas.firma', $item->id) }}">
                                            <i class="fa fa-file"></i> Liga Aprobada
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                    </div>

                </div>

                <div class="tab-pane fade" id="pills-respuesta_lab" role="tabpanel" aria-labelledby="pills-respuesta_lab-tab" tabindex="0">
                    <div class="table-responsive">
                        <table class="table table-flush" id="datatable-search3">
                            <thead class="thead-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha de pedido</th>
                                    <th>Fecha de confirmacion de Laboratorio</th>
                                    <th>Estatus</th>
                                    <th>Aciones</th>
                                </tr>
                            </thead>
                            @foreach ($bodegaPedidoConfirmado as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->fecha_pedido)->translatedFormat('d F Y h:i a') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->fecha_aprovado_lab)->translatedFormat('d F Y h:i a') }}</td>
                                    <td>{{ $item->estatus }}</td>
                                    <td>
                                        <a class="btn btn-xs btn-success text-white" target="_blank" href="{{ route('productos_stock.show', $item->id) }}">
                                            <i class="fa fa-file"></i> Ver Respuesta del Laboratorio
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
</script>

@endsection
