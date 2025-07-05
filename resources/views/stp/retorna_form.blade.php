@extends('layouts.app_admin')

@section('content')
<div class="container py-4">
  <h2>Retorna Orden SPEI</h2>

  @if($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
  @endif

  <form action="{{ route('stp.retorna.orden') }}" method="POST">
    @csrf @method('PUT')

    <div class="row">
      <div class="col-md-3">
        <label>Fecha Operación</label>
        <input name="fechaOperacion" class="form-control" value="{{ old('fechaOperacion', date('Ymd')) }}">
      </div>
      <div class="col-md-3">
        <label>Institución Operante</label>
        <input name="institucionOperante" class="form-control" value="{{ old('institucionOperante','90646') }}">
      </div>
      <div class="col-md-3">
        <label>Clave Rastreo</label>
        <input name="claveRastreo" class="form-control" value="{{ old('claveRastreo') }}">
      </div>
      <div class="col-md-3">
        <label>Clave Rastreo Devolución</label>
        <input name="claveRastreoDevolucion" class="form-control" value="{{ old('claveRastreoDevolucion') }}">
      </div>
    </div>

    <div class="row mt-3">
      <div class="col-md-3">
        <label>Monto</label>
        <input name="monto" type="number" step="0.01" class="form-control" value="{{ old('monto') }}">
      </div>
      <div class="col-md-3">
        <label>Dígito Identificador</label>
        <input name="digitoIdentificadorBeneficiario" class="form-control" value="{{ old('digitoIdentificadorBeneficiario','2') }}">
      </div>
      <div class="col-md-3">
        <label>Medio Entrega</label>
        <input name="medioEntrega" class="form-control" value="{{ old('medioEntrega','3') }}">
      </div>
      <div class="col-md-3">
        <label>Empresa</label>
        <input name="empresa" class="form-control" value="{{ old('empresa','INMAS') }}">
      </div>
    </div>

    <button class="btn btn-success mt-3">Enviar Retorno</button>
  </form>

  @isset($cadena)
    <hr>
    <h5>Cadena Original</h5>
    <pre>{{ $cadena }}</pre>
    <h5>Firma</h5>
    <textarea class="form-control" rows="2" readonly>{{ $firma }}</textarea>
    <h5>Payload JSON</h5>
    <pre>{{ json_encode($payload, JSON_PRETTY_PRINT) }}</pre>
  @endisset

  @isset($resp)
    <h5>Respuesta STP ({{ $resp->status() }})</h5>
    <pre>{{ $resp->body() }}</pre>
  @endisset
</div>
@endsection
