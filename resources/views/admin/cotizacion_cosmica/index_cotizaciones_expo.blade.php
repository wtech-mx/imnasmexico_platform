@extends('layouts.app_admin')

@section('template_title')
     Cotizacion Expo Cosmica
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

                            <h2 class="mb-3">Cotizacion Expo Cosmica</h2>

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
                                        <tr>
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
                                                @if($item->estatus_cotizacion == null)
                                                    <a type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                        Cotizacion
                                                    </a>
                                                @elseif($item->estatus_cotizacion == 'Pendiente')
                                                    <a type="button" class="btn btn-xs btn-warning" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                        Pendiene
                                                    </a>
                                                @elseif($item->estatus_cotizacion == 'Aprobada')
                                                    <a type="button" class="btn btn-xs btn-success" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                        Aprobada
                                                    </a>
                                                @elseif($item->estatus_cotizacion == 'Cancelada')
                                                    <a type="button" class="btn btn-xs btn-danger" data-bs-toggle="modal" data-bs-target="#estatusModal{{$item->id}}">
                                                        Cencelada
                                                    </a>
                                                @endif
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

                                            @if($item->total <= '700')
                                            @else
                                                <a class="btn btn-xs" target="_blank" href="{{ route('cotizacion_cosmica.meli_show', $item->id) }}" style="background: #FFE600; color: #ffff">
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


