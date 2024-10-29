@extends('layouts.app_admin')

@section('template_title')
    Bodega
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h2 class="mb-3">Notas ventas del Mes</h2>

                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mt-3">
                            <div class="d-flex justify-content-around">
                                <span class="badge rounded-pill text-dark" style="background: #F5ECE4">NAS Tienda Online</span>
                                <span class="badge rounded-pill text-white" style="background: #6ec7d1a3">NAS Tiendita</span>
                                <span class="badge rounded-pill text-white" style="background: #836262a3">NAS Cotizaciones Aprobadas</span>
                                <span class="badge rounded-pill text-white" style="background: #D486D6">Cosmica Cotizaciones Aprobadas</span>
                                <span class="badge rounded-pill text-white" style="background: #80486B">Cosmica Tienda Online</span>
                                <span class="badge rounded-pill text-white" style="background: #EE96BA">Paradisus</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">

                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-Cotizacion-tab" data-bs-toggle="tab" data-bs-target="#nav-Cotizacion" type="button" role="tab" aria-controls="nav-Cotizacion" aria-selected="false" >
                                        En preparación <img src="{{ asset('assets/cam/box.png') }}" alt="" width="35px">
                                    </button>

                                    <button class="nav-link" id="nav-Aprobada-tab" data-bs-toggle="tab" data-bs-target="#nav-Aprobada" type="button" role="tab" aria-controls="nav-Aprobada" aria-selected="false">
                                        Preparados <img src="{{ asset('assets/cam/package.png') }}" alt="" width="35px">
                                    </button>

                                    <button class="nav-link" id="nav-Cancelada-tab" data-bs-toggle="tab" data-bs-target="#nav-Cancelada" type="button" role="tab" aria-controls="nav-Cancelada" aria-selected="false">
                                        Enviados <img src="{{ asset('assets/cam/delivery.png') }}" alt="" width="35px">
                                    </button>

                                    <button class="nav-link" id="nav-entregado-tab" data-bs-toggle="tab" data-bs-target="#nav-entregado" type="button" role="tab" aria-controls="nav-entregado" aria-selected="false">
                                        Entregados <img src="{{ asset('assets/cam/delivery.png') }}" alt="" width="35px">
                                    </button>

                                    <button class="nav-link" id="nav-cancelada-tab" data-bs-toggle="tab" data-bs-target="#nav-cancelada" type="button" role="tab" aria-controls="nav-cancelada" aria-selected="false">
                                        Canceladas <img src="{{ asset('assets/cam/cerrar.png') }}" alt="" width="35px">
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
                                                <th>fecha Aprobada</th>
                                                <th>Total</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($notas_presencial_preparacion as $item)
                                                <tr style="background: #6ec7d1a3">
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
                                                        <a type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                            En preparación
                                                        </a><br>
                                                        Pedido Tiendita
                                                    </td>

                                                    <td>
                                                        <h5>
                                                            {{ \Carbon\Carbon::parse($item->fecha_preparacion)->isoFormat('dddd DD MMMM hh:mm a') }}
                                                        </h5>
                                                    </td>
                                                    <td><h5>${{ $item->total }}</h5></td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('notas_cotizacion.imprimir', ['id' => $item->id]) }}">
                                                            <i class="fa fa-list-alt"></i>
                                                        </a>

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusFechasModal{{$item->id}}">
                                                            <i class="fa fa-info"></i>
                                                        </a>

                                                        <a class="btn btn-sm btn-dark text-white" target="_blank" href="{{ route('preparacion_scaner.bodega', $item->id) }}">
                                                            <i class="fa fa-barcode"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                @include('admin.bodega.modal_estatus')
                                                @include('admin.bodega.modal_fechas')
                                            @endforeach

                                            @foreach ($notas_preparacion as $item)
                                                <tr style="background: #836262a3">
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
                                                        <a type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                            En preparación
                                                        </a><br>
                                                        NAS Cotizaciones Aprobadas
                                                    </td>

                                                    <td>
                                                        <h5>
                                                            {{ \Carbon\Carbon::parse($item->fecha_preparacion)->isoFormat('dddd DD MMMM hh:mm a') }}
                                                        </h5>
                                                    </td>
                                                    <td><h5>${{ $item->total }}</h5></td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('notas_cotizacion.imprimir', ['id' => $item->id]) }}">
                                                            <i class="fa fa-list-alt"></i>
                                                        </a>

                                                        @if ($item->metodo_pago == 'Contra Entrega')
                                                            <a type="button" class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#guiaModal{{$item->id}}" style="background: #e6ab2d; color: #ffff">
                                                                <i class="fa fa-truck"></i>
                                                            </a>
                                                        @else
                                                            <a class="text-center text-white btn btn-sm" href="{{asset('pago_fuera/'.$item->doc_guia) }}" download="{{asset('pago_fuera/'.$item->doc_guia) }}" style="background: #e6ab2d;">
                                                                <i class="fa fa-truck"></i>
                                                            </a>
                                                        @endif

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusFechasModal{{$item->id}}">
                                                            <i class="fa fa-info"></i>
                                                        </a>

                                                        <a class="btn btn-sm btn-dark text-white" target="_blank" href="{{ route('preparacion_scaner.bodega', $item->id) }}">
                                                            <i class="fa fa-barcode"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                @include('admin.cotizacion.guia')
                                                @include('admin.bodega.modal_estatus')
                                                @include('admin.bodega.modal_fechas')
                                            @endforeach

                                            @foreach ($notas_cosmica_preparacion as $item)
                                                <tr style="background: #d486d6">
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
                                                        <a type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                            En preparación
                                                        </a>
                                                    </td>

                                                    <td>
                                                        <h5>
                                                            {{ \Carbon\Carbon::parse($item->fecha_preparacion)->isoFormat('dddd DD MMMM hh:mm a') }}
                                                        </h5>
                                                    </td>
                                                    <td><h5>${{ $item->total }}</h5></td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('cotizacion_cosmica.imprimir', ['id' => $item->id]) }}">
                                                            <i class="fa fa-list-alt"></i>
                                                        </a>

                                                        @if ($item->metodo_pago == 'Contra Entrega')
                                                            <a type="button" class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#guiaModal{{$item->id}}" style="background: #e6ab2d; color: #ffff">
                                                                <i class="fa fa-truck"></i>
                                                            </a>
                                                        @else
                                                            <a class="text-center text-white btn btn-sm" href="{{asset('pago_fuera/'.$item->doc_guia) }}" download="{{asset('pago_fuera/'.$item->doc_guia) }}" style="background: #e6ab2d;">
                                                                <i class="fa fa-truck"></i>
                                                            </a>
                                                        @endif

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusFechasModal{{$item->id}}">
                                                            <i class="fa fa-info"></i>
                                                        </a>

                                                        <a class="btn btn-sm btn-dark text-white" target="_blank" href="{{ route('preparacion_scaner_cosmica.bodega', $item->id) }}">
                                                            <i class="fa fa-barcode"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @include('admin.cotizacion.guia')
                                                @include('admin.bodega.modal_cosmica_estatus')
                                                @include('admin.bodega.modal_fechas')
                                            @endforeach

                                            @foreach($orders_tienda_principal as $order)
                                                <tr style="background: #F5ECE4">
                                                    <td>{{ $order->id }}</td>
                                                    <td>{{ $order->billing->first_name . ' ' . $order->billing->last_name }}</td>
                                                    <td>
                                                        <a type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#estatus_edit_modal_woo{{$order->id}}">
                                                            En preparación
                                                        </a>
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($order->date_created)->format('d-m-Y') }}</td>
                                                    <td>${{ $order->total }}</td>
                                                    <td>
                                                        <a type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#modal_productos_{{ $order->id }}">
                                                            <i class="fa fa-list-alt"></i>
                                                        </a>

                                                        @if(isset($order->meta_data))
                                                            @foreach($order->meta_data as $meta)
                                                                @if($meta->key == 'guia_de_envio')

                                                                <a class="text-center text-white btn btn-sm" href="{{asset('guias/'.$meta->value) }}" download="{{asset('guias/'.$meta->value) }}" style="background: #e6ab2d;">
                                                                    <i class="fa fa-truck"></i>
                                                                </a>

                                                                @endif
                                                            @endforeach
                                                        @endif

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusModal_woo_{{$order->id}}">
                                                            <i class="fa fa-info"></i>
                                                        </a>

                                                        <a class="btn btn-sm btn-dark text-white" target="_blank" href="{{ route('preparacion_scaner_nas.bodega', $order->id) }}">
                                                            <i class="fa fa-barcode"></i>
                                                        </a>

                                                    </td>
                                                </tr>

                                                @include('admin.bodega.modal_productos')
                                                @include('admin.bodega.modal_edit_estatus_woo')
                                                @include('admin.bodega.modal_estatus_woo')

                                            @endforeach

                                            @foreach($orders_tienda_cosmica as $order)
                                                <tr style="background: #80486B;color:#fff">
                                                    <td>{{ $order->id }}</td>
                                                    <td>{{ $order->billing->first_name . ' ' . $order->billing->last_name }}</td>
                                                    <td>
                                                        <a type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#estatus_edit_modal_woo{{$order->id}}">
                                                            En preparación
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @foreach($order->meta_data as $meta)
                                                            @if($meta->key == 'fecha_y_hora_guia')
                                                                {{ \Carbon\Carbon::parse($meta->value)->isoFormat('dddd DD MMMM hh:mm a') }}
                                                            @endif
                                                        @endforeach

                                                    </td>
                                                    <td>${{ $order->total }}</td>
                                                    <td>
                                                        <a type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#modal_productos_{{ $order->id }}">
                                                            <i class="fa fa-list-alt"></i>
                                                        </a>

                                                        @if(isset($order->meta_data))
                                                            @foreach($order->meta_data as $meta)
                                                                @if($meta->key == 'guia_de_envio')

                                                                <a class="text-center text-white btn btn-sm" href="{{asset('guias/'.$meta->value) }}" download="{{asset('guias/'.$meta->value) }}" style="background: #e6ab2d;">
                                                                    <i class="fa fa-truck"></i>
                                                                </a>

                                                                @endif
                                                            @endforeach
                                                        @endif

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusModal_woo_{{$order->id}}">
                                                            <i class="fa fa-info"></i>
                                                        </a>

                                                        <a class="btn btn-sm btn-dark text-white" target="_blank" href="{{ route('preparacion_scaner_cosmica_online.bodega', $order->id) }}">
                                                            <i class="fa fa-barcode"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                @include('admin.bodega.modal_productos')
                                                @include('admin.bodega.modal_edit_estatus_woo')
                                                @include('admin.bodega.modal_estatus_woo')

                                            @endforeach

                                            @foreach($ApiFiltradaCollectAprobado as $order)
                                                <tr style="background: #EE96BA;color:#fff">
                                                    <td>{{ $order['id'] }}</td>

                                                    <td>{{ $order['user']['name'] }}</td>

                                                    <td>
                                                        <a type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#estatus_edit_modal_paradisus{{$order['id']}}">
                                                            En preparación
                                                        </a>
                                                    </td>

                                                    <td>
                                                        {{ \Carbon\Carbon::parse($order['created_at'])->isoFormat('dddd DD MMMM hh:mm a') }}
                                                    </td>
                                                    <td>${{ $order['total'] }}</td>
                                                    <td>
                                                        <a type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#modal_productos_paradisus_{{ $order['id'] }}">
                                                            <i class="fa fa-list-alt"></i>
                                                        </a>

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusModal_para_{{ $order['id'] }}">
                                                            <i class="fa fa-info"></i>
                                                        </a>

                                                        <a class="btn btn-sm btn-dark text-white" target="_blank" href="{{ route('preparacion_scaner_paradisus.bodega', $order['id']) }}">
                                                            <i class="fa fa-barcode"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                @include('admin.bodega.modal_productos_paradisus')
                                                {{-- @include('admin.bodega.modal_estatus_paradisus') --}}
                                                @include('admin.bodega.modal_estatus_edit_para')

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
                                                <th>fecha Preparado</th>
                                                <th>Total</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($notas_presencial_preparado as $item)
                                                <tr style="background: #6ec7d1a3">
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
                                                        <a type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                            En preparación
                                                        </a><br>
                                                        Pedido Tiendita
                                                    </td>

                                                    <td>
                                                        <h5>
                                                            {{ \Carbon\Carbon::parse($item->fecha_preparacion)->isoFormat('dddd DD MMMM hh:mm a') }}
                                                        </h5>
                                                    </td>
                                                    <td><h5>${{ $item->total }}</h5></td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('notas_cotizacion.imprimir', ['id' => $item->id]) }}">
                                                            <i class="fa fa-list-alt"></i>
                                                        </a>

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusFechasModal{{$item->id}}">
                                                            <i class="fa fa-info"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                @include('admin.bodega.modal_estatus')
                                                @include('admin.bodega.modal_fechas')
                                            @endforeach

                                            @foreach ($notas_preparado as $item)
                                                <tr style="background: #836262a3">
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
                                                        <a type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                            Preparado
                                                        </a>
                                                    </td>

                                                    <td>
                                                        <h5>
                                                            {{ \Carbon\Carbon::parse($item->fecha_preparado)->isoFormat('dddd DD MMMM hh:mm a') }}
                                                        </h5>
                                                    </td>
                                                    <td><h5>${{ $item->total }}</h5></td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('notas_cotizacion.imprimir', ['id' => $item->id]) }}">
                                                            <i class="fa fa-file"></i>
                                                        </a>

                                                        @if ($item->metodo_pago == 'Contra Entrega')
                                                            <a type="button" class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#guiaModal{{$item->id}}" style="background: #e6ab2d; color: #ffff">
                                                                <i class="fa fa-truck"></i>
                                                            </a>
                                                        @else
                                                            <a class="text-center text-white btn btn-sm" href="{{asset('pago_fuera/'.$item->doc_guia) }}" download="{{asset('pago_fuera/'.$item->doc_guia) }}" style="background: #e6ab2d;">
                                                                <i class="fa fa-truck"></i>
                                                            </a>
                                                        @endif

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusFechasModal{{$item->id}}">
                                                            <i class="fa fa-info"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @include('admin.cotizacion.guia')
                                                @include('admin.bodega.modal_estatus')
                                                @include('admin.bodega.modal_fechas')
                                            @endforeach

                                            @foreach ($notas_cosmica_preparado as $item)
                                                <tr style="background: #d486d6">
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
                                                        <a type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                            En preparación
                                                        </a>
                                                    </td>

                                                    <td>
                                                        <h5>
                                                            {{ \Carbon\Carbon::parse($item->fecha_preparacion)->isoFormat('dddd DD MMMM hh:mm a') }}
                                                        </h5>
                                                    </td>
                                                    <td><h5>${{ $item->total }}</h5></td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('cotizacion_cosmica.imprimir', ['id' => $item->id]) }}">
                                                            <i class="fa fa-list-alt"></i>
                                                        </a>

                                                        @if ($item->metodo_pago == 'Contra Entrega')
                                                            <a type="button" class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#guiaModal{{$item->id}}" style="background: #e6ab2d; color: #ffff">
                                                                <i class="fa fa-truck"></i>
                                                            </a>
                                                        @else
                                                            <a class="text-center text-white btn btn-sm" href="{{asset('pago_fuera/'.$item->doc_guia) }}" download="{{asset('pago_fuera/'.$item->doc_guia) }}" style="background: #e6ab2d;">
                                                                <i class="fa fa-truck"></i>
                                                            </a>
                                                        @endif

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusFechasModal{{$item->id}}">
                                                            <i class="fa fa-info"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @include('admin.cotizacion_cosmica.guia')
                                                @include('admin.bodega.modal_cosmica_estatus')
                                                @include('admin.bodega.modal_fechas')
                                            @endforeach

                                            @foreach($orders_tienda_principal_preparados as $order)
                                                <tr style="background: #F5ECE4">
                                                    <td>{{ $order->id }}</td>
                                                    <td>{{ $order->billing->first_name . ' ' . $order->billing->last_name }}</td>
                                                    <td>
                                                        <a type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#estatus_edit_modal_woo{{$order->id}}">
                                                            Preparado
                                                        </a>
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($order->date_created)->format('d-m-Y') }}</td>
                                                    <td>${{ $order->total }}</td>
                                                    <td>
                                                        <a type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#modal_productos_{{ $order->id }}">
                                                            <i class="fa fa-list-alt"></i>
                                                        </a>

                                                        @if(isset($order->meta_data))
                                                            @foreach($order->meta_data as $meta)
                                                                @if($meta->key == 'guia_de_envio')

                                                                <a class="text-center text-white btn btn-sm" href="{{asset('guias/'.$meta->value) }}" download="{{asset('guias/'.$meta->value) }}" style="background: #e6ab2d;">
                                                                    <i class="fa fa-truck"></i>
                                                                </a>

                                                                @endif
                                                            @endforeach
                                                        @endif

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusModal_woo_{{$order->id}}">
                                                            <i class="fa fa-info"></i>
                                                        </a>

                                                    </td>
                                                </tr>

                                                @include('admin.bodega.modal_productos')
                                                @include('admin.bodega.modal_edit_estatus_woo')
                                                @include('admin.bodega.modal_estatus_woo')

                                            @endforeach

                                            @foreach($orders_tienda_cosmica_preparados as $order)
                                                <tr style="background: #80486B;color:#fff">
                                                    <td>{{ $order->id }}</td>
                                                    <td>{{ $order->billing->first_name . ' ' . $order->billing->last_name }}</td>
                                                    <td>
                                                        <a type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#estatus_edit_modal_woo{{$order->id}}">
                                                            Preparado
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @foreach($order->meta_data as $meta)
                                                            @if($meta->key == 'fecha_y_hora_guia')
                                                                {{ \Carbon\Carbon::parse($meta->value)->isoFormat('dddd DD MMMM hh:mm a') }}
                                                            @endif
                                                        @endforeach

                                                    </td>
                                                    <td>${{ $order->total }}</td>
                                                    <td>
                                                        <a type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#modal_productos_{{ $order->id }}">
                                                            <i class="fa fa-list-alt"></i>
                                                        </a>

                                                        @if(isset($order->meta_data))
                                                            @foreach($order->meta_data as $meta)
                                                                @if($meta->key == 'guia_de_envio')

                                                                <a class="text-center text-white btn btn-sm" href="{{asset('guias/'.$meta->value) }}" download="{{asset('guias/'.$meta->value) }}" style="background: #e6ab2d;">
                                                                    <i class="fa fa-truck"></i>
                                                                </a>

                                                                @endif
                                                            @endforeach
                                                        @endif

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusModal_woo_{{$order->id}}">
                                                            <i class="fa fa-info"></i>
                                                        </a>

                                                    </td>
                                                </tr>

                                                @include('admin.bodega.modal_productos')
                                                @include('admin.bodega.modal_edit_estatus_woo')
                                                @include('admin.bodega.modal_estatus_woo')

                                            @endforeach

                                            @foreach($ApiFiltradaCollectPreparado as $order)
                                                <tr style="background: #EE96BA;color:#fff">
                                                    <td>{{ $order['id'] }}</td>

                                                    <td>{{ $order['user']['name'] }}</td>

                                                    <td>
                                                        <a type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#estatus_edit_modal_paradisus{{$order['id']}}">
                                                            En preparación
                                                        </a>
                                                    </td>

                                                    <td>
                                                        {{ \Carbon\Carbon::parse($order['created_at'])->isoFormat('dddd DD MMMM hh:mm a') }}
                                                    </td>
                                                    <td>${{ $order['total'] }}</td>
                                                    <td>
                                                        <a type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#modal_productos_paradisus_{{ $order['id'] }}">
                                                            <i class="fa fa-list-alt"></i>
                                                        </a>

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusModal_para_{{ $order['id'] }}">
                                                            <i class="fa fa-info"></i>
                                                        </a>

                                                    </td>
                                                </tr>

                                                @include('admin.bodega.modal_productos_paradisus')
                                                @include('admin.bodega.modal_estatus_paradisus')
                                                @include('admin.bodega.modal_estatus_edit_para')

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
                                                <th>fecha Enviado</th>
                                                <th>Total</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($notas_enviados as $item)
                                                <tr style="background: #836262a3">
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
                                                        <a type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                            Enviado
                                                        </a>
                                                    </td>

                                                    <td>
                                                        <h5>
                                                            {{ \Carbon\Carbon::parse($item->fecha_envio)->isoFormat('dddd DD MMMM hh:mm a') }}
                                                        </h5>
                                                    </td>
                                                    <td><h5>${{ $item->total }}</h5></td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('notas_cotizacion.imprimir', ['id' => $item->id]) }}">
                                                            <i class="fa fa-file"></i>
                                                        </a>

                                                        @if ($item->metodo_pago == 'Contra Entrega')
                                                            <a type="button" class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#guiaModal{{$item->id}}" style="background: #e6ab2d; color: #ffff">
                                                                <i class="fa fa-truck"></i>
                                                            </a>
                                                        @else
                                                            <a class="text-center text-white btn btn-sm" href="{{asset('pago_fuera/'.$item->doc_guia) }}" download="{{asset('pago_fuera/'.$item->doc_guia) }}" style="background: #e6ab2d;">
                                                                <i class="fa fa-truck"></i>
                                                            </a>
                                                        @endif

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusFechasModal{{$item->id}}">
                                                            <i class="fa fa-info"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @include('admin.cotizacion.guia')
                                                @include('admin.bodega.modal_estatus')
                                                @include('admin.bodega.modal_fechas')
                                            @endforeach

                                            @foreach ($notas_cosmica_enviados as $item)
                                                <tr style="background: #d486d6">
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
                                                        <a type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                            En preparación
                                                        </a>
                                                    </td>

                                                    <td>
                                                        <h5>
                                                            {{ \Carbon\Carbon::parse($item->fecha_preparacion)->isoFormat('dddd DD MMMM hh:mm a') }}
                                                        </h5>
                                                    </td>
                                                    <td><h5>${{ $item->total }}</h5></td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('cotizacion_cosmica.imprimir', ['id' => $item->id]) }}">
                                                            <i class="fa fa-list-alt"></i>
                                                        </a>

                                                        @if ($item->metodo_pago == 'Contra Entrega')
                                                            <a type="button" class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#guiaModal{{$item->id}}" style="background: #e6ab2d; color: #ffff">
                                                                <i class="fa fa-truck"></i>
                                                            </a>
                                                        @else
                                                            <a class="text-center text-white btn btn-sm" href="{{asset('pago_fuera/'.$item->doc_guia) }}" download="{{asset('pago_fuera/'.$item->doc_guia) }}" style="background: #e6ab2d;">
                                                                <i class="fa fa-truck"></i>
                                                            </a>
                                                        @endif


                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusFechasModal{{$item->id}}">
                                                            <i class="fa fa-info"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @include('admin.cotizacion.guia')
                                                @include('admin.bodega.modal_estatus')
                                                @include('admin.bodega.modal_fechas')
                                            @endforeach

                                            @foreach($orders_tienda_principal_enviados as $order)
                                                <tr style="background: #F5ECE4">
                                                    <td>{{ $order->id }}</td>
                                                    <td>{{ $order->billing->first_name . ' ' . $order->billing->last_name }}</td>
                                                    <td>
                                                        <a type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#estatus_edit_modal_woo{{$order->id}}">
                                                            Enviado
                                                        </a>
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($order->date_created)->format('d-m-Y') }}</td>
                                                    <td>${{ $order->total }}</td>
                                                    <td>
                                                        <a type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#modal_productos_{{ $order->id }}">
                                                            <i class="fa fa-list-alt"></i>
                                                        </a>

                                                        @if(isset($order->meta_data))
                                                            @foreach($order->meta_data as $meta)
                                                                @if($meta->key == 'guia_de_envio')

                                                                <a class="text-center text-white btn btn-sm" href="{{asset('guias/'.$meta->value) }}" download="{{asset('guias/'.$meta->value) }}" style="background: #e6ab2d;">
                                                                    <i class="fa fa-truck"></i>
                                                                </a>

                                                                @endif
                                                            @endforeach
                                                        @endif

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusModal_woo_{{$order->id}}">
                                                            <i class="fa fa-info"></i>
                                                        </a>

                                                    </td>
                                                </tr>

                                                @include('admin.bodega.modal_productos')
                                                @include('admin.bodega.modal_edit_estatus_woo')
                                                @include('admin.bodega.modal_estatus_woo')
                                            @endforeach

                                            @foreach($orders_tienda_cosmica_enviados as $order)
                                                <tr style="background: #80486B;color:#fff">
                                                    <td>{{ $order->id }}</td>
                                                    <td>{{ $order->billing->first_name . ' ' . $order->billing->last_name }}</td>
                                                    <td>
                                                        <a type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#estatus_edit_modal_woo{{$order->id}}">
                                                            Enviado
                                                        </a>
                                                    </td>
                                                    <td>
                                                        @foreach($order->meta_data as $meta)
                                                            @if($meta->key == 'fecha_y_hora_guia')
                                                                {{ \Carbon\Carbon::parse($meta->value)->isoFormat('dddd DD MMMM hh:mm a') }}
                                                            @endif
                                                        @endforeach

                                                    </td>
                                                    <td>${{ $order->total }}</td>
                                                    <td>
                                                        <a type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#modal_productos_{{ $order->id }}">
                                                            <i class="fa fa-list-alt"></i>
                                                        </a>

                                                        @if(isset($order->meta_data))
                                                            @foreach($order->meta_data as $meta)
                                                                @if($meta->key == 'guia_de_envio')

                                                                <a class="text-center text-white btn btn-sm" href="{{asset('guias/'.$meta->value) }}" download="{{asset('guias/'.$meta->value) }}" style="background: #e6ab2d;">
                                                                    <i class="fa fa-truck"></i>
                                                                </a>

                                                                @endif
                                                            @endforeach
                                                        @endif

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusModal_woo_{{$order->id}}">
                                                            <i class="fa fa-info"></i>
                                                        </a>

                                                    </td>
                                                </tr>

                                                @include('admin.bodega.modal_productos')
                                                @include('admin.bodega.modal_edit_estatus_woo')
                                                @include('admin.bodega.modal_estatus_woo')

                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="nav-entregado" role="tabpanel" aria-labelledby="nav-entregado-tab" tabindex="0">
                                    <table class="table table-flush" id="datatable-search">
                                        <thead class="thead">
                                            <tr>
                                                <th>No</th>
                                                <th>Cliente</th>
                                                <th>Estatus</th>
                                                <th>fecha Enviado</th>
                                                <th>Total</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($notas_presencial_enviados as $item)
                                                <tr style="background: #6ec7d1a3">
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
                                                        <a type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                            Preparado
                                                        </a><br>
                                                        Pedido Tiendita
                                                    </td>

                                                    <td>
                                                        <h5>
                                                            {{ \Carbon\Carbon::parse($item->fecha_preparacion)->isoFormat('dddd DD MMMM hh:mm a') }}
                                                        </h5>
                                                    </td>
                                                    <td><h5>${{ $item->total }}</h5></td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('notas_cotizacion.imprimir', ['id' => $item->id]) }}">
                                                            <i class="fa fa-list-alt"></i>
                                                        </a>

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusFechasModal{{$item->id}}">
                                                            <i class="fa fa-info"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                @include('admin.bodega.modal_estatus')
                                                @include('admin.bodega.modal_fechas')
                                            @endforeach

                                            @foreach($ApiFiltradaCollectEnviado as $order)
                                                <tr style="background: #EE96BA;color:#fff">
                                                    <td>{{ $order['id'] }}</td>

                                                    <td>{{ $order['user']['name'] }}</td>

                                                    <td>
                                                        <a type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#estatus_edit_modal_paradisus{{$order['id']}}">
                                                            En preparación
                                                        </a>
                                                    </td>

                                                    <td>
                                                        {{ \Carbon\Carbon::parse($order['created_at'])->isoFormat('dddd DD MMMM hh:mm a') }}
                                                    </td>
                                                    <td>${{ $order['total'] }}</td>
                                                    <td>
                                                        <a type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#modal_productos_paradisus_{{ $order['id'] }}">
                                                            <i class="fa fa-list-alt"></i>
                                                        </a>

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusModal_para_{{ $order['id'] }}">
                                                            <i class="fa fa-info"></i>
                                                        </a>

                                                    </td>
                                                </tr>

                                                @include('admin.bodega.modal_productos_paradisus')
                                                @include('admin.bodega.modal_estatus_paradisus')
                                                @include('admin.bodega.modal_estatus_edit_para')

                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="nav-cancelada" role="tabpanel" aria-labelledby="nav-cancelada-tab" tabindex="0">
                                    <table class="table table-flush" id="datatable-search4">
                                        <thead class="thead">
                                            <tr>
                                                <th>No</th>
                                                <th>Cliente</th>
                                                <th>Estatus</th>
                                                <th>fecha Aprobada</th>
                                                <th>Total</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($notas_presencial_cancelada as $item)
                                                <tr style="background: #6ec7d1a3">
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
                                                        Pedido Tiendita
                                                    </td>

                                                    <td>
                                                        <h5>
                                                            {{ \Carbon\Carbon::parse($item->fecha_preparacion)->isoFormat('dddd DD MMMM hh:mm a') }}
                                                        </h5>
                                                    </td>
                                                    <td><h5>${{ $item->total }}</h5></td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('notas_cotizacion.imprimir', ['id' => $item->id]) }}">
                                                            <i class="fa fa-list-alt"></i>
                                                        </a>

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusFechasModal{{$item->id}}">
                                                            <i class="fa fa-info"></i>
                                                        </a>

                                                    </td>
                                                </tr>

                                                @include('admin.bodega.modal_fechas')
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

    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
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

    const dataTableSearch4 = new simpleDatatables.DataTable("#datatable-search4", {
        searchable: true,
        fixedHeight: false
    });


// Seleccionar todos los botones de envío
document.querySelectorAll('[id^="submitButtonEstatus"]').forEach(function(button) {
    button.addEventListener('click', function(event) {
        // Evitar múltiples clics
        event.preventDefault();

        // Obtener el ID del botón y su spinner correspondiente
        const id = this.id.replace('submitButtonEstatus', ''); // Obtener el ID del producto
        const spinner = document.getElementById('spinner' + id);

        // Deshabilitar el botón y mostrar el spinner
        this.disabled = true;
        spinner.classList.remove('d-none');

        // Enviar el formulario
        this.form.submit();
    });
});


</script>

@endsection


