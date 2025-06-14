@extends('layouts.app_admin')

@section('template_title')
    Bodega
@endsection

@section('content')
<style>
    .border-yellow {
        background: #fff61a!important;
    }
    .dataTable-wrapper .dataTable-container .table tbody tr td {
    padding: 0!important;
}
</style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h2 class="mb-3">Notas ventas en preparacion del Mes</h2>

                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>
                        </div>
                    </div>

                    @can('reporte-ventas')
                        <div class="card mb-3">
                            <form action="{{ route('reporte.ventas') }}" method="GET" >
                                <div class="card-body" style="padding-left: 1.5rem; padding-top: 1rem;">
                                    <h5>Ventas del dia</h5>
                                        <div class="row">

                                            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                                                <label for="user_id">Fecha Inicio:</label>
                                                <input type="date" class="form-control" name="fecha_inicio" value="{{ date('Y-m-d') }}">
                                            </div>

                                            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                                                <label for="user_id">Fecha Fin:</label>
                                                <input type="date" class="form-control" name="fecha_fin" value="{{ date('Y-m-d') }}">
                                            </div>

                                            <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                                                <label for="user_id">Tipo:</label>
                                                <select class="form-control" id="tipo" name="tipo">
                                                    <option value="General">General</option>
                                                    <option value="NAS">NAS</option>
                                                    <option value="Cosmica">Cosmica</option>
                                                </select>
                                            </div>


                                            <div class="col-6 col-sm-6 col-md-4 col-lg-3 align-self-end">
                                                <button type="submit" name="action" value="Generar PDF" class="btn btn-success my-auto">Generar PDF</button>
                                            </div>
                                        </div>
                                </div>
                            </form>
                        </div>
                    @endcan

                    <div class="row p-3">

                         <div class="col-4 col-sm-4 col-md-3 col-lg-2 ">
                            <span class="badge rounded-pill text-dark" style="background: #F5ECE4">NAS Online</span>
                         </div>

                         <div class="col-4 col-sm-4 col-md-3 col-lg-2 ">
                            <span class="badge rounded-pill text-white" style="background: #6ec7d1a3">NAS Tiendita</span>
                         </div>

                         <div class="col-4 col-sm-4 col-md-3 col-lg-2 ">
                            <span class="badge rounded-pill text-white" style="background: #836262a3">NAS  </span>
                         </div>

                         <div class="col-4 col-sm-4 col-md-3 col-lg-2 ">
                            <span class="badge rounded-pill text-white" style="background: #D486D6">Cosmica  </span>
                         </div>

                         <div class="col-4 col-sm-4 col-md-3 col-lg-2 ">
                            <span class="badge rounded-pill text-white" style="background: #80486B">Cosmica Online</span>
                         </div>

                         <div class="col-4 col-sm-4 col-md-3 col-lg-2 ">
                            <span class="badge rounded-pill text-white" style="background: #EE96BA">Paradisus</span>
                         </div>

                         <div class="col-4 col-sm-4 col-md-3 col-lg-2 ">
                            <span class="badge rounded-pill text-white" style="background: #fff701">MELI</span>
                         </div>

                         <div class="col-4 col-sm-4 col-md-3 col-lg-2 ">
                            <span class="badge rounded-pill text-white" style="background: #84ABE5">Recojer en Tienda</span>
                         </div>

                         <div class="col-12 col-sm-4 col-md-3 col-lg-2 ">
                            <form class="row mt-3" action="{{ route('producto_pdf.pdf') }}" method="GET" >
                                <button class="btn btn-dark btn-xs" type="submit" style=""><i class="fa fa-file-pdf"></i> PDF productos faltantes</button>
                            </form>
                        </div>

                    </div>

                    <div class="card-body">
                        <div class="table-responsive">

                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a href="{{ route('index_preparacion.bodega') }}" class="nav-link {{ request()->routeIs('index_preparacion.bodega') ? 'active' : '' }}">
                                        En preparación <img src="{{ asset('assets/cam/box.png') }}" alt="" width="35px">
                                        <span class="badge rounded-pill bg-danger">{{ $cantidad_preparacion ?? 0 }}</span>
                                    </a>
                                    <a href="{{ route('index_preparados.bodega') }}" class="nav-link {{ request()->routeIs('index_preparados.bodega') ? 'active' : '' }}">
                                        Preparados <img src="{{ asset('assets/cam/package.png') }}" alt="" width="35px">
                                    </a>
                                    <a href="{{ route('index_enviados.bodega') }}" class="nav-link {{ request()->routeIs('index_enviados.bodega') ? 'active' : '' }}">
                                        Enviados <img src="{{ asset('assets/cam/delivery.png') }}" alt="" width="35px">
                                    </a>
                                    <a href="{{ route('index_entregados.bodega') }}" class="nav-link {{ request()->routeIs('index_entregados.bodega') ? 'active' : '' }}">
                                        Entregados <img src="{{ asset('assets/cam/delivery.png') }}" alt="" width="35px">
                                    </a>
                                    <a href="{{ route('index_canceladas.bodega') }}" class="nav-link {{ request()->routeIs('index_canceladas.bodega') ? 'active' : '' }}">
                                        Canceladas <img src="{{ asset('assets/cam/cerrar.png') }}" alt="" width="35px">
                                    </a>
                                </div>
                            </nav>


                              <div class="tab-content" id="nav-tabContent">

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
                                                        En preparación <br>
                                                        Pedido Tiendita
                                                    </td>

                                                    <td>
                                                        {{ \Carbon\Carbon::parse($item->fecha_preparacion)
                                                                ->locale('es')
                                                                ->isoFormat('DD/MM/YY') }}
                                                        <br>
                                                        {{ \Carbon\Carbon::parse($item->fecha_preparacion)
                                                                ->locale('es')
                                                                ->isoFormat('hh:mm a') }}
                                                    </td>
                                                    <td><h5>${{ $item->total }}</h5></td>
                                                    <td>
                                                        <a class="btn btn-xs btn-warning text-white" target="_blank" href="{{ route('notas_productos.imprimir', ['id' => $item->id]) }}">
                                                            <i class="fa fa-file"></i>
                                                        </a>

                                                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('notas_cotizacion.imprimir', ['id' => $item->id]) }}">
                                                            <i class="fa fa-list-alt"></i>
                                                        </a>

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusFechasModal{{$item->id}}">
                                                            <i class="fa fa-info"></i>
                                                        </a>

                                                        <a class="btn btn-sm btn-dark text-white" href="{{ route('preparacion_scaner.bodega', $item->id) }}">
                                                            <i class="fa fa-barcode"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                @include('admin.bodega.modal_estatus')
                                                @include('admin.bodega.modal_fechas')
                                            @endforeach

                                            @foreach ($notas_preparacion as $item)
                                                @if ($item->metodo_pago == 'Recoger en Tienda' || $item->metodo_pago == 'Contra Entrega')
                                                    <tr style="background: #3f7bd6a3">
                                                @else
                                                    <tr style="background: #836262a3">
                                                @endif
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
                                                        En preparación <br>
                                                        @if ($item->metodo_pago == 'Recoger en Tienda' || $item->metodo_pago == 'Contra Entrega')
                                                            <b style="color: #000;">Recoge en tienda</b>
                                                        @else
                                                            NAS
                                                        @endif

                                                    </td>

                                                    <td>
                                                        {{ \Carbon\Carbon::parse($item->fecha_preparacion)
                                                                ->locale('es')
                                                                ->isoFormat('DD/MM/YY') }}
                                                        <br>
                                                        {{ \Carbon\Carbon::parse($item->fecha_preparacion)
                                                                ->locale('es')
                                                                ->isoFormat('hh:mm a') }}
                                                    </td>
                                                    <td><h5>${{ $item->total }}</h5></td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('notas_cotizacion.imprimir', ['id' => $item->id]) }}">
                                                            <i class="fa fa-list-alt"></i>
                                                        </a>

                                                        <a class="text-center text-white btn btn-sm"
                                                            href="{{ route('pdf_etiqueta.bodega', ['tabla' => 'notas_productos', 'id' => $item->id]) }}"
                                                            style="background: #7d2de6;">
                                                            <i class="fa fa-qrcode"></i>
                                                        </a>

                                                        @if ($item->metodo_pago == 'Recoger en Tienda' || $item->metodo_pago == 'Contra Entrega')
                                                            <a type="button" class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#guiaModal{{$item->id}}" style="background: #e6ab2d; color: #ffff">
                                                                <i class="fa fa-truck"></i>
                                                            </a>
                                                        @else
                                                            <a class="text-center text-white btn btn-sm" href="{{asset('pago_fuera/'.$item->doc_guia) }}" download="{{asset('pago_fuera/'.$item->doc_guia) }}" style="background: #e6ab2d;">
                                                                <i class="fa fa-truck"></i>
                                                            </a>
                                                        @endif <br>

                                                        <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusFechasModal{{$item->id}}">
                                                            <i class="fa fa-info"></i>
                                                        </a>

                                                        <a class="btn btn-sm btn-dark text-white" href="{{ route('preparacion_scaner.bodega', $item->id) }}">
                                                            <i class="fa fa-barcode"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                @include('admin.cotizacion.guia')
                                                @include('admin.bodega.modal_estatus')
                                                @include('admin.bodega.modal_fechas')
                                            @endforeach

                                            @foreach ($notas_cosmica_preparacion as $item)

                                                @php
                                                    $status = $item->meli_data['status'] ?? null;
                                                    $dateCreated = $item->meli_data['date_created'] ?? null;
                                                    $isReadyOrPrepared = in_array($status, ['ready_to_ship', 'handling']);
                                                    $isDelayed = false;

                                                    if ($isReadyOrPrepared && $dateCreated) {
                                                        $shipmentDate = new DateTime($dateCreated);
                                                        $currentDate = new DateTime();
                                                        $isDelayed = $shipmentDate->format('Y-m-d') < $currentDate->format('Y-m-d');
                                                    }

                                                    $borderClass = ($item->item_id_meli && !$item->estadociudad) || $isDelayed ? 'border-yellow' : '';
                                                @endphp

                                                @if ($item->metodo_pago == 'Envio MELI')
                                                    <tr class="border-yellow" style="background: #d486d6">
                                                @elseif ($item->metodo_pago == 'Recoger en Tienda' || $item->metodo_pago == 'Contra Entrega')
                                                    <tr style="background: #3f7bd6a3">
                                                @else
                                                    <tr class="{{ $borderClass }}" style="background: #d486d6">
                                                @endif

                                                    <td>
                                                        @if ($item->item_id_meli && !$item->estadociudad)
                                                            <img src="https://http2.mlstatic.com/frontend-assets/ml-web-navigation/ui-navigation/6.6.92/mercadolibre/logo_large_25years_v2.png" alt="Mercado Libre" width="60px">
                                                        @endif
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

                                                            @if($item->shippingId_meli && is_array($item->meli_data))
                                                            @php
                                                                $meliData = $item->meli_data; // Asegúrate de que esta variable contiene los datos de meli
                                                                // Obtener el color correspondiente al estado actual
                                                                $statusColor = $statusColors[$meliData['status']] ?? 'text-muted'; // Color predeterminado si no se encuentra el estado
                                                                $status = $meliData['status'] ?? 'N/A';
                                                                $dateCreated = $meliData['date_created'] ?? 'N/A';
                                                                $substatus = $meliData['substatus'] ?? null;
                                                                $statusHistory = $meliData['status_history'] ?? [];
                                                                $shipmentDate = new DateTime($dateCreated);
                                                                $currentDate = new DateTime();
                                                                $shipmentDateFormatted = $shipmentDate->format('Y-m-d');
                                                                $currentDateFormatted = $currentDate->format('Y-m-d');
                                                                $isReadyOrPrepared = in_array($status, ['ready_to_ship', 'handling']);
                                                                $isDelayed = $isReadyOrPrepared && $shipmentDateFormatted < $currentDateFormatted;
                                                                $substatusDroppedOff = in_array($substatus, ['dropped_off', 'in_hub']);
                                                                $isLabelNotPrinted = $isReadyOrPrepared && $substatus !== 'printed';
                                                            @endphp

                                                            <p>

                                                                @if ($isLabelNotPrinted)

                                                                @else
                                                                    @if ($isDelayed)
                                                                        <br><br>
                                                                        <strong style="color:red">Estás con demora</strong><br>
                                                                        Despacha el paquete cuanto antes en una agencia de Mercado Libre. La demora está afectando tu reputación.
                                                                    @endif
                                                                @endif
                                                            </p>
                                                        @endif

                                                                En preparación <br>
                                                                @if ($item->metodo_pago == 'Recoger en Tienda' || $item->metodo_pago == 'Contra Entrega')
                                                                    <b style="color: #000;">Recoge en tienda</b>
                                                                @endif
                                                        </td>

                                                    <td>
                                                        {{ \Carbon\Carbon::parse($item->fecha_preparacion)
                                                                ->locale('es')
                                                                ->isoFormat('DD/MM/YY') }}
                                                        <br>
                                                        {{ \Carbon\Carbon::parse($item->fecha_preparacion)
                                                                ->locale('es')
                                                                ->isoFormat('hh:mm a') }}
                                                    </td>
                                                        <td><h5>${{ $item->total }}</h5></td>
                                                        <td>
                                                            <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('cotizacion_cosmica.imprimir', ['id' => $item->id]) }}">
                                                                <i class="fa fa-list-alt"></i>
                                                            </a>

                                                            <a class="text-center text-white btn btn-sm"
                                                                href="{{ route('pdf_etiqueta.bodega', ['tabla' => 'notas_cosmica_productos', 'id' => $item->id]) }}"
                                                                style="background: #7d2de6;">
                                                                <i class="fa fa-qrcode"></i>
                                                            </a>

                                                            @if ($item->metodo_pago == 'Recoger en Tienda' || $item->metodo_pago == 'Contra Entrega')
                                                                <a type="button" class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#guiaModal{{$item->id}}" style="background: #e6ab2d; color: #ffff">
                                                                    <i class="fa fa-truck"></i>
                                                                </a>
                                                            @else
                                                                <a class="text-center text-white btn btn-sm" href="{{asset('pago_fuera/'.$item->doc_guia) }}" download="{{asset('pago_fuera/'.$item->doc_guia) }}" style="background: #e6ab2d;">
                                                                    <i class="fa fa-truck"></i>
                                                                </a>
                                                            @endif <br>

                                                            <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusFechasModal{{$item->id}}">
                                                                <i class="fa fa-info"></i>
                                                            </a>

                                                            <a class="btn btn-sm btn-dark text-white" href="{{ route('preparacion_scaner_cosmica.bodega', $item->id) }}">
                                                                <i class="fa fa-barcode"></i>
                                                            </a>
                                                        </td>
                                                </tr>
                                                @include('admin.cotizacion.guia')
                                                @include('admin.bodega.modal_cosmica_estatus')
                                                @include('admin.bodega.modal_fechas')
                                            @endforeach

                                            @foreach ($notas_cosmica_preparacion_work as $item)

                                                @php
                                                    $status = $item->meli_data['status'] ?? null;
                                                    $dateCreated = $item->meli_data['date_created'] ?? null;
                                                    $isReadyOrPrepared = in_array($status, ['ready_to_ship', 'handling']);
                                                    $isDelayed = false;

                                                    if ($isReadyOrPrepared && $dateCreated) {
                                                        $shipmentDate = new DateTime($dateCreated);
                                                        $currentDate = new DateTime();
                                                        $isDelayed = $shipmentDate->format('Y-m-d') < $currentDate->format('Y-m-d');
                                                    }

                                                    $borderClass = ($item->item_id_meli && !$item->estadociudad) || $isDelayed ? 'border-yellow' : '';
                                                @endphp

                                                @if ($item->metodo_pago == 'Envio MELI')
                                                    <tr class="border-yellow" style="background: #d486d6">
                                                @elseif ($item->metodo_pago == 'Recoger en Tienda' || $item->metodo_pago == 'Contra Entrega')
                                                    <tr style="background: #3f7bd6a3">
                                                @else
                                                    <tr class="{{ $borderClass }}" style="background: #d486d6">
                                                @endif

                                                    <td>
                                                        @if ($item->item_id_meli && !$item->estadociudad)
                                                            <img src="https://http2.mlstatic.com/frontend-assets/ml-web-navigation/ui-navigation/6.6.92/mercadolibre/logo_large_25years_v2.png" alt="Mercado Libre" width="60px">
                                                        @endif
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

                                                            @if($item->shippingId_meli && is_array($item->meli_data))
                                                            @php
                                                                $meliData = $item->meli_data; // Asegúrate de que esta variable contiene los datos de meli
                                                                // Obtener el color correspondiente al estado actual
                                                                $statusColor = $statusColors[$meliData['status']] ?? 'text-muted'; // Color predeterminado si no se encuentra el estado
                                                                $status = $meliData['status'] ?? 'N/A';
                                                                $dateCreated = $meliData['date_created'] ?? 'N/A';
                                                                $substatus = $meliData['substatus'] ?? null;
                                                                $statusHistory = $meliData['status_history'] ?? [];
                                                                $shipmentDate = new DateTime($dateCreated);
                                                                $currentDate = new DateTime();
                                                                $shipmentDateFormatted = $shipmentDate->format('Y-m-d');
                                                                $currentDateFormatted = $currentDate->format('Y-m-d');
                                                                $isReadyOrPrepared = in_array($status, ['ready_to_ship', 'handling']);
                                                                $isDelayed = $isReadyOrPrepared && $shipmentDateFormatted < $currentDateFormatted;
                                                                $substatusDroppedOff = in_array($substatus, ['dropped_off', 'in_hub']);
                                                                $isLabelNotPrinted = $isReadyOrPrepared && $substatus !== 'printed';
                                                            @endphp

                                                            <p>

                                                                @if ($isLabelNotPrinted)

                                                                @else
                                                                    @if ($isDelayed)
                                                                        <br><br>
                                                                        <strong style="color:red">Estás con demora</strong><br>
                                                                        Despacha el paquete cuanto antes en una agencia de Mercado Libre. La demora está afectando tu reputación.
                                                                    @endif
                                                                @endif
                                                            </p>
                                                        @endif

                                                                En preparación <br>
                                                                @if ($item->metodo_pago == 'Recoger en Tienda' || $item->metodo_pago == 'Contra Entrega')
                                                                    <b style="color: #000;">Recoge en tienda</b>
                                                                @endif
                                                        </td>

                                                    <td>
                                                        {{ \Carbon\Carbon::parse($item->fecha_preparacion)
                                                                ->locale('es')
                                                                ->isoFormat('DD/MM/YY') }}
                                                        <br>
                                                        {{ \Carbon\Carbon::parse($item->fecha_preparacion)
                                                                ->locale('es')
                                                                ->isoFormat('hh:mm a') }}
                                                    </td>
                                                        <td><h5>${{ $item->total }}</h5></td>
                                                        <td>
                                                            <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('cotizacion_cosmica.imprimir', ['id' => $item->id]) }}">
                                                                <i class="fa fa-list-alt"></i>
                                                            </a>

                                                            <a class="text-center text-white btn btn-sm"
                                                                href="{{ route('pdf_etiqueta.bodega', ['tabla' => 'notas_cosmica_productos', 'id' => $item->id]) }}"
                                                                style="background: #7d2de6;">
                                                                <i class="fa fa-qrcode"></i>
                                                            </a>

                                                            @if ($item->metodo_pago == 'Recoger en Tienda' || $item->metodo_pago == 'Contra Entrega')
                                                                <a type="button" class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#guiaModal{{$item->id}}" style="background: #e6ab2d; color: #ffff">
                                                                    <i class="fa fa-truck"></i>
                                                                </a>
                                                            @else
                                                                <a class="text-center text-white btn btn-sm" href="{{asset('pago_fuera/'.$item->doc_guia) }}" download="{{asset('pago_fuera/'.$item->doc_guia) }}" style="background: #e6ab2d;">
                                                                    <i class="fa fa-truck"></i>
                                                                </a>
                                                            @endif <br>

                                                            <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusFechasModal{{$item->id}}">
                                                                <i class="fa fa-info"></i>
                                                            </a>

                                                            <a class="btn btn-sm btn-dark text-white" href="{{ route('preparacion_scaner_cosmica.bodega', $item->id) }}">
                                                                <i class="fa fa-barcode"></i>
                                                            </a>
                                                        </td>
                                                </tr>
                                                @include('admin.cotizacion.guia')
                                                @include('admin.bodega.modal_cosmica_estatus')
                                                @include('admin.bodega.modal_fechas')
                                            @endforeach

                                            @foreach ($orders_nas_ecommerce as $item)
                                                @if ($item->forma_envio == 'envio')
                                                    <tr style="background: #F5ECE4;color:#070707">
                                                @else
                                                    <tr style="background: #3f7bd6a3">
                                                @endif
                                                    <td>
                                                        <h5>
                                                            TN{{ $item->id }}
                                                        </h5>
                                                    </td>
                                                    <td>
                                                        <h5>
                                                            {{ $item->User->name }}
                                                            {{ $item->User->telefono }}
                                                        </h5>
                                                    </td>

                                                    <td>
                                                        En preparación <br>
                                                        @if ($item->forma_envio == 'envio')
                                                            Ecommerce NAS
                                                        @else
                                                            <b style="color: #000;">Recoge en tienda</b>
                                                        @endif

                                                    </td>

                                                    <td>
                                                        {{ \Carbon\Carbon::parse($item->fecha_preparacion)
                                                                ->locale('es')
                                                                ->isoFormat('DD/MM/YY') }}
                                                        <br>
                                                        {{ \Carbon\Carbon::parse($item->fecha_preparacion)
                                                                ->locale('es')
                                                                ->isoFormat('hh:mm a') }}
                                                    </td>
                                                    <td><h5>${{ $item->pago }}</h5></td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('imprimir_admin.nas', ['id' => $item->id]) }}">
                                                            <i class="fa fa-list-alt"></i>
                                                        </a>

                                                        <a class="text-center text-white btn btn-sm"
                                                            href="{{ route('pdf_etiqueta.bodega', ['tabla' => 'notas_productos', 'id' => $item->id]) }}"
                                                            style="background: #7d2de6;">
                                                            <i class="fa fa-qrcode"></i>
                                                        </a>

                                                        @if ($item->forma_envio == NULL)
                                                            <a type="button" class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#guiaModal{{$item->id}}" style="background: #e6ab2d; color: #ffff">
                                                                <i class="fa fa-truck"></i>
                                                            </a>
                                                        @else
                                                            <a class="text-center text-white btn btn-sm" href="{{asset('pago_fuera/'.$item->guia_doc) }}" download="{{asset('pago_fuera/'.$item->guia_doc) }}" style="background: #e6ab2d;">
                                                                <i class="fa fa-truck"></i>
                                                            </a>
                                                        @endif <br>

                                                        <a class="btn btn-sm btn-dark text-white" href="{{ route('preparacion_scaner.nas', $item->id) }}">
                                                            <i class="fa fa-barcode"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @include('admin.notas_productos.modal_direccion')
                                            @endforeach

                                            @foreach($ApiFiltradaCollectAprobado as $order)
                                                <tr style="background: #EE96BA;color:#fff">
                                                    <td>{{ $order['id'] }}</td>

                                                    <td>{{ $order['user']['name'] }}</td>

                                                    <td>
                                                            En preparación
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

                                                        <a class="btn btn-sm btn-dark text-white" href="{{ route('preparacion_scaner_paradisus.bodega', $order['id']) }}">
                                                            <i class="fa fa-barcode"></i>
                                                        </a>
                                                    </td>
                                                </tr>

                                                @include('admin.bodega.modal_productos_paradisus')
                                                {{-- @include('admin.bodega.modal_estatus_paradisus') --}}
                                                @include('admin.bodega.modal_estatus_edit_para')

                                            @endforeach

                                            @foreach($ApiFiltradaCollectAprobadoreposicion as $order)
                                                <tr style="background: #EE96BA;color:#fff">
                                                    <td>R{{ $order['id'] }}</td>

                                                    <td>{{ $order['user']['name'] }}</td>

                                                    <td>
                                                            En preparación
                                                    </td>

                                                    <td>
                                                        {{ \Carbon\Carbon::parse($order['fecha_aprobado'])->isoFormat('dddd DD MMMM hh:mm a') }}
                                                    </td>
                                                    <td>$0</td>
                                                    <td>
                                                        <a class="btn btn-sm btn-dark text-white" href="{{ route('preparacion_scaner_paradisus_repo.bodega', $order['id']) }}">
                                                            <i class="fa fa-barcode"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            @foreach ($oreders_cosmica_ecommerce as $item)
                                                @if ($item->forma_envio == 'envio')
                                                    <tr style="background: #80486B;color:#fff">
                                                @elseif ($item->forma_envio == 'Mercado Libre')
                                                    <tr style="background: #fff701;color:#060606">
                                                @else
                                                    <tr style="background: #3f7bd6a3">
                                                @endif
                                                    <td>
                                                        <h5>
                                                            TC{{ $item->id }}
                                                        </h5>
                                                    </td>
                                                    <td>
                                                        <h5>
                                                            {{ $item->User->name }}
                                                            {{ $item->User->telefono }}
                                                        </h5>
                                                    </td>

                                                    <td>
                                                        En preparación <br>
                                                        @if ($item->forma_envio == 'envio')
                                                            Ecommerce Cosmica
                                                        @elseif ($item->forma_envio == 'Mercado Libre')
                                                            Meli
                                                        @else
                                                            <b style="color: #000;">Recoge en tienda</b>
                                                        @endif
                                                    </td>

                                                    <td>
                                                        {{ \Carbon\Carbon::parse($item->fecha_preparacion)
                                                                ->locale('es')
                                                                ->isoFormat('DD/MM/YY') }}
                                                        <br>
                                                        {{ \Carbon\Carbon::parse($item->fecha_preparacion)
                                                                ->locale('es')
                                                                ->isoFormat('hh:mm a') }}
                                                    </td>
                                                    <td><h5>${{ $item->pago }}</h5></td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('notas_cotizacion.imprimir_ecommerce', ['id' => $item->id]) }}">
                                                            <i class="fa fa-list-alt"></i>
                                                        </a>

                                                        <a class="text-center text-white btn btn-sm"
                                                            href="{{ route('pdf_etiqueta.bodega', ['tabla' => 'ecommerce_cosmica', 'id' => $item->id]) }}"
                                                            style="background: #7d2de6;">
                                                            <i class="fa fa-qrcode"></i>
                                                        </a>

                                                        @if ($item->forma_envio == 'PickUp')
                                                            <a type="button" class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#guiaModal{{$item->id}}" style="background: #e6ab2d; color: #ffff">
                                                                <i class="fa fa-truck"></i>
                                                            </a>
                                                        @else
                                                            <a class="text-center text-white btn btn-sm" href="{{asset('pago_fuera/'.$item->guia_doc) }}" download="{{asset('pago_fuera/'.$item->guia_doc) }}" style="background: #e6ab2d;">
                                                                <i class="fa fa-truck"></i>
                                                            </a>
                                                        @endif <br>

                                                        <a class="btn btn-sm btn-dark text-white" href="{{ route('preparacion_scaner.bodega_cosmica', $item->id) }}">
                                                            <i class="fa fa-barcode"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                @include('admin.cosmica_ecommerce.modal_direccion')
                                            @endforeach

                                            @foreach ($ordenes_con_producto_2080 as $item)

                                                @php
                                                    $status = $item->meli_data['status'] ?? null;
                                                    $dateCreated = $item->meli_data['date_created'] ?? null;
                                                    $isReadyOrPrepared = in_array($status, ['ready_to_ship', 'handling']);
                                                    $isDelayed = false;

                                                    if ($isReadyOrPrepared && $dateCreated) {
                                                        $shipmentDate = new DateTime($dateCreated);
                                                        $currentDate = new DateTime();
                                                        $isDelayed = $shipmentDate->format('Y-m-d') < $currentDate->format('Y-m-d');
                                                    }

                                                    $borderClass = ($item->item_id_meli && !$item->estadociudad) || $isDelayed ? 'border-yellow' : '';
                                                @endphp


                                                <tr class="{{ $borderClass }}" style="background: #cad686">
                                                    <td>
                                                        @if ($item->item_id_meli && !$item->estadociudad)
                                                            <img src="https://http2.mlstatic.com/frontend-assets/ml-web-navigation/ui-navigation/6.6.92/mercadolibre/logo_large_25years_v2.png" alt="Mercado Libre" width="60px">
                                                        @endif
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

                                                            @if($item->shippingId_meli && is_array($item->meli_data))
                                                            @php
                                                                $meliData = $item->meli_data; // Asegúrate de que esta variable contiene los datos de meli
                                                                // Obtener el color correspondiente al estado actual
                                                                $statusColor = $statusColors[$meliData['status']] ?? 'text-muted'; // Color predeterminado si no se encuentra el estado
                                                                $status = $meliData['status'] ?? 'N/A';
                                                                $dateCreated = $meliData['date_created'] ?? 'N/A';
                                                                $substatus = $meliData['substatus'] ?? null;
                                                                $statusHistory = $meliData['status_history'] ?? [];
                                                                $shipmentDate = new DateTime($dateCreated);
                                                                $currentDate = new DateTime();
                                                                $shipmentDateFormatted = $shipmentDate->format('Y-m-d');
                                                                $currentDateFormatted = $currentDate->format('Y-m-d');
                                                                $isReadyOrPrepared = in_array($status, ['ready_to_ship', 'handling']);
                                                                $isDelayed = $isReadyOrPrepared && $shipmentDateFormatted < $currentDateFormatted;
                                                                $substatusDroppedOff = in_array($substatus, ['dropped_off', 'in_hub']);
                                                                $isLabelNotPrinted = $isReadyOrPrepared && $substatus !== 'printed';
                                                            @endphp

                                                            <p>

                                                                @if ($isLabelNotPrinted)

                                                                @else
                                                                    @if ($isDelayed)
                                                                        <br><br>
                                                                        <strong style="color:red">Estás con demora</strong><br>
                                                                        Despacha el paquete cuanto antes en una agencia de Mercado Libre. La demora está afectando tu reputación.
                                                                    @endif
                                                                @endif
                                                            </p>
                                                        @endif

                                                                En preparación
                                                        </td>

                                                    <td>
                                                        {{ \Carbon\Carbon::parse($item->fecha_preparacion)
                                                                ->locale('es')
                                                                ->isoFormat('DD/MM/YY') }}
                                                        <br>
                                                        {{ \Carbon\Carbon::parse($item->fecha_preparacion)
                                                                ->locale('es')
                                                                ->isoFormat('hh:mm a') }}
                                                    </td>
                                                        <td><h5>${{ $item->total }}</h5></td>
                                                        <td>
                                                            <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('cotizacion_cosmica.imprimir', ['id' => $item->id]) }}">
                                                                <i class="fa fa-list-alt"></i>
                                                            </a>

                                                            <a class="text-center text-white btn btn-sm"
                                                                href="{{ route('pdf_etiqueta.bodega', ['tabla' => 'notas_cosmica_productos', 'id' => $item->id]) }}"
                                                                style="background: #7d2de6;">
                                                                <i class="fa fa-qrcode"></i>
                                                            </a>

                                                            @if ($item->metodo_pago == 'Recoger en Tienda' || $item->metodo_pago == 'Contra Entrega')
                                                                <a type="button" class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#guiaModal{{$item->id}}" style="background: #e6ab2d; color: #ffff">
                                                                    <i class="fa fa-truck"></i>
                                                                </a>
                                                            @else
                                                                <a class="text-center text-white btn btn-sm" href="{{asset('pago_fuera/'.$item->doc_guia) }}" download="{{asset('pago_fuera/'.$item->doc_guia) }}" style="background: #e6ab2d;">
                                                                    <i class="fa fa-truck"></i>
                                                                </a>
                                                            @endif <br>

                                                            <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusFechasModal{{$item->id}}">
                                                                <i class="fa fa-info"></i>
                                                            </a>

                                                            <a class="btn btn-sm btn-dark text-white" href="{{ route('preparacion_scaner_cosmica.bodega', $item->id) }}">
                                                                <i class="fa fa-barcode"></i>
                                                            </a>
                                                        </td>
                                                </tr>
                                                @include('admin.cotizacion.guia')
                                                @include('admin.bodega.modal_cosmica_estatus')
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
@endsection

@section('datatable')

<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>


<script type="text/javascript">

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


