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
                                                <a type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#estatus_woo_{{ $order->id }}">
                                                    {{ $order->status }}
                                                </a>
                                            @elseif($order->status == 'en_preparacion')
                                                <a type="button" class="btn btn-sm btn-dark" data-bs-toggle="modal" data-bs-target="#estatus_woo_{{ $order->id }}">
                                                    {{ $order->status }}
                                                </a>
                                            @elseif($order->status == 'preparados')
                                                <a type="button" class="btn btn-sm btn-ligth" data-bs-toggle="modal" data-bs-target="#estatus_woo_{{ $order->id }}">
                                                    {{ $order->status }}
                                                </a>
                                            @elseif($order->status == 'enviados')
                                                <a type="button" class="btn btn-sm btn-secundary" data-bs-toggle="modal" data-bs-target="#estatus_woo_{{ $order->id }}">
                                                    {{ $order->status }}
                                                </a>
                                            @endif

                                        </td>
                                        <td>${{ $order->shipping_total }}</td>
                                        <td>${{ $order->total }}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->date_created)->format('d/m/y \a \l\a\s g:i a') }}</td>

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

