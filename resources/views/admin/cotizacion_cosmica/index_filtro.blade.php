@extends('layouts.app_admin')

@section('template_title')
    Cotizaciones Cosmica
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
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-Cotizacion-tab" data-bs-toggle="tab" data-bs-target="#nav-Cotizacion" type="button" role="tab" aria-controls="nav-Cotizacion" aria-selected="false" >
                                        Pendiente <img src="{{ asset('assets/cam/comprobante.png') }}" alt="" width="35px">
                                    </button>

                                    <button class="nav-link" id="nav-Aprobada-tab" data-bs-toggle="tab" data-bs-target="#nav-Aprobada" type="button" role="tab" aria-controls="nav-Aprobada" aria-selected="false">
                                        Aprobada <img src="{{ asset('assets/cam/cheque.png') }}" alt="" width="35px">
                                    </button>

                                    <button class="nav-link" id="nav-Cancelada-tab" data-bs-toggle="tab" data-bs-target="#nav-Cancelada" type="button" role="tab" aria-controls="nav-Cancelada" aria-selected="false">
                                        Cancelada <img src="{{ asset('assets/cam/cerrar.png') }}" alt="" width="35px">
                                    </button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-Cotizacion" role="tabpanel" aria-labelledby="nav-Cotizacion-tab" tabindex="0">
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
                                                        <a class="btn btn-xs" target="_blank"  href="{{ route('cotizacion_cosmica.meli_show', $item->id) }}"  style="background: #FFE600; color: #ffff">
                                                            <img src="https://http2.mlstatic.com/frontend-assets/ml-web-navigation/ui-navigation/6.6.92/mercadolibre/logo_large_25years_v2.png" alt="" style="width: 35px">
                                                        </a>

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

                                <div class="tab-pane fade" id="nav-Aprobada" role="tabpanel" aria-labelledby="nav-Aprobada-tab" tabindex="0">
                                    <table class="table table-flush" id="datatable-search2">
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
                                            @foreach ($notas_aprobadas as $item)
                                                <tr>
                                                    <td>
                                                        <h5>{{ $item->folio }}</h5>
                                                    </td>
                                                    <td>
                                                        <h5>
                                                            @if ($item->id_usuario == NULL)
                                                                {{ $item->nombre }} <br> {{ $item->telefono }} <br>
                                                            @else
                                                                {{ $item->User->name }}  <br>
                                                            @endif

                                                            {{ $item->estadociudad}}

                                                        </h5>
                                                    </td>
                                                    {{-- <td>
                                                        <h5>
                                                            <label class="badge" style="color: #b600e3;background-color: #ae00e340;">Cotización</label>
                                                        </h5>
                                                    </td> --}}
                                                    <td>
                                                        @php
                                                            $fecha = $item->fecha_preparacion;
                                                            $fechaCarbon = \Carbon\Carbon::parse($fecha);
                                                        @endphp
                                                        <h5>
                                                            {{ $fechaCarbon->format('j/n/y') }} <br>
                                                            {{ $fechaCarbon->format('g:i A') }}
                                                        </h5>
                                                    </td>


                                                    <td><h5>${{ $item->total }}</h5></td>
                                                    <td>

                                                        @if ($item->estatus_cotizacion == 'Aprobada')

                                                            <a class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#estatus_{{ $item->id }}" title="Editar Estatus" style="background: #00b60f;">
                                                                Aprobada
                                                            </a>

                                                        @endif

                                                    </td>
                                                    <td>
                                                        <div class="row d-block">

                                                            <div class="col-6">
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

                                                            </div>

                                                            <div class="col-6">

                                                                <a class="btn btn-xs" target="_blank"  href="{{ route('cotizacion_cosmica.meli_show', $item->id) }}"  style="background: #FFE600; color: #ffff">
                                                                    <img src="https://http2.mlstatic.com/frontend-assets/ml-web-navigation/ui-navigation/6.6.92/mercadolibre/logo_large_25years_v2.png" alt="" style="width: 35px">
                                                                </a>

                                                                <a type="button" class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#guiaModal{{$item->id}}" style="background: #e6ab2d; color: #ffff">
                                                                    <i class="fa fa-truck"></i>
                                                                </a>

                                                                <a type="button" class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#pagoModal{{$item->id}}" style="background: #2d6ee6; color: #ffff">
                                                                    <i class="fa fa-credit-card-alt"></i>
                                                                </a>
                                                            </div>

                                                        </div>
                                                    </td>
                                                </tr>
                                                @include('admin.cotizacion_cosmica.guia')
                                                @include('admin.cotizacion_cosmica.modal_pago')
                                                @include('admin.cotizacion_cosmica.modal_estatus')
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="nav-Cancelada" role="tabpanel" aria-labelledby="nav-Cancelada-tab" tabindex="0">
                                    <table class="table table-flush" id="datatable-search3">
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
                                            @foreach ($notas_canceladas as $item)
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

                                                        @if ($item->estatus_cotizacion == 'Cancelada')

                                                            <a class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#estatus_{{ $item->id }}" title="Editar Estatus" style="background: #e30000;">
                                                                Cancelada
                                                            </a>

                                                        @endif

                                                    </td>
                                                    <td>
                                                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('cotizacion_cosmica.imprimir', ['id' => $item->id]) }}">
                                                            <i class="fa fa-file"></i>
                                                        </a>
                                                        @php
                                                            $total = 0;$totalCantidad = 0;
                                                        @endphp
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

    const dataTableSearch2 = new simpleDatatables.DataTable("#datatable-search2", {
        searchable: true,
        fixedHeight: false
    });

    const dataTableSearch3 = new simpleDatatables.DataTable("#datatable-search3", {
        searchable: true,
        fixedHeight: false
    });


</script>

</script>
@endsection


