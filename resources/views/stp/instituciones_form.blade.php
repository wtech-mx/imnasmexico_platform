@extends('layouts.app_admin')

@section('content')
<div class="container py-4">
  <h2>Consulta Instituciones</h2>

  @if($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
  @endif

  <form action="{{ route('stp.instituciones.consulta') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label class="form-label">Empresa</label>
      <input name="empresa"
             class="form-control"
             value="{{ old('empresa','INMAS') }}"
             maxlength="15"
             required>
    </div>

    <button class="btn btn-primary">Consultar</button>
  </form>

  @isset($cadena)
    <hr>
    <h5>Cadena Original</h5>
    <pre>{{ $cadena }}</pre>

    <h5>Firma Base64</h5>
    <textarea class="form-control" rows="2" readonly>{{ $firma }}</textarea>

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
