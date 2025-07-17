@extends('layouts.app_admin')

@section('content')
<div class="container py-4">
  <h2>Consulta de Saldo STP</h2>

  @if ($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
  @endif

  <form method="POST" action="{{ route('stp.consulta.saldo') }}">
    @csrf

    <div class="row">
      <div class="col-md-4 mb-2">
        <label>Empresa</label>
        <input name="empresa" class="form-control" value="{{ old('empresa', 'INMAS') }}" required>
      </div>
      <div class="col-md-4 mb-2">
        <label>Cuenta Ordenante</label>
        <input name="cuentaOrdenante" class="form-control" value="{{ old('cuentaOrdenante', '646180209100000001') }}" required>
      </div>
      <div class="col-md-4 mb-2">
        <label>Fecha (opcional, AAAAMMDD)</label>
        <input name="fecha" class="form-control" value="{{ old('fecha') }}">
      </div>
    </div>

    <button class="btn btn-success mt-3">Consultar</button>
  </form>

  @isset($cadena)
    <h5 class="mt-4">Cadena Original Firmada</h5>
    <pre>{{ $cadena }}</pre>
    <h5>Firma</h5>
    <textarea class="form-control" rows="3" readonly>{{ $firma }}</textarea>
    <h5>Payload</h5>
    <pre>{{ json_encode($payload, JSON_PRETTY_PRINT) }}</pre>
  @endisset

  @isset($respuesta)
    <h5>Respuesta STP</h5>
    <pre>{{ $respuesta->body() }}</pre>
  @endisset
</div>
@endsection
