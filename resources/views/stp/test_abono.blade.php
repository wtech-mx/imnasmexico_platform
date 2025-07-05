<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Test SendAbono STP</title></head>
<body>
  <h1>Enviar notificación SendAbono</h1>
  <form method="POST" action="{{ route('stp.webhook.abono') }}">
    @csrf
    <label>id</label><input name="id" value="3191365"><br>
    <label>fechaOperacion</label><input name="fechaOperacion" value="20200127"><br>
    <label>institucionOrdenante</label><input name="institucionOrdenante" value="90903"><br>
    <label>institucionBeneficiaria</label><input name="institucionBeneficiaria" value="90646"><br>
    <label>claveRastreo</label><input name="claveRastreo" value="12345"><br>
    <label>monto</label><input name="monto" value="0.01"><br>
    <label>nombreOrdenante</label><input name="nombreOrdenante" value="STP"><br>
    <label>tipoCuentaOrdenante</label><input name="tipoCuentaOrdenante" value="40"><br>
    <label>cuentaOrdenante</label><input name="cuentaOrdenante" value="846180000400000001"><br>
    <label>rfcCurpOrdenante</label><input name="rfcCurpOrdenante" value="ND"><br>
    <label>nombreBeneficiario</label><input name="nombreBeneficiario" value="NOMBRE_DE_BENEFICIARIO"><br>
    <label>tipoCuentaBeneficiario</label><input name="tipoCuentaBeneficiario" value="40"><br>
    <label>cuentaBeneficiario</label><input name="cuentaBeneficiario" value="64618012340000000D"><br>
    <label>nombreBeneficiario2</label><input name="nombreBeneficiario2" value="NOMBRE_DE_BENEFICIARIO2"><br>
    <label>tipoCuentaBeneficiario2</label><input name="tipoCuentaBeneficiario2" value="40"><br>
    <label>cuentaBeneficiario2</label><input name="cuentaBeneficiario2" value="64618012340000000D"><br>
    <label>rfcCurpBeneficiario</label><input name="rfcCurpBeneficiario" value="ND"><br>
    <label>conceptoPago</label><input name="conceptoPago" value="PRUEBA1"><br>
    <label>referenciaNumerica</label><input name="referenciaNumerica" value="1234567"><br>
    <label>empresa</label><input name="empresa" value="NOMBRE_EMPRESA"><br>
    <label>tipoPago</label><input name="tipoPago" value="1"><br>
    <label>tsLiquidacion</label><input name="tsLiquidacion" value="{{ now()->timestamp }}000"><br>
    <label>folioCodi</label><input name="folioCodi" value="f4c1111abd2b28a00abc"><br>
    <button>Enviar</button>
  </form>
</body>
</html>
