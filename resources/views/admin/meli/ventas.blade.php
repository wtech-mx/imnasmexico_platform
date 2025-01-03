@extends('layouts.app_admin')

@section('template_title')
    Meli Ventas
@endsection

@php
    use Illuminate\Support\Str;
@endphp

@section('content')

    <style>

        .card_container{
            border-radius: 6px;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, .12);
        }

        .container_product{
            align-items: flex-start;
            background-color: #f5f5f5;
            border: none;
            border-radius: 5px;
            color: rgba(0, 0, 0, .55) !important;
            display: flex;
            margin: 0px 0px 0 10px;
            padding: 12px;
        }

        .stacked-images {
            display: inline-block;
            position: relative;
            width: 100px; /* Ajusta el ancho según sea necesario */
            height: 40px;
        }

        .stacked-image {
            width: 40px;
            height: 40px;
            border: 2px solid #fff; /* Bordes blancos para destacar cada imagen */
            border-radius: 4px;
            position: absolute;
            top: 0;
            left: 0;
            transform: translateX(calc(var(--i, 0) * 10%));
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        .stacked-image:nth-child(1) { --i: 0; }
        .stacked-image:nth-child(2) { --i: 1; }
        .stacked-image:nth-child(3) { --i: 2; }
        .stacked-image:nth-child(4) { --i: 3; }

        .stacked-more {
            position: absolute;
            top: 0;
            left: calc(40px * 3 + 10px); /* Posición después de la última imagen */
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            font-size: 12px;
            font-weight: bold;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
        }

    </style>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card" style="background: #f5f5f5">

                    <div class="card-header" style="background: #f5f5f5">

                        <div class="d-flex justify-content-between">

                            <a class="btn" id="regresar_btn" style="background: {{$configuracion->color_boton_close}}; color: #fff"><i class="fas fa-arrow-left"></i> Regresar </a>

                            <h3 class="mb-3">Meli Ventas</h3>

                            <button id="refresh-token-btn" class="btn btn-primary">Actualizar Token</button>

                        </div>
                    </div>

                        <div class="card-body">

                            <div class="row mb-2">
                                <div class="col-5">
                                    <p class="text-sm">
                                    Accesstoken : <br>
                                    {{ $meli->accesstoken }} <br>
                                    </p>
                                </div>

                                <div class="col-7">
                                    <p class="text-sm">
                                        Autorizacion : <br>
                                        {{ $meli->autorizacion }} <br>
                                    </p>
                                </div>
                                <div class="col-12">
                                    <form method="GET" action="{{ route('meli_ventas.index') }}" class="mb-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <p class="text-danger">Mercado Libre no deja traer registros posteriores a los 20 dias. <br>Pordefecto esta trayendo 20 dias antes del dia actual. <br>Usar el filtro para ampliar el rango de fechas (Sin que pase de 20 dias)</p>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="fecha_inicio" class="form-label">Fecha de inicio:</label>
                                                <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control" value="{{ old('fecha_inicio', substr($fechaInicio, 0, 10)) }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label for="fecha_fin" class="form-label">Fecha de fin:</label>
                                                <input type="date" id="fecha_fin" name="fecha_fin" class="form-control" value="{{ old('fecha_fin', substr($fechaFin, 0, 10)) }}">
                                            </div>
                                            <div class="col-md-4 d-flex align-items-end">
                                                <button type="submit" class="btn btn-success w-100">Filtrar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            @if (isset($errorMessage))
                                <div class="alert alert-warning">
                                    {{ $errorMessage }}
                                </div>
                            @endif

                            @if (!empty($groupedOrders))

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

                            @foreach ($groupedOrders as $index => $group)

                            @php
                                $isPack = count($group['orders']) > 1; // Determina si es un paquete
                                $identifier = $group['pack_id'] ?? $group['order_id']; // Usa pack_id si está disponible
                                $totalAmount = array_sum(array_column($group['orders'], 'total_paid_amount'));
                                $order = $group['orders'][0]; // Primer pedido del grupo
                                $orders = $isPack ? $group['orders'] : [$order]; // Productos a mostrar

                                // Obtener el estado y su color correspondiente
                                $shipmentStatus = $order['shipment_details']['status'] ?? 'unknown';
                                $statusColor = $statusColors[$shipmentStatus] ?? 'text-muted'; // Color predeterminado
                            @endphp

                                <div class="card_container bg-white p-3 mb-2">
                                    <div class="row">
                                        <div class="col-12 my-auto">
                                            <div class="d-flex justify-content-between" style="border-bottom: 1px solid rgba(0, 0, 0, .1);">
                                                <p>#{{ $identifier }} | {{ $order['payment_date'] }}</p>
                                                <p>{{ $order['buyer_nickname'] }} | <a href="" style="color: #3483fa">Mensajes</a></p>
                                            </div>

                                            <div class="row">
                                                <div class="col-9">
                                                    @if ($order['shipment_details'])
                                                    <p>
                                                        <strong class="{{ $statusColor }}">
                                                            {{ $statusTranslations[$order['shipment_details']['status']] ?? $order['shipment_details']['status'] }}
                                                        </strong> <br>
                                                        {{ $order['shipment_details']['date'] }}

                                                        @php
                                                        // Convertimos la fecha de envío a un objeto DateTime
                                                        $shipmentDate = new DateTime($order['shipment_details']['date']);
                                                        $currentDate = new DateTime();

                                                        // Extraemos solo la fecha (sin la hora) para ambas
                                                        $shipmentDateFormatted = $shipmentDate->format('Y-m-d');
                                                        $currentDateFormatted = $currentDate->format('Y-m-d');

                                                        // Verificamos si el estado es "Listo para enviar" o "Preparado"
                                                        $isReadyOrPrepared = in_array($order['shipment_details']['status'], ['ready_to_ship', 'handling']);
                                                        // Verificamos si ha pasado al menos un día (comparando las fechas)
                                                        $isDelayed = $isReadyOrPrepared && $shipmentDateFormatted < $currentDateFormatted;

                                                        // Verificamos si hay substatus diferente de "printed" y si está en el estado correcto
                                                        $substatus = $order['shipment_details']['substatus'] ?? null;
                                                        $substatus_dropped_off = in_array($order['shipment_details']['substatus'], ['dropped_off','in_hub']);
                                                        $isLabelNotPrinted = $isReadyOrPrepared && $substatus !== 'printed';
                                                    @endphp



                                                    @if ($isLabelNotPrinted)

                                                        @if($substatus_dropped_off == true)


                                                        @else
                                                        <br><br>
                                                        <strong style="color:orange">Etiqueta lista para imprimir</strong><br>
                                                        Asegúrate de imprimir la etiqueta antes de despachar el paquete.
                                                        @endif

                                                    @else

                                                    @if ($isDelayed)
                                                        <br><br>
                                                        <strong style="color:red">Estás con demora</strong><br>
                                                        Despacha el paquete cuanto antes en una agencia de Mercado Libre. La demora está afectando tu reputación.
                                                    @endif

                                                    @endif

                                                    </p>

                                                    @else
                                                        <p>Detalles del envío no disponibles.</p>
                                                    @endif
                                                </div>
                                                <div class="col-3 my-auto">
                                                    @if ($order['shipping_id'])
                                                            <a href="{{ route('meli.downloadShippingLabel', ['shippingId' => $order['shipping_id']]) }}"
                                                            class="btn btn-primary btn-sm">
                                                                Imprimir Guía
                                                            </a>
                                                        @else
                                                            <button class="btn btn-secondary btn-sm" disabled>Guía no disponible</button>
                                                    @endif

                                                    @if($order['cosmica_nota_id'])
                                                        {{-- <a href="{{ route('cotizacion_cosmica.meli_show', ['id' => $order['cosmica_nota_id']],$identifier) }}" class="btn text-white btn-sm" style="background: #322338" target="_blank">Ver Pedido</a> --}}
                                                        <a href="{{ route('cotizacion_cosmica.meli_show', ['id' => $order['cosmica_nota_id'], 'order_id' => $identifier]) }}" class="btn text-white btn-sm" style="background: #322338" target="_blank">Ver Pedido</a>
                                                    @endif

                                                    @if (!Str::contains($order['item_title'], 'Kit De Productos Cosmica'))
                                                        <a href="{{ route('cotizacion_cosmica.meli_show_order', ['order_id' => $order['shipping_id']]) }}"
                                                        class="btn text-white btn-sm"
                                                        style="background: #eaf209"
                                                        target="_blank">
                                                            Ver Pedido Meli
                                                        </a>
                                                    @endif


                                                </div>
                                            </div>
                                        </div>

                                        @if ($isPack)
                                            <div class="col-12 my-auto">
                                                <div class="d-flex justify-content-between mt-3 mb-3">
                                                    <p class="my-auto">
                                                        <a class="" data-bs-toggle="collapse" data-bs-target="#accordion-{{ $index }}" style="margin-right: 1rem">
                                                            <img src="{{ asset('assets/user/icons/flecha-hacia-abajo.png') }}"width="30px" >
                                                        </a>
                                                        <img src="{{ $order['thumbnail_url'] ?? $order['picture_url'] }}" alt="Producto" style="width: 40px">
                                                        Paquete de <strong>{{ count($group['orders']) }}</strong> productos
                                                    </p>
                                                    <p class="my-auto">
                                                        Total  <strong>${{ number_format($totalAmount, 2) }}</strong>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="collapse" id="accordion-{{ $index }}">
                                                @foreach ($group['orders'] as $order)
                                                <div class="row container_product" style="border-bottom: 1px solid rgba(0, 0, 0, .1);">
                                                    <div class="col-6 my-auto">
                                                        <div class="row container_product_img">
                                                            <div class="col-3 my-auto">
                                                                <img src="{{ $order['thumbnail_url'] ?? $order['picture_url'] }}" alt="Producto" style="width: 40px">
                                                            </div>
                                                            <div class="col-9 my-auto">
                                                                <h4 style="color: rgba(0, 0, 0, .55);font-size:14px">{{ $order['item_title'] }}</h4>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-3 my-auto">
                                                        <p style="color: rgba(0, 0, 0, .55);font-size:14px"><strong>${{ number_format($order['total_paid_amount'], 2) }}</strong></p>
                                                    </div>
                                                    <div class="col-3 my-auto">
                                                        <p style="color: rgba(0, 0, 0, .55);font-size:14px"><strong>{{ $order['quantity'] }}</strong></p>
                                                    </div>
                                                </div>
                                            @endforeach
                                            </div>
                                        @else
                                            <div class="row container_product">
                                                <div class="col-6 my-auto">
                                                    <div class="row container_product_img">
                                                        <div class="col-3 my-auto">
                                                            <img src="{{ $order['thumbnail_url'] ?? $order['picture_url'] }}" alt="Producto" style="width: 40px">
                                                        </div>
                                                        <div class="col-9 my-auto">
                                                            <h4 style="color: rgba(0, 0, 0, .55);font-size:14px">{{ $order['item_title'] }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-3 my-auto">
                                                    <p style="color: rgba(0, 0, 0, .55);font-size:14px"><strong>${{ number_format($order['total_paid_amount'], 2) }}</strong></p>
                                                </div>
                                                <div class="col-3 my-auto">
                                                    <p style="color: rgba(0, 0, 0, .55);font-size:14px"><strong>{{ $order['quantity'] }}</strong></p>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                            @else
                                @if (!isset($errorMessage))
                                    <div class="alert alert-info">
                                        No hay órdenes disponibles en este momento.
                                    </div>
                                @endif
                            @endif

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



</script>

<script>
    document.getElementById('refresh-token-btn').addEventListener('click', function() {
        fetch('{{ route('meli.refreshToken') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.access_token) {
                alert('Token actualizado: ' + data.access_token + '/ AUTH  actualizado: ' + data.autorizacion);
                location.reload(); // Recargar la página después de actualizar el token
            } else {
                alert('Error al actualizar el token: ' + (data.message || 'Desconocido'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ocurrió un error al actualizar el token.');
        });
    });
</script>

@endsection
