@extends('layouts.app_admin')

@section('template_title')
    Aprobada Cosmica
@endsection

@section('css')
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

                            <h2 class="mb-3">Compras Del Mes Cosmica</h2>

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
                                    <a class="nav-link" href="{{ route('pedidos_cosmica_ecommerce.index') }}">
                                        Pendientes Guia <img src="{{ asset('assets/cam/comprobante.png') }}" alt="" width="35px">
                                    </a>

                                    <a class="nav-link" href="{{ route('pedidos_cosmica_ecommerce.index_preparacion') }}">
                                        En Preparación <img src="{{ asset('assets/cam/comprobante.png') }}" alt="" width="35px">
                                    </a>

                                    <a class="nav-link " href="{{ route('pedidos_cosmica_ecommerce.index_pen') }}">
                                        Pendiente Pago<img src="{{ asset('assets/cam/cheque.png') }}" alt="" width="35px">
                                    </a>
                                </div>
                            </nav>

                            <table class="table table-flush" id="datatable-search2">
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
                                        <tr>
                                            <td>
                                                <h5>TC{{ $item->id }}</h5>
                                            </td>
                                            <td>
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
                                                    $fecha = $item->fecha;
                                                    $fecha_timestamp = strtotime($fecha);
                                                    $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                                @endphp
                                                <div class="row d-block">

                                                    <div class="col-6">
                                                        <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('pedidos_cosmica.imprimir', $item->id) }}">
                                                            <i class="fa fa-file"></i>
                                                        </a>
                                                        <a type="button" class="btn btn-xs" data-bs-toggle="modal" data-bs-target="#guiaModal{{$item->id}}" style="background: #e6ab2d; color: #ffff">
                                                            <i class="fa fa-truck"></i>
                                                        </a>
                                                    </div>


                                                </div>
                                            </td>
                                        </tr>
                                        @include('admin.cosmica_ecommerce.modal_direccion')
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

    const dataTableSearch2 = new simpleDatatables.DataTable("#datatable-search2", {
        searchable: true,
        fixedHeight: false
    });

</script>
@endsection


