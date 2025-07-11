@extends('layouts.app_admin')

@section('content')
<div class="container py-4">
    <h2>Enviar notificación a <code>/api/webhook/stp/estado</code></h2>

    @if($errors->any())
      <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form id="f" method="POST" action="{{ route('stp.webhook.estado') }}" class="card p-4 shadow-sm">
        @csrf
        <div class="row">
            <div class="col-md-4 mb-2">
                <label>ID</label>
                <input name="id" class="form-control" value="12342912">
            </div>
            <div class="col-md-4 mb-2">
                <label>Empresa</label>
                <input name="empresa" class="form-control" value="INMAS">
            </div>
            <div class="col-md-4 mb-2">
                <label>Clave Rastreo</label>
                <input name="claveRastreo" class="form-control" value="ABC123">
            </div>
            <div class="col-md-4 mb-2">
                <label>Estado</label>
                <select name="estado" class="form-select">
                    <option value="LQ">LQ</option>
                    <option value="CN">CN</option>
                    <option value="D">D</option>
                </select>
            </div>
            <div class="col-md-4 mb-2">
                <label>Causa Devolución</label>
                <input name="causaDevolucion" class="form-control" placeholder="Solo si aplica">
            </div>
            <div class="col-md-4 mb-2">
                <label>tsLiquidacion</label>
                <input name="tsLiquidacion" class="form-control" value="{{ now()->timestamp }}000">
            </div>
        </div>
        <button class="btn btn-primary mt-3">Enviar notificación</button>
    </form>

    @isset($cadena)
        <div class="mt-4 card card-body">
            <h5>Cadena Original</h5>
            <pre>{{ $cadena }}</pre>

            <h5>Firma generada</h5>
            <textarea class="form-control" rows="2" readonly>{{ $firma }}</textarea>

            <h5>Payload JSON enviado</h5>
            <pre>{{ json_encode($payload, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
        </div>
    @endisset

    @isset($resp)
        <div class="mt-4 card card-body">
            <h5>Respuesta STP ({{ $resp->status() }})</h5>
            <pre>{{ $resp->body() }}</pre>
        </div>
    @endisset
</div>
@endsection
