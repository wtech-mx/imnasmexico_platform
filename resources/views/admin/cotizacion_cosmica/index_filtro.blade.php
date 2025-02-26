@extends('layouts.app_admin')

@section('template_title')
    Cotizaciones Cosmica
@endsection

@section('css')
 <!-- Select2  -->
 <link rel="stylesheet" href="{{asset('assets/admin/vendor/select2/dist/css/select2.min.css')}}">
 <!-- DataTables -->
 <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
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

                            <h2 class="mb-3">Filtro de Cosmica </h2>
                            <h5> {{ $fechaInicioFormatted }} al {{ $fechaFinFormatted }}</h5>

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
                                                <th>Fecha</th>
                                                <th>Total</th>
                                                <th>Estatus</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Los datos se cargarán mediante AJAX -->
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="nav-Aprobada" role="tabpanel" aria-labelledby="nav-Aprobada-tab" tabindex="0">
                                    <table class="table table-flush" id="datatable-search2">
                                        <thead class="thead">
                                            <tr>
                                                <th>No</th>
                                                <th>Cliente</th>
                                                <th>Fecha</th>
                                                <th>Total</th>
                                                <th>Estatus</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Los datos se cargarán mediante AJAX -->
                                        </tbody>
                                    </table>
                                </div>

                                <div class="tab-pane fade" id="nav-Cancelada" role="tabpanel" aria-labelledby="nav-Cancelada-tab" tabindex="0">
                                    <table class="table table-flush" id="datatable-search3">
                                        <thead class="thead">
                                            <tr>
                                                <th>No</th>
                                                <th>Cliente</th>
                                                <th>Fecha</th>
                                                <th>Total</th>
                                                <th>Estatus</th>
                                                <th>Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Los datos se cargarán mediante AJAX -->
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
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script type="text/javascript">

    $(document).ready(function() {
        $('.cliente').select2();
        $('.phone').select2();
        $('.administradores').select2();

        $('#datatable-search').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('cotizacion_cosmica.imprimir_reporte') }}",
                data: function (d) {
                    d.fecha_inicio = '{{ $fechaInicio }}';
                    d.fecha_fin = '{{ $fechaFin }}';
                }
            },
            columns: [
                { data: 'folio', name: 'folio' },
                { data: 'cliente', name: 'cliente' },
                { data: 'fecha', name: 'fecha' },
                { data: 'total', name: 'total' },
                { data: 'estatus_boton', name: 'estatus_boton', orderable: false, searchable: false },
                { data: 'acciones', name: 'acciones', orderable: false, searchable: false }
            ],
            order: [[0, 'desc']],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
            }
        });

        $('#datatable-search2').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('cotizacion_cosmica.imprimir_reporte') }}",
                data: function (d) {
                    d.fecha_inicio = '{{ $fechaInicio }}';
                    d.fecha_fin = '{{ $fechaFin }}';
                }
            },
            columns: [
                { data: 'folio', name: 'folio' },
                { data: 'cliente', name: 'cliente' },
                { data: 'fecha', name: 'fecha' },
                { data: 'total', name: 'total' },
                { data: 'estatus_boton', name: 'estatus_boton', orderable: false, searchable: false },
                { data: 'acciones', name: 'acciones', orderable: false, searchable: false }
            ],
            order: [[0, 'desc']],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
            }
        });

        $('#datatable-search3').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('cotizacion_cosmica.imprimir_reporte') }}",
                data: function (d) {
                    d.fecha_inicio = '{{ $fechaInicio }}';
                    d.fecha_fin = '{{ $fechaFin }}';
                }
            },
            columns: [
                { data: 'folio', name: 'folio' },
                { data: 'cliente', name: 'cliente' },
                { data: 'fecha', name: 'fecha' },
                { data: 'total', name: 'total' },
                { data: 'estatus_boton', name: 'estatus_boton', orderable: false, searchable: false },
                { data: 'acciones', name: 'acciones', orderable: false, searchable: false }
            ],
            order: [[0, 'desc']],
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.21/i18n/Spanish.json'
            }
        });
    });

</script>
@endsection
