@extends('layouts.app_admin')

@section('content')
<div class="container py-4">
  <h2>Consulta Orden por ClaveRastreo</h2>

  @if($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
  @endif

  <form action="{{ route('stp.orden.rastreo.consulta') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label class="form-label">Empresa</label>
      <input type="text" name="empresa" class="form-control"
             value="{{ old('empresa','INMAS') }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Tipo de Orden</label>
      <select name="tipoOrden" class="form-select" required>
        <option value="E" {{ old('tipoOrden')=='E'?'selected':'' }}>Enviadas (E)</option>
        <option value="R" {{ old('tipoOrden')=='R'?'selected':'' }}>Recibidas (R)</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Clave Rastreo</label>
      <input type="text" name="claveRastreo" class="form-control"
             value="{{ old('claveRastreo') }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Fecha Operativa (AAAAMMDD)</label>
      <input type="text" name="fechaOperacion" class="form-control"
             value="{{ old('fechaOperacion') }}">
      <small class="form-text text-muted">O deja vacío si vas a usar Fecha Natural</small>
    </div>

    <div class="mb-3">
      <label class="form-label">Fecha Natural (AAAAMMDD)</label>
      <input type="text" name="fechaNatural" class="form-control"
             value="{{ old('fechaNatural') }}">
      <small class="form-text text-muted">Solo si no pusiste Fecha Operativa</small>
    </div>

    <button class="btn btn-primary">Consultar</button>
  </form>

  @isset($cadena)
    <hr>
    <h5>Cadena Original</h5>
    <pre>{{ $cadena }}</pre>
    <h5>Firma Base64</h5>
    <textarea class="form-control" rows="3" readonly>{{ $firma }}</textarea>
    <h5>Payload JSON</h5>
    <pre>{{ json_encode($payload, JSON_PRETTY_PRINT) }}</pre>
  @endisset

  @isset($resultado)
    <hr>
    <h5>Respuesta STP</h5>
    <pre>{{ json_encode($resultado, JSON_PRETTY_PRINT) }}</pre>
  @endisset
</div>
@endsection
