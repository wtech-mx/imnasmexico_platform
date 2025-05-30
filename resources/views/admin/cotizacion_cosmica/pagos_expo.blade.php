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
                                <table class="table table-flush table-responsive" id="datatable-search4">
                                    <thead class="thead">
                                        <tr>
                                        <th>No</th>
                                        <th>Cliente</th>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                        <th>Recibido</th>
                                        <th>Cambio</th>
                                        <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($notas as $item)
                                        <tr id="nota-{{ $item->id }}" class="{{ $item->pago ? 'table-success' : '' }}">
                                            <td><h5>{{ $item->folio ?? $item->id }}</h5></td>
                                            <td>
                                            <h5>
                                                @if ($item->id_usuario)
                                                {{ $item->User->name }}<br>{{ $item->User->telefono }}
                                                @else
                                                {{ $item->nombre }}
                                                @endif
                                            </h5>
                                            </td>
                                            <td>
                                            @php
                                                $ts = strtotime($item->fecha);
                                                $fmt = date('d \d\e F \d\e\l Y', $ts);
                                            @endphp
                                            <h5>{{ $fmt }}</h5>
                                            </td>
                                            <td>
                                            <h5 class="total" data-total="{{ $item->total }}">
                                                ${{ number_format($item->total, 2) }}
                                            </h5>
                                            </td>

                                            {{-- Input Recibido --}}
                                            <td>
                                            <input
                                                type="number"
                                                min="0"
                                                step="0.01"
                                                class="form-control recibido-input"
                                                placeholder="0.00"
                                            >
                                            </td>

                                            {{-- Cambio calculado --}}
                                            <td class="cambio-cell">
                                            $0.00
                                            </td>

                                            {{-- Toggle de pago --}}
                                            <td>
                                            <input
                                                data-id="{{ $item->id }}"
                                                data-folio="{{ $item->folio }}"
                                                class="toggle-class"
                                                type="checkbox"
                                                data-onstyle="success"
                                                data-offstyle="danger"
                                                data-toggle="toggle"
                                                data-on="Active"
                                                data-off="InActive"
                                                {{ $item->pago ? 'checked disabled' : '' }}
                                            >
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
  // inicializa DataTable
  const dataTableSearch = new simpleDatatables.DataTable("#datatable-search4", {
    searchable: true,
    fixedHeight: false
  });

  $(function(){

    // 1) Listener delegado para recalcular el cambio
    $('#datatable-search4').on('input', '.recibido-input', function() {
      const $row     = $(this).closest('tr');
      const total    = parseFloat($row.find('.total').data('total')) || 0;
      const recibido = parseFloat($(this).val()) || 0;
      const cambio   = recibido - total;
      $row.find('.cambio-cell').text('$' + cambio.toFixed(2));
    });

    // 2) Refrescar cada 10s: actualiza filas existentes o inserta nuevas con las 7 columnas
    function refrescarPagos(){
      $.getJSON('{{ route("notas.pagos.stream") }}', function(notas){
        notas.forEach(function(n){
          const tr = $('#nota-' + n.id);

          // fila ya existe → solo actualiza estado y checkbox
          if (tr.length) {
            tr.toggleClass('table-success', n.pago === 1);
            if (n.pago === 1) {
              tr.find('.toggle-class')
                .prop('checked', true)
                .prop('disabled', true);
            }
          }
          // nueva fila → la inserta al principio con las columnas Recibido/Cambio
          else {
            const clienteHtml = n.id_usuario
              ? (n.user_name + '<br>' + n.user_telefono)
              : n.nombre;
            const totalFixed = parseFloat(n.total).toFixed(2);

            const fila =
              '<tr id="nota-' + n.id + '"' +
                (n.pago === 1 ? ' class="table-success"' : '') +
              '>' +
                '<td><h5>' + (n.folio || n.id) + '</h5></td>' +
                '<td><h5>' + clienteHtml + '</h5></td>' +
                '<td><h5>' +
                  new Date(n.fecha).toLocaleDateString('es-MX', {
                    day: '2-digit', month: 'long', year: 'numeric'
                  }) +
                '</h5></td>' +
                '<td><h5 class="total" data-total="' + totalFixed + '">' +
                  '$' + totalFixed +
                '</h5></td>' +
                '<td>' +
                  '<input type="number" min="0" step="0.01" ' +
                         'class="form-control recibido-input" ' +
                         'placeholder="0.00">' +
                '</td>' +
                '<td class="cambio-cell">$0.00</td>' +
                '<td>' +
                  '<input data-id="'    + n.id    + '"' +
                         ' data-folio="' + (n.folio||n.id) + '"' +
                         ' class="toggle-class" type="checkbox" ' +
                         (n.pago===1 ? 'checked disabled' : '') +
                         ' data-onstyle="success" ' +
                         ' data-offstyle="danger" ' +
                         ' data-toggle="toggle" ' +
                         ' data-on="Active" ' +
                         ' data-off="InActive">' +
                '</td>' +
              '</tr>';

            $('#datatable-search4 tbody').prepend(fila);
          }
        });
      });
    }

    refrescarPagos();
    setInterval(refrescarPagos, 10000);

    // 3) Toggle de pago (igual que tú lo tenías)
    $('.table-responsive').on('change', '.toggle-class', function(){
      const $chk   = $(this);
      const folio  = $chk.data('folio');
      const newVal = $chk.prop('checked');
      const oldVal = !newVal;
      const abono  = newVal ? 1 : 0;
      const id     = $chk.data('id');

      if (!confirm(`¿Seguro que quieres marcar la nota ${folio} como pagada?`)) {
        $chk.prop('checked', oldVal);
        return;
      }

      $.getJSON('{{ route("notas.pago.toggle") }}', { abono, id })
       .done(function(data){
         if (data.success) {
           $('#nota-' + id).toggleClass('table-success', abono === 1);
           if (abono === 1) $chk.prop('disabled', true);
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


