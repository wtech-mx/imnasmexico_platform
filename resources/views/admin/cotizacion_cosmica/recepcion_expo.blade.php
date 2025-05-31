@extends('layouts.app_admin')

@section('template_title')
     Recepción Expo
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

                            <h2 class="mb-3">Recepción Expo</h2>

                            <a href="{{ route('index_cosmica_new.cotizador') }}" target="_blank" class="btn bg-success text-white" >
                                Cotizador
                            </a>

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

                                    <a class="nav-link" href="{{ route('index_pagos_cosmica_expo.cotizador') }}">
                                        Pago <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                    </a>

                                    <a class="nav-link active" href="{{ route('index_recepcion_cosmica_expo.cotizador') }}">
                                        Recepción <img src="{{ asset('assets/cam/package.png') }}" alt="" width="35px">
                                    </a>
                                </div>
                            </nav>

                            <table class="table table-flush" id="datatable-search4">
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
                                    @foreach ($notas as $item)
                                            <tr id="nota-{{ $item->id }}" class="{{ $item->pago ? 'table-success' : '' }}">
                                                <td>
                                                    <h5>
                                                        {{ $item->folio }}
                                                    </h5>
                                                </td>

                                                <td>
                                                    <h5>
                                                        @if ($item->id_usuario == NULL)
                                                            {{ $item->nombre }} <br> {{ $item->telefono }}
                                                        @else
                                                            {{ $item->User->name }} <br>  {{ $item->User->telefono }}
                                                        @endif
                                                    </h5>
                                                </td>

                                                <td>
                                                    @if ($item->estatus_cotizacion == 'Entregado')
                                                        <span class="badge bg-success">Empaquetado</span>
                                                    @elseif ($item->envio == 'Si')
                                                        <span class="badge bg-info">Para enviar</span>
                                                    @else
                                                        <span class="badge bg-warning">Pendiente</span>
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
                                                        <a type="button" class="btn btn-sm btn-info text-white" data-bs-toggle="modal" data-bs-target="#modal_productos_{{ $item->id }}">
                                                            <i class="fa fa-list-alt"></i>
                                                        </a>
                                                </td>
                                            </tr>
                                        @include('admin.bodega.modal_productos')
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

    $(document).ready(function() {
        $('.cliente').select2();
        $('.phone').select2();
        $('.administradores').select2();
    });

    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search4", {
        searchable: true,
        fixedHeight: false
    });

    document.addEventListener('DOMContentLoaded', function(){

        function refrescarEstatus() {
            const ids = Array.from(document.querySelectorAll('tr[id^="nota-"]'))
                            .map(tr => tr.id.replace('nota-',''));
            if (!ids.length) return;

            fetch('{{ route("notas.estatus") }}?ids=' + ids.join(','))
            .then(res => res.json())
            .then(data => {
                console.log('estatus recibidos', data);
                data.forEach(item => {
                const tr = document.getElementById(`nota-${item.id}`);
                if (!tr) return;
                tr.classList.toggle('table-success', item.pago === 1);
                });
            })
            .catch(console.error);
        }

        // Ejecuta al cargar…
        refrescarEstatus();
        // …y cada 30s:
        setInterval(refrescarEstatus, 10000);

    });

</script>

@endsection


