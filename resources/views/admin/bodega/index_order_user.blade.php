{{-- resources/views/orders/summary.blade.php --}}
@extends('layouts.app_cotizador')

<style>
    .card_custom{
        box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);
        border-radius: 16px!important;
        padding-right: 16px;
        padding-left: 16px;
        padding-top: 16px;
        border: solid transparent 1px !important;
    }
</style>

@section('cotizador')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">

      <div class="card mb-4 card_custom">
        <div class="card-body ">
          <h4 class="card-title mb-3">Resumen de tu pedido</h4>

          {{-- Datos de cliente --}}
          <dl class="row mb-4">
            <dt class="col-sm-4">Cliente:</dt>
            <dd class="col-sm-8">{{ $notas_nas->User->name  }}</dd>

            <dt class="col-sm-4">Teléfono:</dt>
            <dd class="col-sm-8">{{ $notas_nas->User->telefono  }}</dd>

            <dt class="col-sm-4">Número de orden:</dt>
            <dd class="col-sm-8">
              <a href="{{ route('notas_cotizacion.imprimir',$notas_nas->id) }}" target="_blank">
                # {{ $notas_nas->folio }}<i class="bi bi-file-earmark-pdf"></i>
              </a>
            </dd>

            <dt class="col-sm-4">Estatus en bodega:</dt>
            <dd class="col-sm-8">
              <span class="badge
                @if($notas_nas->estatus_cotizacion=='En Preparacion') bg-success
                @elseif($notas_nas->estatus_cotizacion=='Preparado') bg-warning text-dark
                @elseif($notas_nas->estatus_cotizacion=='Enviado') bg-primary
                @else bg-secondary
                @endif
              ">
                {{ $notas_nas->estatus_cotizacion }}
              </span>
            </dd>
          </dl>


          {{-- Guía en PDF --}}
          <div class="mb-4">
            <h6><i class="bi bi-file-earmark-pdf"></i> Pdf del Pedido</h6>
                <a href="{{ route('notas_cotizacion.imprimir',$notas_nas->id) }}" target="_blank" class="btn btn-success btn-sm">Descargar</a>
          </div>

          {{-- Guía en PDF --}}
          <div class="mb-4">
            <h6>Guía de envío</h6>
            <a href="#" target="_blank" class="d-inline-block">
              <img src="#"
                   alt="Vista previa del PDF de guía"
                   class="img-fluid rounded"
                   style="max-height: 120px;">
            </a>
          </div>

          {{-- Foto del pedido despachado --}}
          <div>
            <h6>Foto de tu pedido</h6>
            <img src="#"
                 alt="Foto del pedido despachado"
                 class="img-fluid rounded shadow-sm"
                 style="max-height: 300px; width: auto;">
          </div>

        </div>
      </div>

    </div>
  </div>
</div>
@endsection
