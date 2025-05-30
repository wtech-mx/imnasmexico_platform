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

                            <nav>
                                <div class="nav nav-tabs" >
                                    <a class="nav-link active" href="{{ route('index_cotizaciones_cosmica_expo.cotizador') }}">
                                        Cotizaciones <img src="{{ asset('assets/cam/comprobante.png') }}" alt="" width="35px">
                                    </a>

                                    <a class="nav-link" href="{{ route('index_pagos_cosmica_expo.cotizador') }}">
                                        Pago <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="35px">
                                    </a>

                                    <a class="nav-link" href="{{ route('index_recepcion_cosmica_expo.cotizador') }}">
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
                                        <th>Recibido</th>
                                        <th>Cambio</th>
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
                                            <td>
                                                <h5 class="total" data-total="{{ $item->total }}">
                                                    ${{ number_format($item->total, 2) }}
                                                </h5>
                                            </td>
                                            <td>
                                                <input
                                                type="number"
                                                min="0"
                                                step="0.01"
                                                class="form-control recibido-input"
                                                placeholder="0.00"
                                                >
                                            </td>
                                            <td class="cambio-cell">
                                                $0.00
                                            </td>
                                            <td>

                                            <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('cotizacion_cosmica.imprimir', ['id' => $item->id]) }}">
                                                <i class="fa fa-file"></i>
                                            </a>

                                            <input data-id="{{ $item->id }}" data-folio="{{ $item->folio }}" class="toggle-class" type="checkbox"
                                            data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                            data-on="Active" data-off="InActive" {{ $item->pago ? 'checked disabled' : '' }}>
                                            </td>
                                        </tr>
                                        @include('admin.cotizacion.modal_estatus')
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
    // select2
    $('.cliente, .phone, .administradores').select2();

    // DataTable
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search4", {
      searchable: true,
      fixedHeight: false
    });

    // Cálculo instantáneo de cambio
    $('#datatable-search4').on('input', '.recibido-input', function() {
      const $row     = $(this).closest('tr');
      const total    = parseFloat($row.find('.total').data('total')) || 0;
      const recibido = parseFloat($(this).val()) || 0;
      const cambio   = recibido - total;
      $row.find('.cambio-cell').text('$' + cambio.toFixed(2));
    });

    // Toggle de pago
    $('.table-responsive').on('change', '.toggle-class', function() {
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

      $.ajax({
        type: "GET",
        dataType: "json",
        url: '{{ route("notas.pago.toggle") }}',
        data: { abono, id },
        success(data) {
          if (data.success) {
            $('#nota-' + id).toggleClass('table-success', abono === 1);
            if (abono === 1) {
              $chk.prop('disabled', true);
            }
          } else {
            $chk.prop('checked', oldVal);
            alert('No se pudo actualizar el pago');
          }
        },
        error() {
          $chk.prop('checked', oldVal);
          alert('Error al comunicarse con el servidor');
        }
      });
    });
  });

</script>

@endsection


