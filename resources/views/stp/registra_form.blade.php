@extends('layouts.app_admin')

@section('content')
<div class="container py-4">
  <h2>Registra Orden SPEI</h2>

  @if($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
  @endif

  <form action="{{ route('stp.registra.orden') }}" method="POST">
    @csrf @method('PUT')

    <div class="row">
      <div class="col-md-3 mb-2">
        <label>Institución Contraparte</label>
        <input name="institucionContraparte" class="form-control" value="{{ old('institucionContraparte','90646') }}">
      </div>
      <div class="col-md-3 mb-2">
        <label>Empresa</label>
        <input name="empresa" class="form-control"  value="{{ old('empresa','INMAS') }}">
      </div>
      <div class="col-md-3 mb-2">
        <label>Fecha Operación (AAAAMMDD)</label>
        <input name="fechaOperacion" class="form-control" value="{{ old('fechaOperacion',date('Ymd')) }}">
      </div>
      <div class="col-md-3 mb-2">
        <label>Folio Origen</label>
        <input name="folioOrigen" class="form-control" value="{{ old('folioOrigen') }}">
      </div>
      <div class="col-md-3 mb-2">
        <label>conceptoPago</label>
        <input name="conceptoPago" class="form-control" value="{{ old('folioOrigen','Prueba REST') }}">
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 mb-2">
        <label>Clave Rastreo</label>
        <input name="claveRastreo" class="form-control" value="{{ old('claveRastreo','Pruebainmas01') }}">
      </div>
      <div class="col-md-4 mb-2">
        <label>Institución Operante</label>
        <input name="institucionOperante" class="form-control" value="{{ old('institucionOperante','90646') }}">
      </div>
      <div class="col-md-4 mb-2">
        <label>Monto</label>
        <input name="monto" type="number" step="0.01" class="form-control" value="{{ old('monto','0.01') }}">
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 mb-2">
        <label>Tipo Pago</label>
        <input name="tipoPago" class="form-control" value="{{ old('tipoPago','1') }}">
      </div>
      <div class="col-md-4 mb-2">
        <label>Tipo Cta Ordenante</label>
        <input name="tipoCuentaOrdenante" class="form-control" value="{{ old('tipoCuentaOrdenante','40') }}">
      </div>
      <div class="col-md-4 mb-2">
        <label>Nombre Ordenante</label>
        <input name="nombreOrdenante" class="form-control" value="{{ old('nombreOrdenante','S.A. de C.V.') }}">
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 mb-2">
        <label>Cuenta Ordenante</label>
        <input name="cuentaOrdenante" class="form-control" value="{{ old('cuentaOrdenante','646180580800000004') }}">
      </div>
      <div class="col-md-4 mb-2">
        <label>RFC Ordenante</label>
        <input name="rfcCurpOrdenante" class="form-control" value="{{ old('rfcCurpOrdenante','ND') }}">
      </div>
      <div class="col-md-4 mb-2">
        <label>Tipo Cta Beneficiario</label>
        <input name="tipoCuentaBeneficiario" class="form-control" value="{{ old('tipoCuentaBeneficiario','40') }}">
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 mb-2">
        <label>Nombre Beneficiario</label>
        <input name="nombreBeneficiario" class="form-control" value="{{ old('nombreBeneficiario','S.A. de C.V.') }}">
      </div>
      <div class="col-md-4 mb-2">
        <label>Cuenta Beneficiario</label>
        <input name="cuentaBeneficiario" class="form-control" value="{{ old('cuentaBeneficiario','646180209100000001') }}">
      </div>
      <div class="col-md-4 mb-2">
        <label>RFC Beneficiario</label>
        <input name="rfcCurpBeneficiario" class="form-control" value="{{ old('rfcCurpBeneficiario','ND') }}">
      </div>
    </div>

    <div class="row">
      <div class="col-md-4 mb-2">
        <label>Referencia Numérica</label>
        <input name="referenciaNumerica" class="form-control" value="{{ old('referenciaNumerica','123456') }}">
      </div>

      <div class="col-md-4 mb-2">
        <label>Latitud</label>
        <input name="latitud" class="form-control" placeholder="HHmmss..." value="{{ old('latitud','19.385881') }}">
      </div>

      <div class="col-md-4 mb-2">
        <label>Longitud</label>
        <input name="longitud" class="form-control" placeholder="±DDD.ddddd" value="{{ old('longitud','-99.226816') }}">
      </div>

      <div class="col-md-4 mb-2">
        <label>Usuario</label>
        <input name="usuario" class="form-control" placeholder="±DDD.ddddd" value="{{ old('usuario','Josue Adrian') }}">
      </div>
    </div>



    <button class="btn btn-success mt-3">Enviar Orden</button>
  </form>

  @isset($cadena)
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
