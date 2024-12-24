@extends('layouts.app_admin')

@section('template_title')
    Cotizaciones Cosmica I
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

                                    <h2 class="mb-3">Cotizaciones Del Mes Cosmica</h2>

                                    <a type="button" class="btn bg-danger text-white" data-bs-toggle="modal" data-bs-target="#manual_instrucciones">
                                        ¿Como funciona?
                                    </a>

                                    @can('nota-productos-crear')
                                        <a class="btn btn-sm btn-success" href="{{ route('cotizacion_cosmica.create') }}" style="background: #322338; color: #ffff; font-size: 20px;">
                                            <i class="fa fa-fw fa-edit"></i> Crear
                                        </a>
                                    @endcan
                                </div>
                            </div>

                            @include('admin.cotizacion_cosmica.filtro')

                            <div class="card-body">
                                <div class="table-responsive">

                                    <nav>
                                        <div class="nav nav-tabs" >
                                            <a class="nav-link active" href="{{ route('cotizacion_cosmica.index') }}">
                                                Pendiente <img src="{{ asset('assets/cam/comprobante.png') }}" alt="" width="35px">
                                            </a>

                                            <a class="nav-link" href="{{ route('cotizacion_cosmica.index_aprobadas') }}">
                                                Aprobada <img src="{{ asset('assets/cam/cheque.png') }}" alt="" width="35px">
                                            </a>

                                            <a class="nav-link" href="{{ route('cotizacion_cosmica.index_canceladas') }}">
                                                Cancelada <img src="{{ asset('assets/cam/cerrar.png') }}" alt="" width="35px">
                                            </a>
                                        </div>
                                    </nav>

                                    <table class="table table-flush" id="datatable-search">
                                        <thead class="thead">
                                            <tr>
                                                <th>No</th>
                                                <th>Cliente</th>
                                                <th>fecha</th>
                                                <th>Total</th>
                                                <th>Estatus</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($notas as $item)
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
                                                    {{-- <td>
                                                        <h5>
                                                            <label class="badge" style="color: #b600e3;background-color: #ae00e340;">Cotización</label>
                                                        </h5>
                                                    </td> --}}
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
                                                        @php
                                                            $total = 0;$totalCantidad = 0;
                                                        @endphp
                                                        @can('nota-productos-editar')
                                                            <a class="btn btn-sm btn-warning" href="{{ route('cotizacion_cosmica.edit', $item->id) }}">
                                                                <i class="fa fa-fw fa-edit"></i>
                                                            </a>
                                                        @endcan


                                                    </td>
                                                </tr>
                                                @include('admin.cotizacion_cosmica.modal_estatus')
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


