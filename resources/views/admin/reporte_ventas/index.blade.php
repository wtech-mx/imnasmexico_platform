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

                            <h2 class="mb-3">Ventas Gloabales</h2>

                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>
                        </div>
                    </div>

                    <div class="card">
                        <form action="{{ route('reporte_ventas.buscador') }}" method="GET" >
                            @csrf
                            <div class="card-body" style="padding-left: 1.5rem; padding-top: 1rem;">
                                <h5>Filtro</h5>
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="user_id">Fecha Inicio:</label>
                                            <input type="date" class="form-control" name="fecha_inicio" value="{{ date('Y-m-d') }}">
                                        </div>

                                        <div class="col-3">
                                            <label for="user_id">Fecha Fin:</label>
                                            <input type="date" class="form-control" name="fecha_fin" value="{{ date('Y-m-d') }}">
                                        </div>


                                        <div class="col-3">
                                            <br>
                                            <button class="btn btn-sm mb-0 mt-sm-0 mt-1" type="submit" style="background-color: #F82018; color: #ffffff;">Filtrar</button>
                                        </div>
                                    </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">

                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link text-white active" id="nav-cot-nas-tab" data-bs-toggle="tab" data-bs-target="#nav-cot-nas" type="button" role="tab" aria-controls="nav-cot-nas" aria-selected="false"  style="background: #836262a3">
                                        Cotizaciones NAS <img src="https://lh3.googleusercontent.com/d/1KpzCr4lID6U5foSXsNtQ4pXklupFAGz3=w800?authuser=0" alt="" width="45px">
                                    </button>

                                    <button class="nav-link text-white" id="nav-cot-cosmi-tab" data-bs-toggle="tab" data-bs-target="#nav-cot-cosmi" type="button" role="tab" aria-controls="nav-cot-cosmi" aria-selected="false" style="background: #D486D6">
                                        Cotizaciones Cosmica <img src="https://cosmicaskin.com/wp-content/uploads/2024/06/logo_recortado_cosmica.png" alt="" width="35px">
                                    </button>

                                    <button class="nav-link text-white" id="nav-tiendita-tab" data-bs-toggle="tab" data-bs-target="#nav-tiendita" type="button" role="tab" aria-controls="nav-tiendita" aria-selected="false" style="background: #6ec7d1a3">
                                        Tiendita <img src="{{ asset('assets/user/icons/marketplace.png') }}" alt="" width="35px">
                                    </button>

                                    <button class="nav-link text-white" id="nav-paradisus-tab" data-bs-toggle="tab" data-bs-target="#nav-paradisus" type="button" role="tab" aria-controls="nav-paradisus" aria-selected="false" style="background: #EE96BA">
                                        Paradisus <img src="https://paradisus.mx/assets/landing/paradisus.webp" alt="" width="45px">
                                    </button>

                                    <button class="nav-link text-dark" id="nav-nas-online-tab" data-bs-toggle="tab" data-bs-target="#nav-nas-online" type="button" role="tab" aria-controls="nav-nas-online" aria-selected="false" style="background: #F5ECE4">
                                        NAS Online  <img src="{{ asset('assets/user/icons/carrito-de-compras.png') }}" alt="" width="35px">
                                    </button>

                                    <button class="nav-link text-white" id="nav-cosmica-online-tab" data-bs-toggle="tab" data-bs-target="#nav-cosmica-online" type="button" role="tab" aria-controls="nav-cosmica-online" aria-selected="false" style="background: #80486B">
                                        Cosmica Online  <img src="{{ asset('assets/user/icons/carrito-de-compras.png') }}" alt="" width="35px">
                                    </button>
                                </div>
                              </nav>

                              <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-cot-nas" role="tabpanel" aria-labelledby="nav-cot-nas-tab" tabindex="0">
                                    <table class="table table-flush" id="datatable-cot-nas">
                                        <thead class="thead">
                                            <tr>
                                                <th>No</th>
                                                <th>Cliente</th>
                                                <th>Estatus</th>
                                                <th>fecha</th>
                                                <th>Total</th>
                                                <th>Admin</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cot_nas as $item)
                                                <tr>
                                                    <td>{{ $item->folio }}</td>
                                                    <td>
                                                        @if ($item->id_usuario == NULL)
                                                            {{ $item->nombre }} <br> {{ $item->telefono }}
                                                        @else
                                                            {{ $item->User->name }} <br> {{ $item->User->telefono }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->estatus_cotizacion == NULL)
                                                            Pendiente de aprobación
                                                        @else
                                                            {{ $item->estatus_cotizacion }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @php
                                                        $fecha = $item->fecha;
                                                        $fecha_timestamp = strtotime($fecha);
                                                        $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                                        @endphp
                                                            {{$fecha_formateada}}
                                                    </td>
                                                    <td>${{ $item->total }}</td>
                                                    <td>{{ $item->Admin->name }}</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('notas_cotizacion.imprimir', ['id' => $item->id]) }}">
                                                            <i class="fa fa-file"></i>
                                                        </a>
                                                        <a type="button" class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#pagoModal{{$item->id}}" style="background: #2d6ee6; color: #ffff">
                                                            <i class="fa fa-credit-card-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @include('admin.cotizacion.modal_pago')
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="nav-cot-cosmi" role="tabpanel" aria-labelledby="nav-cot-cosmi-tab" tabindex="0">
                                    <table class="table table-flush" id="datatable-cot-cosmi">
                                        <thead class="thead">
                                            <tr>
                                                <th>No</th>
                                                <th>Cliente</th>
                                                <th>Estatus</th>
                                                <th>fecha</th>
                                                <th>Total</th>
                                                <th>Admin</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($cot_cosmi as $item)
                                                <tr>
                                                    <td>{{ $item->folio }}</td>
                                                    <td>
                                                        @if ($item->id_usuario == NULL)
                                                            {{ $item->nombre }} <br> {{ $item->telefono }}
                                                        @else
                                                            {{ $item->User->name }} <br> {{ $item->User->telefono }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->estatus_cotizacion == NULL)
                                                            Pendiente de aprobación
                                                        @else
                                                            {{ $item->estatus_cotizacion }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @php
                                                        $fecha = $item->fecha;
                                                        $fecha_timestamp = strtotime($fecha);
                                                        $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                                        @endphp
                                                            {{$fecha_formateada}}
                                                    </td>
                                                    <td>${{ $item->total }}</td>
                                                    <td>{{ $item->Admin->name }}</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('notas_cotizacion.imprimir', ['id' => $item->id]) }}">
                                                            <i class="fa fa-file"></i>
                                                        </a>
                                                        <a type="button" class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#pagoModal{{$item->id}}" style="background: #2d6ee6; color: #ffff">
                                                            <i class="fa fa-credit-card-alt"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @include('admin.cotizacion_cosmica.modal_pago')
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="nav-tiendita" role="tabpanel" aria-labelledby="nav-tiendita-tab" tabindex="0">
                                    <table class="table table-flush" id="datatable-tiendita">
                                        <thead class="thead">
                                            <tr>
                                                <th>No</th>
                                                <th>Cliente</th>
                                                <th>Estatus</th>
                                                <th>fecha</th>
                                                <th>Total</th>
                                                <th>Admin</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($venta_nas as $item)
                                                <tr>
                                                    <td>{{ $item->folio }}</td>
                                                    <td>
                                                        @if ($item->id_usuario == NULL)
                                                            {{ $item->nombre }} <br> {{ $item->telefono }}
                                                        @else
                                                            {{ $item->User->name }} <br> {{ $item->User->telefono }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($item->estatus_cotizacion == NULL)
                                                            Pendiente de aprobación
                                                        @else
                                                            {{ $item->estatus_cotizacion }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @php
                                                        $fecha = $item->fecha;
                                                        $fecha_timestamp = strtotime($fecha);
                                                        $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                                        @endphp
                                                            {{$fecha_formateada}}
                                                    </td>
                                                    <td>${{ $item->total }}</td>
                                                    <td>{{ $item->Admin->name }}</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('notas_productos.imprimir', ['id' => $item->id]) }}">
                                                            <i class="fa fa-file"></i>
                                                        </a>
                                                        <a class="btn btn-sm btn-warning" href="{{ route('notas_productos.edit', $item->id) }}">
                                                            <i class="fa fa-fw fa-edit"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="nav-paradisus" role="tabpanel" aria-labelledby="nav-paradisus-tab" tabindex="0">
                                    <table class="table table-flush" id="datatable-paradisus">
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
                                            @foreach ($ApiFiltradaCollectAprobado as $order)
                                                <tr>
                                                    <td>{{ $order['id'] }}</td>

                                                    <td>{{ $order['user']['name'] }}</td>

                                                    <td>{{ $order['estatus'] }}</td>

                                                    <td>{{ \Carbon\Carbon::parse($order['created_at'])->isoFormat('dddd DD MMMM hh:mm a') }}</td>

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
                                                @include('admin.bodega.modal_estatus_edit_para')
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="nav-nas-online" role="tabpanel" aria-labelledby="nav-nas-online-tab" tabindex="0">
                                    <table class="table table-flush" id="datatable-nas-online">
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
                                            @foreach ($orders_nas as $order)
                                                <tr>
                                                    <td>{{ $order->id }}</td>
                                                    <td>{{ $order->billing->first_name . ' ' . $order->billing->last_name }}</td>
                                                    <td>{{ $order->status }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($order->date_created)->format('d-m-Y') }}</td>
                                                    <td>${{ $order->total }}</td>
                                                    <td>
                                                        <a type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#modal_productos_{{ $order->id }}">
                                                            <i class="fa fa-list-alt"></i>
                                                        </a>

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusModal_woo_{{$order->id}}">
                                                            <i class="fa fa-info"></i>
                                                        </a>

                                                    </td>
                                                </tr>
                                                @include('admin.bodega.modal_productos')
                                                @include('admin.bodega.modal_estatus_woo')
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="nav-cosmica-online" role="tabpanel" aria-labelledby="nav-cosmica-online-tab" tabindex="0">
                                    <table class="table table-flush" id="datatable-cosmica-online">
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
                                            @foreach ($orders_cosmi as $order)
                                                <tr>
                                                    <td>{{ $order->id }}</td>
                                                    <td>{{ $order->billing->first_name . ' ' . $order->billing->last_name }}</td>
                                                    <td>{{ $order->status }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($order->date_created)->format('d-m-Y') }}</td>
                                                    <td>${{ $order->total }}</td>
                                                    <td>
                                                        <a type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#modal_productos_{{ $order->id }}">
                                                            <i class="fa fa-list-alt"></i>
                                                        </a>

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusModal_woo_{{$order->id}}">
                                                            <i class="fa fa-info"></i>
                                                        </a>

                                                    </td>
                                                </tr>
                                                @include('admin.bodega.modal_productos')
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

    const dataTableSearch = new simpleDatatables.DataTable("#datatable-cot-nas", {
        searchable: true,
        fixedHeight: false
    });

    const dataTableSearch2 = new simpleDatatables.DataTable("#datatable-cot-cosmi", {
        searchable: true,
        fixedHeight: false
    });

    const dataTableSearch3 = new simpleDatatables.DataTable("#datatable-nas-online", {
        searchable: true,
        fixedHeight: false
    });

    const dataTableSearch4 = new simpleDatatables.DataTable("#datatable-cosmica-online", {
        searchable: true,
        fixedHeight: false
    });

    const dataTableSearch5 = new simpleDatatables.DataTable("#datatable-tiendita", {
        searchable: true,
        fixedHeight: false
    });

    const dataTableSearch6 = new simpleDatatables.DataTable("#datatable-paradisus", {
        searchable: true,
        fixedHeight: false
    });
</script>

@endsection


