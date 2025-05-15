@extends('layouts.app_admin')

@section('template_title')
    Bodega Preparados
@endsection

@section('content')
<style>
    .border-yellow {
        background: #fff61a!important;
    }
</style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <h2 class="mb-3">Notas ventas del Mes Preparados</h2>

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

                                                <a class="text-center text-white btn btn-sm"
                                                    href="{{ route('pdf_etiqueta.bodega', ['tabla' => 'notas_productos', 'id' => $item->id]) }}"
                                                    style="background: #7d2de6;">
                                                    <i class="fa fa-qrcode"></i>
                                                </a>

                                                <a type="button" class="btn btn-sm btn-danger text-white" data-bs-toggle="modal" data-bs-target="#estatusFechasModal{{$item->id}}">
                                                    <i class="fa fa-info"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @include('admin.cotizacion.guia')
                                        @include('admin.bodega.modal_estatus')
                                        @include('admin.bodega.modal_fechas')
                                    @endforeach

                                    @php
                                        // Diccionario de traducciones de estados
                                        $statusTranslations = [
                                            'delivered' => 'Entregado',
                                            'shipped' => 'En camino',
                                            'ready_to_ship' => 'Listo para enviar',
                                            'handling' => 'Preparado',
                                            'cancelled' => 'Cancelado',
                                        ];

                                        // Diccionario de colores para los estados
                                        $statusColors = [
                                            'delivered' => 'text-success', // Verde
                                            'shipped' => 'text-primary',  // Azul
                                            'ready_to_ship' => 'text-dark', // Amarillo
                                            'handling' => 'text-info',    // Cian
                                            'cancelled' => 'text-danger', // Rojo
                                        ];


                                    @endphp

                                    @foreach ($notas_cosmica_preparado as $item)
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


                                        <tr class="{{ $borderClass }}" style="background: #d486d6">
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
                                                @if($item->shippingId_meli)
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

                                                <a class="text-center text-white btn btn-sm"
                                                    href="{{ route('pdf_etiqueta.bodega', ['tabla' => 'notas_cosmica_productos', 'id' => $item->id]) }}"
                                                    style="background: #7d2de6;">
                                                    <i class="fa fa-qrcode"></i>
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
                                        {{-- @include('admin.cotizacion_cosmica.guia') --}}
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
                                                {{-- <a type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#modal_productos_{{ $order->id }}">
                                                    <i class="fa fa-list-alt"></i>
                                                </a> --}}

                                                <a class="btn btn-sm btn-info text-white" href="{{ route('woo_nas_orders.pdf', $order->id) }}" target="_blank">
                                                    <i class="fa fa-file-pdf"></i>
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

                                        {{-- @include('admin.bodega.modal_productos') --}}
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

                                    @foreach ($notas_cosmica_on as $item)
                                        <tr style="background: #80486B;color:#fff">
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
                                                <a type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                    En preparación
                                                </a>
                                                <br>
                                                Ecommerce Cosmica
                                            </td>

                                            <td>
                                                <h5>
                                                    {{ \Carbon\Carbon::parse($item->fecha_preparacion)->isoFormat('dddd DD MMMM hh:mm a') }}
                                                </h5>
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
                                                @endif

                                                <a class="btn btn-sm btn-dark text-white" target="_blank" href="{{ route('preparacion_scaner.bodega_cosmica', $item->id) }}">
                                                    <i class="fa fa-barcode"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        @include('admin.bodega.modal_cosmi')
                                        @include('admin.cosmica_ecommerce.modal_direccion')
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

                                                {{-- <a class="btn btn-sm btn-dark text-white" href="{{ route('preparacion_scaner.nas', $item->id) }}">
                                                    <i class="fa fa-barcode"></i>
                                                </a> --}}
                                            </td>
                                        </tr>
                                        @include('admin.notas_productos.modal_direccion')
                                    @endforeach

                                </tbody>
                            </table>

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

    const dataTableSearch2 = new simpleDatatables.DataTable("#datatable-search2", {
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


