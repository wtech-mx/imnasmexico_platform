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

                            <a href="{{ route('index_cosmica_new.cotizador') }}" target="_blank" class="btn bg-success text-white" >
                                Cotizador
                            </a>

                            @can('roles-permisos')
                                <form action="{{ route('reportes.ventasExpo') }}" method="GET" class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <label for="fecha_inicio" class="form-label">Fecha inicio</label>
                                        <input
                                            type="date"
                                            id="fecha_inicio"
                                            name="fecha_inicio"
                                            class="form-control"
                                            value="{{ request('fecha_inicio') }}"
                                            required
                                        >
                                        </div>
                                        <div class="col-md-4">
                                        <label for="fecha_fin" class="form-label">Fecha fin</label>
                                        <input
                                            type="date"
                                            id="fecha_fin"
                                            name="fecha_fin"
                                            class="form-control"
                                            value="{{ request('fecha_fin') }}"
                                            required
                                        >
                                        </div>
                                        <div class="col-md-4 align-self-end">
                                        <button type="submit" class="btn btn-primary w-100">
                                            Filtrar
                                        </button>
                                    </div>
                                </form>
                            @endcan

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
                            
                             <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('cotizacion.imprimir_fangos') }}">
                                    <i class="fa fa-file"></i>hola
                              </a>

                            <table class="table table-flush" id="datatable-search4">
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
                                    @foreach ($notas as $nota)
                                        <tr>
                                            <td>
                                                {{ $nota->folio }}
                                            </td>
                                            <td>
                                                @if ($nota->id_usuario == NULL)
                                                    {{ $nota->nombre }}
                                                @else
                                                    {{ $nota->User->name }} <br> {{ $nota->User->telefono }}
                                                @endif
                                            </td>

                                            <td>
                                                @php
                                                $fecha = $nota->fecha;
                                                $fecha_timestamp = strtotime($fecha);
                                                $fecha_formateada = date('d \d\e F \d\e\l Y', $fecha_timestamp);
                                                @endphp
                                                <h5>
                                                    {{$fecha_formateada}}
                                                </h5>
                                            </td>

                                            <td>
                                                ${{ number_format($nota->total, 2) }}
                                            </td>

                                            <td>
                                                @if ($nota->estatus_cotizacion == 'Entregado')
                                                    <a type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#estatus_{{ $nota->id }}">
                                                        Empaquetado
                                                    </a>
                                                @elseif ($nota->envio == 'Si')
                                                    <a type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#estatus_{{ $nota->id }}">
                                                        Para enviar
                                                    </a>
                                                @else
                                                    <a type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#estatus_{{ $nota->id }}">
                                                        Pendiente
                                                    </a>
                                                @endif
                                            </td>

                                            <td>
                                                <a class="btn btn-sm btn-info text-white" target="_blank" href="{{ route('cotizacion_cosmica.imprimir', ['id' => $nota->id]) }}">
                                                    <i class="fa fa-file"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @include('admin.cotizacion_cosmica.modal_estatus', ['nota' => $nota])
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


