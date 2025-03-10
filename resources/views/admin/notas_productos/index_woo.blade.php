@extends('layouts.app_admin')

@section('template_title')
    Notas Productos Woocomerce
@endsection

@section('css')

 @endsection

@php
    $fecha = date('Y-m-d');
@endphp
@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-body p-2">
                        <form action="{{ route('pedidos_woo.index') }}" method="GET">
                            <div class="row">
                                <div class="col-12">
                                    <h3>Ordenes de la tienda Online</h3>
                                </div>
                                <div class="col-md-5">
                                    <label for="start_date">Fecha de Inicio:</label>
                                    <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                                </div>
                                <div class="col-md-5">
                                    <label for="end_date">Fecha de Fin:</label>
                                    <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                                </div>
                                <div class="col-md-2 my-auto">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-sm btn-success form-control">Buscar</button>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-12 mt-3">
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('notas_productos.index') }}" class="btn btn-sm btn-success m-2" style="background: #836262">Tienda Fisica
                                        <img src="{{asset('assets/user/icons/carrito-de-compras.webp') }}" alt="Imagen" style="width: 25px; height: 25px;"/>
                                    </a>
                                    <a href="{{ route('pedidos_woo.index') }}" class="btn btn-sm m-2" style="background:#f5ece4;">Tienda Online
                                        <img src="{{asset('assets/user/icons/carrito-de-compras.webp') }}" alt="Imagen" style="width: 25px; height: 25px;"/>
                                    </a>

                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <div class="d-flex justify-content-around">
                                    <span class="badge rounded-pill text-white text-bg-primary">Processing (Pagado)</span>
                                    <span class="badge rounded-pill text-white text-bg-warning">Pending (Pendiente Pago)</span>
                                    <span class="badge rounded-pill text-white text-bg-success">Completado</span>
                                    <span class="badge rounded-pill text-white text-bg-danger">Cancelled (Cancelado)</span>
                                    <span class="badge rounded-pill text-white text-bg-info">Guia Cargada</span>
                                    <span class="badge rounded-pill text-dark text-bg-light">Preparado</span>
                                    <span class="badge rounded-pill text-white text-bg-secondary">Enviado</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-search">
                                <thead class="thead">
                                    <tr>
                                        <th>id</th>
                                        <th>Cliente</th>
                                        <th>productos</th>
                                        <th>Envio</th>
                                        <th>status</th>
                                        <th>Costo de envio</th>
                                        <th>Total</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>

                                        <td>
                                            <ul>
                                                <li><strong>Nombre:</strong>{{ $order->billing->first_name }} {{ $order->billing->last_name }}</li>
                                                <li><strong>Correo:</strong>{{ $order->billing->email }}</li>
                                                <li><strong>Telefono:</strong>{{ $order->billing->phone }}</li>
                                                <li><strong>Metodo de Pago:</strong>{{ $order->payment_method_title }}</li>
                                                <li><a href="https://imnasmexico.com/new/wp-admin/post.php?post={{ $order->id }}&action=edit" target="_blank" rel="noopener noreferrer"><strong>Ver Orden</strong></a></li>
                                            </ul>
                                        </td>
                                        <td>
                                            <!-- Botón para colapsar la información de productos -->
                                            <a class="btn btn-xs btn-outline-dark" data-bs-toggle="collapse" href="#productos{{ $order->id }}" role="button" aria-expanded="false" aria-controls="productos{{ $order->id }}">
                                                Ver
                                            </a>
                                            <div class="collapse mt-2" id="productos{{ $order->id }}">
                                                <ul class="">
                                                    @foreach ($order->line_items as $item)
                                                    <li class="">
                                                        {{ $item->name }} - {{ $item->quantity }}
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            <!-- Botón para colapsar la información de shipping -->
                                            <a class="btn btn-xs btn-outline-primary" data-bs-toggle="collapse" href="#shipping{{ $order->id }}" role="button" aria-expanded="false" aria-controls="shipping{{ $order->id }}">
                                                Ver
                                            </a>
                                            <div class="collapse mt-2" id="shipping{{ $order->id }}">
                                                <ul class="">
                                                    <li class="">Compañía: {{ $order->shipping->company }}</li>
                                                    <li class="">Dirección: {{ $order->shipping->address_1 }} {{ $order->shipping->address_2 }}</li>
                                                    <li class="">Ciudad: {{ $order->shipping->city }}</li>
                                                    <li class="">Estado: {{ $order->shipping->state }}</li>
                                                    <li class="">Código Postal: {{ $order->shipping->postcode }}</li>
                                                    <li class="">País: {{ $order->shipping->country }}</li>
                                                </ul>
                                            </div>
                                        </td>

                                        <td>

                                            @if($order->status == 'completed')
                                                <a type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#estatus_woo_{{ $order->id }}">
                                                {{ $order->status }}
                                                </a>
                                            @elseif($order->status == 'Failed')
                                                <a type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#estatus_woo_{{ $order->id }}">
                                                    {{ $order->status }}
                                                </a>
                                            @elseif($order->status == 'pending')
                                                <a type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#estatus_woo_{{ $order->id }}">
                                                    {{ $order->status }}
                                                </a>
                                            @elseif($order->status == 'guia_cargada')
                                                <a type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#estatus_woo_{{ $order->id }}">
                                                    {{ $order->status }}
                                                </a>
                                            @elseif($order->status == 'en_preparacion')
                                                <a type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#estatus_woo_{{ $order->id }}">
                                                    {{ $order->status }}
                                                </a>
                                            @elseif($order->status == 'preparados')
                                                <a type="button" class="btn btn-sm btn-light" data-bs-toggle="modal" data-bs-target="#estatus_woo_{{ $order->id }}">
                                                    {{ $order->status }}
                                                </a>
                                            @elseif($order->status == 'enviados')
                                                <a type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#estatus_woo_{{ $order->id }}">
                                                    {{ $order->status }}
                                                </a>
                                            @elseif($order->status == 'processing')
                                                <a type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#estatus_woo_{{ $order->id }}">
                                                    {{ $order->status }}
                                                </a>
                                            @elseif($order->status == 'cancelled')
                                                <a type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#estatus_woo_{{ $order->id }}">
                                                    {{ $order->status }}
                                                </a>
                                            @endif

                                        </td>
                                        <td>${{ $order->shipping_total }}</td>
                                        <td>${{ $order->total }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($order->date_created)->format('d/m/y') }} <br>
                                            a las {{ \Carbon\Carbon::parse($order->date_created)->format('g:i a') }}
                                        </td>

                                    </tr>
                                    @include('admin.notas_productos.modal_estatus_woo')
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

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });

    document.addEventListener('DOMContentLoaded', function () {
    const statusSelect = document.querySelector('.status-select');
    const fileUploadDiv = document.getElementById('file-upload');

    statusSelect.addEventListener('change', function () {
        if (this.value === 'guia_cargada') {
            fileUploadDiv.style.display = 'block';
        } else {
            fileUploadDiv.style.display = 'none';
        }
    });

    // Mostrar el campo de archivo si 'guia_cargada' ya está seleccionado
    if (statusSelect.value === 'guia_cargada') {
        fileUploadDiv.style.display = 'block';
    }
});


</script>

@endsection

