@extends('layouts.app_admin')

@section('template_title')
    Notas Cotizacion
@endsection

@section('css')
 <!-- Select2  -->
 <link rel="stylesheet" href="{{asset('assets/admin/vendor/select2/dist/css/select2.min.css')}}">
 @endsection

@php
    $fecha = date('Y-m-d');
@endphp
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h2 class="mb-3">Notas Cotizacion Busqueda NAS</h2>

                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>

                            @can('nota-productos-crear')
                                <a class="btn btn-sm btn-success" href="{{ route('notas_cotizacion.create') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff; font-size: 20px;">
                                    <i class="fa fa-fw fa-edit"></i> Crear
                                </a>
                            @endcan
                        </div>
                    </div>

                    <div class="card">
                        @include('admin.cotizacion.filtro')

                    </div>

                    <div class="card-body">
                        <div class="table-responsive">

                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-Cotizacion-tab" data-bs-toggle="tab" data-bs-target="#nav-Cotizacion" type="button" role="tab" aria-controls="nav-Cotizacion" aria-selected="false" >
                                        Cotizacion <img src="{{ asset('assets/cam/comprobante.png') }}" alt="" width="35px">
                                    </button>

                                    <button class="nav-link" id="nav-Aprobada-tab" data-bs-toggle="tab" data-bs-target="#nav-Aprobada" type="button" role="tab" aria-controls="nav-Aprobada" aria-selected="false">
                                        Aprobada <img src="{{ asset('assets/cam/cheque.png') }}" alt="" width="35px">
                                    </button>

                                    <button class="nav-link" id="nav-Cancelada-tab" data-bs-toggle="tab" data-bs-target="#nav-Cancelada" type="button" role="tab" aria-controls="nav-Cancelada" aria-selected="false">
                                        Cancelada <img src="{{ asset('assets/cam/cerrar.png') }}" alt="" width="35px">
                                    </button>
                                </div>
                              </nav>

                              <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-Cotizacion" role="tabpanel" aria-labelledby="nav-Cotizacion-tab" tabindex="0">
                                    <table class="table table-flush" id="datatable-search4">
                                        <thead class="thead">
                                            <tr>
                                                <th>No</th>
                                                <th>Cliente</th>
                                                <th>Estatus</th>
                                                <th>fecha</th>
                                                <th>Total</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($notas as $item)
                                                <tr>
                                                    <td>
                                                        <h5>
                                                            @if ($item->folio == null)
                                                                {{ $item->id }}
                                                            @else
                                                                {{ $item->folio }}
                                                            @endif
                                                        </h5>
                                                    </td>
                                                    <td>
                                                        <h5>
                                                            @if ($item->id_usuario == NULL)
                                                                {{ $item->nombre }} <br> {{ $item->telefono }}
                                                            @else
                                                                {{ $item->User->name }}
                                                            @endif
                                                        </h5>
                                                    </td>

                                                    <td>
                                                        @if($item->estatus_cotizacion == null)
                                                            <a type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                                Cotizacion
                                                            </a>
                                                        @elseif($item->estatus_cotizacion == 'Pendiente')
                                                            <a type="button" class="btn btn-xs btn-warning" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                                Pendiene
                                                            </a>
                                                        @elseif($item->estatus_cotizacion == 'Aprobada')
                                                            <a type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                                Aprobada
                                                            </a>
                                                        @elseif($item->estatus_cotizacion == 'Cancelada')
                                                            <a type="button" class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                                Cencelada
                                                            </a>
                                                        @endif


                                                    </td>

                                                    <td>
                                                        @php
                                                        $fecha = $item->fecha;
                                                        $fecha_timestamp = strtotime($fecha);
                                                        $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                                        @endphp
                                                        <h5>
                                                            {{$fecha_formateada}}
                                                        </h5>
                                                    </td>
                                                    <td><h5>${{ $item->total }}</h5></td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('notas_cotizacion.imprimir', ['id' => $item->id]) }}">
                                                            <i class="fa fa-file"></i>
                                                        </a>
                                                        @php
                                                            $total = 0;$totalCantidad = 0;
                                                        @endphp
                                                        @can('nota-productos-whats')
                                                            @if ($item->tipo_item == 'Venta Presencial')
                                                                <a class="btn btn-sm btn-success text-white" target="_blank" href="https://api.whatsapp.com/send?phone={{ $item->id_usuario ? $item->User->telefono : $item->telefono }}&text=Venta%20presencial%0A--------------------------------%0A%0ANumero%20de%20Orden%20%20%20%20%3A%20%20{{ $item->id }}%0AFecha%20%20%20%20%20%20%20%20%20%20%20%20%3A%20%20{{ $fecha_formateada }}%0A%0ADetalles%20de%20la%20Orden%3A%0A@php $total = 0; foreach ($item->ProductosNotasId as $productos) { echo $productos->producto . "%20$" . number_format($productos->price, 2, '.', ',') . "%20%20x%20" . $productos->cantidad . "%0A";} @endphp--------------------------------%0A%0ADetalles%3A%20%0ASubtotal%3A%20${{ $total_formateado = number_format($item->tipo, 2, '.', ',') }}{{ $item->restante > 0 ? '%0A Descuento: '. $item->restante .'%' : '' }}{{ $item->envio == 'Si' ? '%0A Envío: $250' : '' }}{{ $item->factura == 1 ? '%0A Factura: 16% ' : '' }}%0ATotal%3A%20${{ $total_formateado = number_format($item->total, 2, '.', ',') }}%0A">
                                                                        <i class="fa fa-whatsapp"></i>
                                                                </a>
                                                            @else
                                                            <a class="btn btn-sm btn-success text-white" target="_blank" href="https://api.whatsapp.com/send?phone={{ $item->id_usuario ? $item->User->telefono : $item->telefono }}&text=Cotizacion%20NAS%0A--------------------------------%0A%0ANumero%20de%20Cotizacion%20%20%20%20%3A%20%20{{ $item->id }}%0AFecha%20%20%20%20%20%20%20%20%20%20%20%20%3A%20%20{{ $fecha_formateada }}%0A%0ADetalles%20de%20la%20Orden%3A%0A@php $total = 0; foreach ($item->ProductosNotasId as $productos) { echo $productos->producto . "%20$" . $productos->price . "%20%20x%20" . $productos->cantidad . "%0A";} @endphp--------------------------------%0A%0ADetalles%3A%20%0ASubtotal%3A%20${{ $total_formateado = number_format($item->tipo, 2, '.', ',') }}{{ $item->restante > 0 ? '%0A Descuento: '. $item->restante .'%' : '' }}{{ $item->envio == 'Si' ? '%0A Envío: $250' : '' }}{{ $item->factura == 1 ? '%0A Factura: 16%' : '' }}%0ATotal%3A%20${{ $total_formateado = number_format($item->total, 2, '.', ',') }}%0A">
                                                                <i class="fa fa-whatsapp"></i>
                                                            </a>
                                                            @endif
                                                        @endcan
                                                        @can('nota-productos-editar')
                                                            <a class="btn btn-sm btn-warning" href="{{ route('notas_cotizacion.edit', $item->id) }}">
                                                                <i class="fa fa-fw fa-edit"></i>
                                                            </a>
                                                        @endcan
                                                        {{-- <form action="{{ route('notas_cotizacion.eliminar', ['id' => $item->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta nota?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                        </form> --}}

                                                    </td>
                                                </tr>
                                                @include('admin.cotizacion.modal_estatus')
                                                @include('admin.cotizacion.modal_products')
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="nav-Aprobada" role="tabpanel" aria-labelledby="nav-Aprobada-tab" tabindex="0">
                                    <table class="table table-flush" id="datatable-search2">
                                        <thead class="thead">
                                            <tr>
                                                <th>No</th>
                                                <th>Cliente</th>
                                                <th>Estatus</th>
                                                <th>fecha</th>
                                                <th>Total</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($notasAprobadas as $item)
                                                <tr>
                                                    <td>
                                                        <h5>
                                                            @if ($item->folio == null)
                                                                {{ $item->id }}
                                                            @else
                                                                {{ $item->folio }}
                                                            @endif
                                                        </h5>
                                                    </td>
                                                    <td>
                                                        <h5>
                                                            @if ($item->id_usuario == NULL)
                                                                {{ $item->nombre }} <br> {{ $item->telefono }}
                                                            @else
                                                                {{ $item->User->name }}
                                                            @endif
                                                            <br>  {{ $item->estadociudad }}
                                                        </h5>
                                                    </td>

                                                    <td>
                                                        @if($item->estatus_cotizacion == null)
                                                            <a type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                                Cotizacion
                                                            </a>
                                                        @elseif($item->estatus_cotizacion == 'Pendiente')
                                                            <a type="button" class="btn btn-xs btn-warning" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                                Pendiene
                                                            </a>
                                                        @elseif($item->estatus_cotizacion == 'Aprobada')
                                                            <a type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                                Aprobada
                                                            </a>
                                                        @elseif($item->estatus_cotizacion == 'Cancelada')
                                                            <a type="button" class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                                Cencelada
                                                            </a>
                                                        @endif


                                                    </td>

                                                    <td>
                                                        @php
                                                        $fecha = $item->fecha;
                                                        $fecha_timestamp = strtotime($fecha);
                                                        $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                                        @endphp
                                                        <h5>
                                                            {{$item->fecha_preparacion}}
                                                        </h5>
                                                    </td>
                                                    <td><h5>${{ $item->total }}</h5></td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('notas_cotizacion.imprimir', ['id' => $item->id]) }}">
                                                            <i class="fa fa-file"></i>
                                                        </a>
                                                        @php
                                                            $total = 0;$totalCantidad = 0;
                                                        @endphp
                                                        @can('nota-productos-whats')
                                                            @if ($item->tipo_nota == 'Venta Presencial')
                                                                <a class="btn btn-sm btn-success text-white" target="_blank" href="https://api.whatsapp.com/send?phone={{ $item->id_usuario ? $item->User->telefono : $item->telefono }}&text=Venta%20presencial%0A--------------------------------%0A%0ANumero%20de%20Orden%20%20%20%20%3A%20%20{{ $item->id }}%0AFecha%20%20%20%20%20%20%20%20%20%20%20%20%3A%20%20{{ $fecha_formateada }}%0A%0ADetalles%20de%20la%20Orden%3A%0A@php $total = 0; foreach ($item->ProductosNotasId as $productos) { echo $productos->producto . "%20$" . number_format($productos->price, 2, '.', ',') . "%20%20x%20" . $productos->cantidad . "%0A";} @endphp--------------------------------%0A%0ADetalles%3A%20%0ASubtotal%3A%20${{ $total_formateado = number_format($item->tipo, 2, '.', ',') }}{{ $item->restante > 0 ? '%0A Descuento: '. $item->restante .'%' : '' }}{{ $item->envio == 'Si' ? '%0A Envío: $250' : '' }}{{ $item->factura == 1 ? '%0A Factura: 16% ' : '' }}%0ATotal%3A%20${{ $total_formateado = number_format($item->total, 2, '.', ',') }}%0A">
                                                                        <i class="fa fa-whatsapp"></i>
                                                                </a>
                                                            @else
                                                            <a class="btn btn-sm btn-success text-white" target="_blank" href="https://api.whatsapp.com/send?phone={{ $item->id_usuario ? $item->User->telefono : $item->telefono }}&text=Cotizacion%20NAS%0A--------------------------------%0A%0ANumero%20de%20Cotizacion%20%20%20%20%3A%20%20{{ $item->id }}%0AFecha%20%20%20%20%20%20%20%20%20%20%20%20%3A%20%20{{ $fecha_formateada }}%0A%0ADetalles%20de%20la%20Orden%3A%0A@php $total = 0; foreach ($item->ProductosNotasId as $productos) { echo $productos->producto . "%20$" . number_format($productos->price, 2, '.', ',') . "%20%20x%20" . $productos->cantidad . "%0A";} @endphp--------------------------------%0A%0ADetalles%3A%20%0ASubtotal%3A%20${{ $total_formateado = number_format($item->tipo, 2, '.', ',') }}{{ $item->restante > 0 ? '%0A Descuento: '. $item->restante .'%' : '' }}{{ $item->envio == 'Si' ? '%0A Envío: $250' : '' }}{{ $item->factura == 1 ? '%0A Factura: 16%' : '' }}%0ATotal%3A%20${{ $total_formateado = number_format($item->total, 2, '.', ',') }}%0A">
                                                                <i class="fa fa-whatsapp"></i>
                                                            </a>
                                                            @endif
                                                        @endcan
                                                        @can('nota-productos-editar')
                                                            <a class="btn btn-sm btn-warning" href="{{ route('notas_cotizacion.edit', $item->id) }}">
                                                                <i class="fa fa-fw fa-edit"></i>
                                                            </a>
                                                        @endcan
                                                        {{-- <form action="{{ route('notas_cotizacion.eliminar', ['id' => $item->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta nota?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                        </form> --}}

                                                        <a type="button" class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#guiaModal{{$item->id}}" style="background: #e6ab2d; color: #ffff">
                                                            <i class="fa fa-truck"></i>
                                                        </a>

                                                        <a type="button" class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#pagoModal{{$item->id}}" style="background: #2d6ee6; color: #ffff">
                                                            <i class="fa fa-credit-card-alt"></i>
                                                        </a>

                                                    </td>
                                                </tr>
                                                @include('admin.cotizacion.guia')
                                                @include('admin.cotizacion.modal_pago')
                                                @include('admin.cotizacion.modal_estatus')
                                                @include('admin.cotizacion.modal_products')
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="nav-Cancelada" role="tabpanel" aria-labelledby="nav-Cancelada-tab" tabindex="0">
                                    <table class="table table-flush" id="datatable-search3">
                                        <thead class="thead">
                                            <tr>
                                                <th>No</th>
                                                <th>Cliente</th>
                                                <th>Estatus</th>
                                                <th>fecha</th>
                                                <th>Total</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($notasCandeladas as $item)
                                                <tr>
                                                    <td>
                                                        <h5>
                                                            @if ($item->folio == null)
                                                                {{ $item->id }}
                                                            @else
                                                                {{ $item->folio }}
                                                            @endif
                                                        </h5>
                                                    </td>
                                                    <td>
                                                        <h5>
                                                            @if ($item->id_usuario == NULL)
                                                                {{ $item->nombre }} <br> {{ $item->telefono }}
                                                            @else
                                                                {{ $item->User->name }}
                                                            @endif
                                                        </h5>
                                                    </td>

                                                    <td>
                                                        @if($item->estatus_cotizacion == null)
                                                            <a type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                                Cotizacion
                                                            </a>
                                                        @elseif($item->estatus_cotizacion == 'Pendiente')
                                                            <a type="button" class="btn btn-xs btn-warning" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                                Pendiene
                                                            </a>
                                                        @elseif($item->estatus_cotizacion == 'Aprobada')
                                                            <a type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                                Aprobada
                                                            </a>
                                                        @elseif($item->estatus_cotizacion == 'Cancelada')
                                                            <a type="button" class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                                Cencelada
                                                            </a>
                                                        @endif


                                                    </td>

                                                    <td>
                                                        @php
                                                        $fecha = $item->fecha;
                                                        $fecha_timestamp = strtotime($fecha);
                                                        $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                                        @endphp
                                                        <h5>
                                                            {{$fecha_formateada}}
                                                        </h5>
                                                    </td>
                                                    <td><h5>${{ $item->total }}</h5></td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('notas_cotizacion.imprimir', ['id' => $item->id]) }}">
                                                            <i class="fa fa-file"></i>
                                                        </a>
                                                        @php
                                                            $total = 0;$totalCantidad = 0;
                                                        @endphp
                                                        @can('nota-productos-whats')
                                                            @if ($item->tipo_item == 'Venta Presencial')
                                                                <a class="btn btn-sm btn-success text-white" target="_blank" href="https://api.whatsapp.com/send?phone={{ $item->id_usuario ? $item->User->telefono : $item->telefono }}&text=Venta%20presencial%0A--------------------------------%0A%0ANumero%20de%20Orden%20%20%20%20%3A%20%20{{ $item->id }}%0AFecha%20%20%20%20%20%20%20%20%20%20%20%20%3A%20%20{{ $fecha_formateada }}%0A%0ADetalles%20de%20la%20Orden%3A%0A@php $total = 0; foreach ($item->ProductosNotasId as $productos) { echo $productos->producto . "%20$" . number_format($productos->price, 2, '.', ',') . "%20%20x%20" . $productos->cantidad . "%0A";} @endphp--------------------------------%0A%0ADetalles%3A%20%0ASubtotal%3A%20${{ $total_formateado = number_format($item->tipo, 2, '.', ',') }}{{ $item->restante > 0 ? '%0A Descuento: '. $item->restante .'%' : '' }}{{ $item->envio == 'Si' ? '%0A Envío: $250' : '' }}{{ $item->factura == 1 ? '%0A Factura: 16% ' : '' }}%0ATotal%3A%20${{ $total_formateado = number_format($item->total, 2, '.', ',') }}%0A">
                                                                        <i class="fa fa-whatsapp"></i>
                                                                </a>
                                                            @else
                                                            {{-- <a class="btn btn-sm btn-success text-white" target="_blank" href="https://api.whatsapp.com/send?phone={{ $item->id_usuario ? $item->User->telefono : $item->telefono }}&text=Cotizacion%20NAS%0A--------------------------------%0A%0ANumero%20de%20Cotizacion%20%20%20%20%3A%20%20{{ $item->id }}%0AFecha%20%20%20%20%20%20%20%20%20%20%20%20%3A%20%20{{ $fecha_formateada }}%0A%0ADetalles%20de%20la%20Orden%3A%0A@php $total = 0; foreach ($item->ProductosNotasId as $productos) { echo $productos->producto . "%20$" . number_format($productos->price, 2, '.', ',') . "%20%20x%20" . $productos->cantidad . "%0A";} @endphp--------------------------------%0A%0ADetalles%3A%20%0ASubtotal%3A%20${{ $total_formateado = number_format($item->tipo, 2, '.', ',') }}{{ $item->restante > 0 ? '%0A Descuento: '. $item->restante .'%' : '' }}{{ $item->envio == 'Si' ? '%0A Envío: $250' : '' }}{{ $item->factura == 1 ? '%0A Factura: 16%' : '' }}%0ATotal%3A%20${{ $total_formateado = number_format($item->total, 2, '.', ',') }}%0A">
                                                                <i class="fa fa-whatsapp"></i>
                                                            </a> --}}

                                                            <a class="btn btn-sm btn-success text-white" target="_blank" href="https://api.whatsapp.com/send?phone={{ $item->id_usuario ? $item->User->telefono : $item->telefono }}&text=Cotizacion%20NAS%0A--------------------------------%0A%0ANumero%20de%20Cotizacion%20%20%20%20%3A%20%20{{ $item->id }}%0AFecha%20%20%20%20%20%20%20%20%20%20%20%20%3A%20%20{{ $fecha_formateada }}%0A%0ADetalles%20de%20la%20Orden%3A%0A@php
    $total = 0;
    foreach ($item->ProductosNotasId as $productos) {
        echo $productos->producto . "%20$" .
            (is_numeric($productos->price) ? number_format($productos->price, 2, '.', ',') : '0.00') .
            "%20%20x%20" . $productos->cantidad . "%0A";
    }
