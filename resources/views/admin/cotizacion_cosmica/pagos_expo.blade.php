@extends('layouts.app_admin')

@section('template_title')
     Pagos Expo Cosmica
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

                            <h2 class="mb-3">Pagos Expo Cosmica</h2>

                            <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                ¿Como funciona?
                            </a>


                        </div>
                    </div>
                    <div class="card-body">

                        @if (isset($errorMessage))
                            <div class="alert alert-warning">
                                {{ $errorMessage }}
                            </div>
                        @endif

                        <div class="table-responsive">

                            <nav>
                                <div class="nav nav-tabs" >
                                    <a class="nav-link" href="{{ route('index_cotizaciones_cosmica_expo.cotizador') }}">
                                        Cotizaciones <img src="{{ asset('assets/cam/comprobante.png') }}" alt="" width="35px">
                                    </a>

                                    <a class="nav-link active" href="{{ route('index_pagos_cosmica_expo.cotizador') }}">
                                        Pago <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                    </a>

                                    <a class="nav-link" href="{{ route('index_recepcion_cosmica_expo.cotizador') }}">
                                        Recepción <img src="{{ asset('assets/cam/package.png') }}" alt="" width="35px">
                                    </a>
                                </div>
                            </nav>


                            <div class="table-responsive">
                                <table class="table table-flush" id="datatable-search4">
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
                                        @foreach ($notas as $item)
                                            <tr id="nota-{{ $item->id }}" class="{{ $item->pago ? 'table-success' : '' }}">
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
                                                            {{ $item->nombre }}
                                                        @else
                                                            {{ $item->User->name }} <br> {{ $item->User->telefono }}
                                                        @endif
                                                    </h5>
                                                </td>

                                                <td>
                                                    @php
                                                    $fecha = $item->fecha;
                                                    $fecha_timestamp = strtotime($fecha);
                                                    $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                                    @endphp
                                                    <h5>
                                                        {{$fecha_formateada}}
                                                    </h5>
                                                </td>
                                                <td><h5>${{ $item->total }}</h5></td>
                                                <td>

                                                    {{-- <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('cotizacion_cosmica.imprimir', ['id' => $item->id]) }}">
                                                        <i class="fa fa-file"></i>
                                                    </a> --}}

                                                    <input data-id="{{ $item->id }}" class="toggle-class" type="checkbox"
                                                    data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                    data-on="Active" data-off="InActive" {{ $item->pago ? 'checked' : '' }}>
                                                </td>
                                            </tr>
                                            @include('admin.cotizacion.modal_estatus')
                                            @include('admin.cotizacion.modal_products')
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

    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search4", {
        searchable: true,
        fixedHeight: false
    });

    $(function() {
        $('.table-responsive').on('change', '.toggle-class', function() {
            const $chk = $(this);
            const abono = $chk.prop('checked') ? 1 : 0;
            const id    = $chk.data('id');
            console.log(abono);
            $.ajax({
            type: "GET",
            dataType: "json",
            url: '{{ route("notas.pago.toggle") }}',
            data: { abono, id },
            success: function(data) {
                if (data.success) {
                // aquí aplicamos o quitamos la clase según el valor de abono
                $(`#nota-${id}`).toggleClass('table-success', abono === 1);
                } else {
                // si algo falla, revertimos el checkbox
                $chk.prop('checked', !abono);
                alert('No se pudo actualizar el pago');
                }
            },
            error: function() {
                // en caso de error de red o servidor, también revertimos el checkbox
                $chk.prop('checked', !abono);
                alert('Error al comunicarse con el servidor');
            }
            });
        });
    });
</script>

@endsection


