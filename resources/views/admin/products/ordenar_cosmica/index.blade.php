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

                    <h3 class="mb-3">Ordenes a laboratorio</h3>

                    <a type="button" class="btn btn-sm bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                        ¿Como fucniona?
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead-light">
                        <tr>
                            <th>Fecha de pedido</th>
                            <th>Estatus</th>
                            <th>Aciones</th>
                        </tr>
                    </thead>
                    @foreach ($ordenes as $orden)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($orden->fecha_pedido)->translatedFormat('d F Y h:i a') }}</td>
                            <td>{{ $orden->estatus }}</td>
                            <td>
                                <a class="btn btn-xs btn-success text-white" target="_blank" href="{{ route('productos_stock_cosmica.show', $orden->id) }}">
                                    <i class="fa fa-file"></i> Ver
                                </a>

                                <a class="btn btn-xs btn-danger text-white" target="_blank" href="{{ route('productos_stock_cosmica.imprimir', $orden->id) }}">
                                    <i class="fa fa-file"></i> Descargar PDF
                                </a>

                                <a class="btn btn-xs btn-warning text-white" target="_blank" href="{{ route('ordenes_cosmica.firma', $orden->id) }}">
                                    <i class="fa fa-file"></i> Liga para aprobar
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

          </div>
        </div>
      </div>
</div>
@endsection

@section('datatable')

@endsection