@endphp
--------------------------------%0A%0ADetalles%3A%20%0ASubtotal%3A%20${{ is_numeric($item->tipo) ? number_format($item->tipo, 2, '.', ',') : '0.00' }}{{ $item->restante > 0 ? '%0A Descuento: '. $item->restante .'%' : '' }}{{ $item->envio == 'Si' ? '%0A Envío: $250' : '' }}{{ $item->factura == 1 ? '%0A Factura: 16%' : '' }}%0ATotal%3A%20${{ is_numeric($item->total) ? number_format($item->total, 2, '.', ',') : '0.00' }}%0A">
    <i class="fa fa-whatsapp"></i>
</a>


                                                            @endif
                                                        @endcan
                                                        @can('nota-productos-editar')
                                                            <a class="btn btn-sm btn-warning" href="{{ route('notas_cotizacion.edit', $item->id) }}">
                                                                <i class="fa fa-fw fa-edit"></i>
                                                            </a>
                                                        @endcan
                                                        {{-- <form action="{{ route('notas_cotizacion.eliminar', ['id' => $item->id]) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta nota?')"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                        </form> --}}

                                                    </td>
                                                </tr>
                                                @include('admin.cotizacion.modal_estatus')
                                                @include('admin.cotizacion.modal_products')
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

<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>


<script type="text/javascript">

    $(document).ready(function() {
        $('.cliente').select2();
        $('.phone').select2();
        $('.administradores').select2();
    });

    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search4", {
        searchable: true,
        fixedHeight: false
    });

    const dataTableSearch2 = new simpleDatatables.DataTable("#datatable-search2", {
        searchable: true,
        fixedHeight: false
    });

    const dataTableSearch3 = new simpleDatatables.DataTable("#datatable-search3", {
        searchable: true,
        fixedHeight: false
    });

</script>

@endsection

