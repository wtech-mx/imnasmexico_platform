@extends('layouts.app_admin')

@section('template_title')
    Compras Online
@endsection

@section('css')
 <!-- Select2  -->
 <link rel="stylesheet" href="{{asset('assets/admin/vendor/select2/dist/css/select2.min.css')}}">
 <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet">
 <link href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css" rel="stylesheet">
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

                            <h2 class="mb-3">Compras Online</h2>

                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>
                        </div>
                    </div>
                    <div class="card">
                        <form action="{{ route('advance_productos.buscador') }}" method="GET" >
                            @csrf

                            <div class="card-body" style="padding-left: 1.5rem; padding-top: 1rem;">
                                <h5>Filtro</h5>
                                    <div class="row">
                                        <div class="col-3">
                                            <label for="user_id">Fecha Inicio:</label>
                                            <input type="date" class="form-control" name="fecha_inicio">
                                        </div>

                                        <div class="col-3">
                                            <label for="user_id">Fecha Fin:</label>
                                            <input type="date" class="form-control" name="fecha_fin">
                                        </div>


                                        <div class="col-3">
                                            <br>
                                            <button class="btn btn-sm mb-0 mt-sm-0 mt-1" type="submit" style="background-color: #F82018; color: #ffffff;">Buscar</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 mt-3">
                                            <div class="d-flex justify-content-center">
                                                <a href="{{ route('notas_productos.index') }}" class="btn btn-sm btn-success m-2" style="background: #836262">Tienda Fisica
                                                    <img src="{{asset('assets/user/icons/carrito-de-compras.webp') }}" alt="Imagen" style="width: 25px; height: 25px;"/>
                                                </a>
                                                <a href="{{ route('compras.nas') }}" class="btn btn-sm m-2" style="background:#f5ece4;">Tienda Online
                                                    <img src="{{asset('assets/user/icons/carrito-de-compras.webp') }}" alt="Imagen" style="width: 25px; height: 25px;"/>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-search">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Cliente</th>
                                        <th>fecha</th>
                                        <th>Total</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders_pagadas as $item)
                                        <tr>
                                            <td>
                                                <h5>TN{{ $item->id }}</h5>
                                            </td>
                                            <td>
                                                @if ($item->estatus_bodega == 'En preparacion')
                                                    <span class="badge" style="color: #ffd709; background-color: #f8fee0;">En preparacion</span>
                                                @elseif ($item->estatus_bodega == 'Preparado')
                                                    <span class="badge" style="color: #5904f7; background-color: #f0e0fe;">Preparado</span>
                                                @elseif ($item->estatus_bodega == 'Enviado')
                                                    <span class="badge badge-success">Enviado</span>
                                                @else
                                                    <span class="badge badge-info">Enviar a bodega</span>
                                                @endif
                                                <h5>
                                                    {{ $item->User->name }}  <br>
                                                    {{ $item->User->telefono }}
                                                </h5>
                                            </td>
                                            <td>
                                                @php
                                                    $fecha = $item->fecha;
                                                    $fechaCarbon = \Carbon\Carbon::parse($fecha);
                                                @endphp
                                                <h5>
                                                    {{ $fechaCarbon->format('j/n/y') }} <br>
                                                    {{ $fechaCarbon->format('g:i A') }}
                                                </h5>
                                            </td>
                                            <td>
                                                <h5>${{ $item->pago }}</h5>
                                                @if ($item->forma_envio == 'envio')
                                                    <span class="badge badge-success">Envio</span>
                                                @else
                                                    <span class="badge badge-warning">Recoge en tienda</span>
                                                @endif
                                            </td>
                                            <td>
                                                @php
                                                    $fecha = $item->created_at;
                                                    $fecha_timestamp = strtotime($fecha);
                                                    $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                                @endphp
                                                <div class="row d-block">

                                                    <div class="col-6">
                                                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('imprimir_admin.nas', $item->id) }}">
                                                            <i class="fa fa-file"></i>
                                                        </a>
                                                        <a type="button" class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#guiaModal{{$item->id}}" style="background: #e6ab2d; color: #ffff">
                                                            <i class="fa fa-truck"></i>
                                                        </a>
                                                    </div>


                                                </div>
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
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>

 <script src="https://cdn.datatables.net/responsive/2.3.0/js/dataTables.responsive.min.js"></script>
 <script src="https://cdn.datatables.net/responsive/2.3.0/js/responsive.bootstrap4.min.js"></script>

 <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>

<script type="text/javascript">

    $(document).ready(function() {
        $('.cliente').select2();
        $('.administradores').select2();
        $('.phone').select2();
    });

    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
        searchable: true,
        fixedHeight: false
    });
</script>

@endsection


