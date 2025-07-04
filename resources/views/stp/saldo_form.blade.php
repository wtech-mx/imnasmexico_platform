@extends('layouts.app_admin')

@section('content')
<div class="container py-4">
  <h2>Consulta Saldo de Cuenta</h2>

  @if($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
  @endif

  <form action="{{ route('stp.saldo.consulta') }}" method="POST" class="mb-4">
    @csrf

    <div class="row mb-3">
      <div class="col-md-4">
        <label class="form-label">Empresa</label>
        <input name="empresa"
               class="form-control"
               value="{{ old('empresa','INMAS') }}"
               maxlength="15"
               required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Cuenta Ordenante</label>
        <input name="cuentaOrdenante"
               class="form-control"
               value="646180580800000004"
               maxlength="18"
               required>
      </div>
      <div class="col-md-4">
        <label class="form-label">Fecha (AAAAMMDD)</label>
        <input name="fecha"
               class="form-control"
               value="{{ old('fecha') }}"
               placeholder="Opcional"
               maxlength="8">
      </div>
    </div>

    <button class="btn btn-primary">Consultar</button>
  </form>

  @isset($cadena)
    <h5>Cadena Original</h5>
    <pre>{{ $cadena }}</pre>

    <h5>Firma Base64</h5>
    <textarea class="form-control mb-3" rows="2" readonly>{{ $firma }}</textarea>

    <h5>Request JSON</h5>
    <pre>{{ json_encode($payload, JSON_PRETTY_PRINT) }}</pre>
  @endisset

  @isset($resultado)
    <hr>
    <h5>Respuesta STP</h5>
    <pre>{{ json_encode($resultado, JSON_PRETTY_PRINT) }}</pre>
  @endisset
</div>
@endsection
