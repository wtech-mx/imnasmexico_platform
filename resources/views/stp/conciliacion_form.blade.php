@extends('layouts.app_admin')

@section('content')
<div class="container py-4">
  <h2>Consulta Conciliación Saldo</h2>

  @if($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
  @endif

  <form action="{{ route('stp.conciliacion.consulta') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label class="form-label">Empresa</label>
      <input name="empresa" class="form-control" value="{{ old('empresa','INMAS') }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Página</label>
      <input name="pagina" type="number" min="0" class="form-control" value="{{ old('pagina',0) }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Fecha Operativa (AAAAMMDD)</label>
      <input name="fechaOperacion" class="form-control" value="{{ old('fechaOperacion') }}">
      <small class="form-text text-muted">Déjalo vacío para fecha actual.</small>
    </div>

    <button class="btn btn-primary">Consultar</button>
  </form>

  @isset($cadena)
    <hr>
    <h5>Cadena Original</h5>
    <pre>{{ $cadena }}</pre>

    <h5>Firma Base64</h5>
    <textarea class="form-control" rows="2" readonly>{{ $firma }}</textarea>

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
