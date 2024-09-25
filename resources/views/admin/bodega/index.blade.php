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
                                                        </a>
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

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusModal_woo_{{$item->id}}">
                                                            <i class="fa fa-info"></i>
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

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusModal_woo_{{$item->id}}">
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
                                            @foreach ($notas_preparado as $item)
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
                                                <tr>
                                                    <td>
                                                        <h5>
                                                            @if ($item->folio == null)
                                                                {{ $item->id }}
                                                            @else
                                                            {{ $item->id }}
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

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusModal_woo_{{$item->id}}">
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

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusModal_woo_{{$item->id}}">
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

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusModal_woo_{{$item->id}}">
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

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusModal_woo_{{$item->id}}">
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


