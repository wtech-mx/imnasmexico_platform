@extends('layouts.app_admin')

@section('content')
<div class="container py-4">
  <h2>Consulta de Operaciones STP</h2>

  @if($errors->any())
    <div class="alert alert-danger">{{ $errors->first() }}</div>
  @endif

  <form action="{{ route('stp.operaciones.consulta') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label class="form-label">Tipo de Consulta</label>
      <select name="tipo" id="tipo" class="form-select" required>
        <option value="actual"    {{ old('tipo')=='actual'    ? 'selected':'' }}>Actual</option>
        <option value="historica" {{ old('tipo')=='historica' ? 'selected':'' }}>Histórica</option>
        <option value="natural"   {{ old('tipo')=='natural'   ? 'selected':'' }}>Natural</option>
      </select>
    </div>

    <div class="mb-3">
      <label class="form-label">Empresa</label>
      <input type="text" name="empresa" class="form-control"
             value="{{ old('empresa','INMAS') }}" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Página</label>
      <input type="number" name="pagina" class="form-control"
             value="{{ old('pagina',0) }}" min="0" required>
    </div>

    {{-- Campos adicionales para histórica y natural --}}
    <div id="historica-fields" style="display:none">
      <div class="mb-3">
        <label class="form-label">Fecha Operativa (AAAAMMDD)</label>
        <input type="text" name="fechaOperacion" class="form-control"
               value="{{ old('fechaOperacion') }}">
      </div>
    </div>

    <div id="natural-fields" style="display:none">
      <div class="mb-3">
        <label class="form-label">Fecha Natural (AAAAMMDD)</label>
        <input type="text" name="fechaNatural" class="form-control"
               value="{{ old('fechaNatural') }}">
      </div>
      <div class="mb-3">
        <label class="form-label">Hora Inicio (HHmmss)</label>
        <input type="text" name="horaCapturaInicio" class="form-control"
               value="{{ old('horaCapturaInicio') }}">
      </div>
      <div class="mb-3">
        <label class="form-label">Hora Fin (HHmmss)</label>
        <input type="text" name="horaCapturaFin" class="form-control"
               value="{{ old('horaCapturaFin') }}">
      </div>
    </div>

    <button class="btn btn-primary">Consultar</button>
  </form>

  @isset($cadena)
    <hr>
    <h5>Cadena Original</h5>
    <pre>{{ $cadena }}</pre>
    <h5>Firma (Base64)</h5>
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

@section('js_custom')
<script>
// mostrar/ocultar campos según el tipo
function toggleFields() {
  let t = document.getElementById('tipo').value;
  document.getElementById('historica-fields').style.display = t==='historica' ? 'block':'none';
  document.getElementById('natural-fields' ).style.display = t==='natural'   ? 'block':'none';
}
document.getElementById('tipo').addEventListener('change', toggleFields);
window.addEventListener('load', toggleFields);
</script>
@endsection
