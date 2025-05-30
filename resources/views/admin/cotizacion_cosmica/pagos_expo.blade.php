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

                                                    <input data-id="{{ $item->id }}" data-folio="{{ $item->folio }}" class="toggle-class" type="checkbox"
                                                    data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                                    data-on="Active" data-off="InActive" {{ $item->pago ? 'checked disabled' : '' }}>
                                                </td>
                                            </tr>
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

    $(function(){
        function refrescarPagos(){
            $.getJSON('{{ route("notas.pagos.stream") }}', function(notas){
            notas.forEach(function(n){
                var tr = $('#nota-' + n.id);
                // 1) Si ya existe la fila, solo actualiza estado y checkbox
                if (tr.length) {
                tr.toggleClass('table-success', n.pago === 1);
                if (n.pago === 1) {
                    tr.find('.toggle-class')
                    .prop('checked', true)
                    .prop('disabled', true);
                }
                }
                // 2) Si es nueva, la inserta al principio
                else {
                var clienteHtml = n.id_usuario
                    ? (n.user_name + '<br>' + n.user_telefono)
                    : n.nombre;
                var fila =
                    '<tr id="nota-' + n.id + '"' +
                    (n.pago === 1 ? ' class="table-success"' : '') +
                    '>' +
                    '<td><h5>' + (n.folio||n.id) + '</h5></td>' +
                    '<td><h5>' + clienteHtml + '</h5></td>' +
                    '<td><h5>' +
                        new Date(n.fecha).toLocaleDateString('es-MX', {
                        day: '2-digit', month: 'long', year: 'numeric'
                        }) +
                    '</h5></td>' +
                    '<td><h5>$' + parseFloat(n.total).toFixed(2) + '</h5></td>' +
                    '<td>' +
                        '<input data-id="'     + n.id    + '"' +
                            ' data-folio="'  + (n.folio||n.id) + '"' +
                            ' class="toggle-class" type="checkbox" ' +
                            (n.pago===1?'checked disabled':'') +
                        '>' +
                    '</td>' +
                    '</tr>';
                $('#datatable-search4 tbody').prepend(fila);
                }
            });
            });
        }

        refrescarPagos();
        setInterval(refrescarPagos, 10000);

        $('.table-responsive').on('change', '.toggle-class', function(){
            var $chk   = $(this);
            var newVal = $chk.prop('checked');
            var oldVal = !newVal;
            var abono  = newVal ? 1 : 0;
            var id     = $chk.data('id');
            var folio  = $chk.data('folio');

            if (!confirm('¿Seguro que quieres marcar la nota ' + folio + ' como pagada?')) {
            $chk.prop('checked', oldVal);
            return;
            }

            $.getJSON('{{ route("notas.pago.toggle") }}', { abono: abono, id: id })
            .done(function(data){
                if (data.success) {
                $('#nota-' + id).toggleClass('table-success', abono === 1);
                if (abono === 1) {
                    $chk.prop('disabled', true);
                }
                } else {
                $chk.prop('checked', oldVal);
                alert('No se pudo actualizar el pago');
                }
            })
            .fail(function(){
                $chk.prop('checked', oldVal);
                alert('Error al comunicarse con el servidor');
            });
        });
    });


</script>

@endsection


