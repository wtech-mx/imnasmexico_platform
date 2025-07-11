@extends('layouts.app_admin')

@section('content')
<div class="container py-4">
    <h2>Enviar notificación <code>SendAbono</code></h2>

    @if($errors->any())
      <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('stp.webhook.abono') }}" class="card p-4 shadow-sm">
        @csrf
        <div class="row">
            <div class="col-md-3 mb-2"><label>ID</label><input name="id" class="form-control" value="3191365"></div>
            <div class="col-md-3 mb-2"><label>Fecha Operación</label><input name="fechaOperacion" class="form-control" value="20200127"></div>
            <div class="col-md-3 mb-2"><label>Institución Ordenante</label><input name="institucionOrdenante" class="form-control" value="90903"></div>
            <div class="col-md-3 mb-2"><label>Institución Beneficiaria</label><input name="institucionBeneficiaria" class="form-control" value="90646"></div>
            <div class="col-md-3 mb-2"><label>Clave Rastreo</label><input name="claveRastreo" class="form-control" value="12345"></div>
            <div class="col-md-3 mb-2"><label>Monto</label><input name="monto" class="form-control" value="0.01"></div>
            <div class="col-md-3 mb-2"><label>Nombre Ordenante</label><input name="nombreOrdenante" class="form-control" value="STP"></div>
            <div class="col-md-3 mb-2"><label>Tipo Cuenta Ordenante</label><input name="tipoCuentaOrdenante" class="form-control" value="40"></div>
            <div class="col-md-3 mb-2"><label>Cuenta Ordenante</label><input name="cuentaOrdenante" class="form-control" value="846180000400000001"></div>
            <div class="col-md-3 mb-2"><label>RFC Ordenante</label><input name="rfcCurpOrdenante" class="form-control" value="ND"></div>
            <div class="col-md-3 mb-2"><label>Nombre Beneficiario</label><input name="nombreBeneficiario" class="form-control" value="NOMBRE_DE_BENEFICIARIO"></div>
            <div class="col-md-3 mb-2"><label>Tipo Cuenta Beneficiario</label><input name="tipoCuentaBeneficiario" class="form-control" value="40"></div>
            <div class="col-md-3 mb-2"><label>Cuenta Beneficiario</label><input name="cuentaBeneficiario" class="form-control" value="64618012340000000D"></div>
            <div class="col-md-3 mb-2"><label>Nombre Beneficiario 2</label><input name="nombreBeneficiario2" class="form-control" value="NOMBRE_DE_BENEFICIARIO2"></div>
            <div class="col-md-3 mb-2"><label>Tipo Cuenta Beneficiario 2</label><input name="tipoCuentaBeneficiario2" class="form-control" value="40"></div>
            <div class="col-md-3 mb-2"><label>Cuenta Beneficiario 2</label><input name="cuentaBeneficiario2" class="form-control" value="64618012340000000D"></div>
            <div class="col-md-3 mb-2"><label>RFC Beneficiario</label><input name="rfcCurpBeneficiario" class="form-control" value="ND"></div>
            <div class="col-md-3 mb-2"><label>Concepto Pago</label><input name="conceptoPago" class="form-control" value="PRUEBA1"></div>
            <div class="col-md-3 mb-2"><label>Referencia Numérica</label><input name="referenciaNumerica" class="form-control" value="1234567"></div>
            <div class="col-md-3 mb-2"><label>Empresa</label><input name="empresa" class="form-control" value="NOMBRE_EMPRESA"></div>
            <div class="col-md-3 mb-2"><label>Tipo Pago</label><input name="tipoPago" class="form-control" value="1"></div>
            <div class="col-md-3 mb-2"><label>tsLiquidacion</label><input name="tsLiquidacion" class="form-control" value="{{ now()->timestamp }}000"></div>
            <div class="col-md-3 mb-2"><label>Folio Codi</label><input name="folioCodi" class="form-control" value="f4c1111abd2b28a00abc"></div>
        </div>
        <button class="btn btn-success mt-3">Enviar Abono</button>
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
            <h5>Respuesta generada ({{ $resp->status() }})</h5>
            <pre>{{ $resp->body() }}</pre>
        </div>
    @endisset
</div>
@endsection
