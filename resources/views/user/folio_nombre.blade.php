@extends('layouts.app_registro')

@section('template_title')
    Afiliados
@endsection

@section('section_pag')

<div class="container mt-5">
    <h4 class="mb-4">Folio duplicado detectado: <strong>{{ $folio }}</strong></h4>
    <form action="{{ route('folio.buscador') }}" method="GET">
        <input type="hidden" name="folio" value="{{ $folio }}">
        <div class="form-group">
            <label for="nombre">Ingresa tu nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
            @if($errors->has('nombre'))
                <span class="text-danger">{{ $errors->first('nombre') }}</span>
            @endif
        </div>
        <button type="submit" class="btn btn-primary mt-3">Buscar mis documentos</button>
    </form>
</div>

@endsection
