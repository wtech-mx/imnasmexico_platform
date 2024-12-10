@extends('layouts.app_admin')

@section('template_title')
    Meli Ventas
@endsection

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

                            @can('client-create')
                            <a class="btn btn-sm btn-success" href="{{ route('comentarios.create') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                <i class="fa fa-fw fa-edit"></i> Crear </a>
                            @endcan

                        </div>
                    </div>

                        <div class="card-body">

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
                            @endphp

                            @foreach ($groupedOrders as $index => $group)

                            @php
                                $isPack = count($group['orders']) > 1; // Determina si es un paquete
                                $identifier = $group['pack_id'] ?? $group['order_id']; // Usa pack_id si está disponible
                                $totalAmount = array_sum(array_column($group['orders'], 'total_paid_amount'));
                                $order = $group['orders'][0]; // Primer pedido del grupo
                                $orders = $isPack ? $group['orders'] : [$order]; // Productos a mostrar
                            @endphp

                                <div class="card_container bg-white p-3 mb-2">
                                    <div class="row">
                                        <div class="col-12 my-auto">
                                            <div class="d-flex justify-content-between" style="border-bottom: 1px solid rgba(0, 0, 0, .1);">
                                                <p>#{{ $identifier }} | {{ $order['payment_date'] }}</p>
                                                <p>{{ $order['buyer_nickname'] }} | <a href="" style="color: #3483fa">Mensajes</a></p>
                                            </div>

                                            <div class="row">
                                                <div class="col-6">
                                                    @if ($order['shipment_details'])
                                                        <p>
                                                            <strong>{{ $statusTranslations[$order['shipment_details']['status']] ?? $order['shipment_details']['status'] }}</strong> <br>
                                                            {{ $order['shipment_details']['date'] }}
                                                        </p>
                                                    @else
                                                        <p>Detalles del envío no disponibles.</p>
                                                    @endif
                                                </div>
                                                <div class="col-6">
                                                    <!-- Detalles adicionales -->
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
                alert('Token actualizado exitosamente: ' + data.access_token);
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
