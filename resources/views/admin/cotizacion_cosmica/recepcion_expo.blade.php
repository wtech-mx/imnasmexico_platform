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
                                    <a class="nav-link active" href="{{ route('index_cotizaciones_cosmica_expo.cotizador') }}">
                                        Cotizaciones <img src="{{ asset('assets/cam/comprobante.png') }}" alt="" width="35px">
                                    </a>

                                    <a class="nav-link" href="{{ route('index_recepcion_cosmica_expo.cotizador') }}">
                                        Recepción <img src="{{ asset('assets/cam/cheque.png') }}" alt="" width="35px">
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
                                            <tr style="background: #d486d6">
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
                                                            {{ $item->User->name }}
                                                        @endif
                                                    </h5>
                                                </td>

                                                <td>
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

    const dataTableSearch2 = new simpleDatatables.DataTable("#datatable-search2", {
        searchable: true,
        fixedHeight: false
    });

    const dataTableSearch3 = new simpleDatatables.DataTable("#datatable-search3", {
        searchable: true,
        fixedHeight: false
    });

</script>

@endsection


