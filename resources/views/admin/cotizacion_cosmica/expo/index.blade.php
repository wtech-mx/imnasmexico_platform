@extends('layouts.app_admin')

@section('template_title')
    Cotizaciones Expo
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-header">
                                <div style="display: flex; justify-content: space-between; align-items: center;">

                                    <h2 class="mb-3">Cotizaciones Expo</h2>

                                    <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                        ¿Como funciona?
                                    </a>

                                    @can('nota-productos-crear')
                                        <a class="btn btn-sm btn-success" href="{{ route('corizacion_expo.create') }}" style="background: #322338; color: #ffff; font-size: 20px;">
                                            <i class="fa fa-fw fa-edit"></i> Crear
                                        </a>
                                    @endcan
                                </div>
                            </div>

                            <div class="card-body">
                                <h5>Filtro</h5>
                                <form action="{{ route('corizacion_expo.buscador') }}" method="GET" >
                                    <div class="row">
                                        <div class="col-9">
                                            <label for="user_id">Seleccionar Cotizacion:</label>
                                            <select class="form-control cliente" name="folio" id="folio">
                                                <option selected value="">Buscar Folio</option>
                                                @foreach($notas as $notas)
                                                    <option value="{{ $notas->id }}">{{ $notas->folio }} -
                                                        @if ($notas->id_usuario == NULL)
                                                            {{ $notas->nombre }} #{{ $notas->telefono }}
                                                        @else
                                                            {{ $notas->User->name }}
                                                        @endif
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-3">
                                            <br>
                                            <button class="btn btn-sm mb-0 mt-sm-0 mt-1" type="submit" style="background-color: #F82018; color: #ffffff;">Buscar</button>
                                        </div>
                                    </div>
                                </form>

                                <form class="row mt-3" action="{{ route('pdf_expo.pdf') }}" method="GET" >
                                    <button class="btn btn-dark btn-sm" type="submit" style=""><i class="fa fa-file-pdf"></i> PDF </button>
                                </form>
                                <div class="table-responsive">
                                    <table class="table table-flush" id="datatable-search">
                                        <thead class="thead">
                                            <tr>
                                                <th>No</th>
                                                <th>Cliente</th>
                                                <th>Total</th>
                                                <th>Estatus</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(Route::currentRouteName() != 'corizacion_expo.index')
                                                <tr>
                                                    <td>
                                                        <h5>{{ $item->folio }}</h5>
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
                                                    <td><h5>${{ $item->total }}</h5></td>
                                                    <td>

                                                        @if ($item->estatus_cotizacion == 'Aprobada')

                                                        <a class="btn btn-xs btn-primary" style="background: #06a306;">
                                                            Aprobada
                                                        </a>

                                                        @else

                                                        <a class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#estatus_{{ $item->id }}" title="Editar Estatus" style="background: #b600e3;">
                                                            Pendiente
                                                        </a>

                                                        @endif

                                                    </td>
                                                    <td>
                                                        @if($item->total <= '700')

                                                        @else
                                                            <a class="btn btn-xs" target="_blank"  href="{{ route('cotizacion_cosmica.meli_show', $item->id) }}"  style="background: #FFE600; color: #ffff">
                                                                <img src="https://http2.mlstatic.com/frontend-assets/ml-web-navigation/ui-navigation/6.6.92/mercadolibre/logo_large_25years_v2.png" alt="" style="width: 35px">
                                                            </a>
                                                        @endif

                                                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('cotizacion_cosmica.imprimir', ['id' => $item->id]) }}">
                                                            <i class="fa fa-file"></i>
                                                        </a>

                                                        {{-- <a class="btn btn-sm btn-warning" href="{{ route('corizacion_expo.edit', $item->id) }}">
                                                            <i class="fa fa-fw fa-edit"></i>
                                                        </a> --}}


                                                    </td>
                                                </tr>
                                                @include('admin.cotizacion_cosmica.modal_estatus')
                                            @endif
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

            $(document).ready(function() {
                $('.cliente').select2();
                $('.phone').select2();
                $('.administradores').select2();
            });

            const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
                searchable: true,
                fixedHeight: false
            });

        </script>
@endsection


