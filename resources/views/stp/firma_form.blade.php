@extends('layouts.app_admin')
@section('content')
<div class="container py-4">
    <h2>Generar Firma STP</h2>

    @if($errors->any())
      <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('stp.firma.generate') }}" method="POST">
      @csrf

      <div class="mb-3">
        <label class="form-label">Empresa</label>
        <input type="text" name="empresa" class="form-control" value="{{ old('empresa','INMAS') }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Cuenta Ordenante</label>
        <input type="text" name="cuentaOrdenante" class="form-control"
               value="{{ old('cuentaOrdenante','646180580800000004') }}" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Fecha (AAAAMMDD) <small>(opcional para histórico)</small></label>
        <input type="text" name="fecha" class="form-control" value="{{ old('fecha') }}">
      </div>

      <button class="btn btn-primary">Generar Firma</button>
    </form>

    @isset($cadena)
    <hr>
    <h5>Cadena Original:</h5>
    <pre>{{ $cadena }}</pre>

    <h5>Firma (Base64):</h5>
    <textarea class="form-control" rows="4" readonly>{{ $firmaB64 }}</textarea>
    @endisset
</div>
@endsection
