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
                                        <th>payment_method_title</th>
                                        <th>billing</th>
                                        <th>shipping</th>
                                        <th>productos</th>
                                        <th>status</th>
                                        <th>shipping_total</th>
                                        <th>total</th>
                                        <th>Fecha</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->payment_method_title }}</td>
                                        <td>
                                            <!-- Botón para colapsar la información de billing -->
                                            <a data-bs-toggle="collapse" href="#billing{{ $order->id }}" role="button" aria-expanded="false" aria-controls="billing{{ $order->id }}">
                                                Ver
                                            </a>
                                            <div class="collapse mt-2" id="billing{{ $order->id }}">
                                                <ul class="">
                                                    <li class="">Nombre: {{ $order->billing->first_name }} {{ $order->billing->last_name }}</li>
                                                    <li class="">Compañía: {{ $order->billing->company }}</li>
                                                    <li class="">Dirección: {{ $order->billing->address_1 }} {{ $order->billing->address_2 }}</li>
                                                    <li class="">Ciudad: {{ $order->billing->city }}</li>
                                                    <li class="">Estado: {{ $order->billing->state }}</li>
                                                    <li class="">Código Postal: {{ $order->billing->postcode }}</li>
                                                    <li class="">País: {{ $order->billing->country }}</li>
                                                    <li class="">Email: {{ $order->billing->email }}</li>
                                                    <li class="">Teléfono: {{ $order->billing->phone }}</li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            <!-- Botón para colapsar la información de shipping -->
                                            <a data-bs-toggle="collapse" href="#shipping{{ $order->id }}" role="button" aria-expanded="false" aria-controls="shipping{{ $order->id }}">
                                                Ver
                                            </a>
                                            <div class="collapse mt-2" id="shipping{{ $order->id }}">
                                                <ul class="">
                                                    <li class="">Nombre: {{ $order->shipping->first_name }} {{ $order->shipping->last_name }}</li>
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
                                            <!-- Botón para colapsar la información de productos -->
                                            <a data-bs-toggle="collapse" href="#productos{{ $order->id }}" role="button" aria-expanded="false" aria-controls="productos{{ $order->id }}">
                                                Ver
                                            </a>
                                            <div class="collapse mt-2" id="productos{{ $order->id }}">
                                                <ul class="">
                                                    @foreach ($order->line_items as $item)
                                                    <li class="">
                                                        {{ $item->name }} - Cantidad: {{ $item->quantity }}
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </td>
                                        <td>{{ $order->status }}</td>
                                        <td>${{ $order->shipping_total }}</td>
                                        <td>${{ $order->total }}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->date_created)->format('d/m/y \a \l\a\s g:i a') }}</td>

                                    </tr>
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
</script>

@endsection

