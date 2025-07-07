<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Test Webhook STP</title></head>
<body>
  <h1>Enviar notificación a /api/webhook/stp/estado</h1>
  <form id="f" method="POST" action="{{ route('stp.webhook.estado') }}">
    @csrf
    <label>ID</label><input name="id" value="12342912"><br>
    <label>Empresa</label><input name="empresa" value="INMAS"><br>
    <label>Clave Rastreo</label><input name="claveRastreo" value="ABC123"><br>
    <label>Estado</label>
      <select name="estado">
        <option value="LQ">LQ</option>
        <option value="CN">CN</option>
        <option value="D">D</option>
      </select><br>
    <label>Causa Devolución</label><input name="causaDevolucion" value=""><br>
    <label>tsLiquidacion</label><input name="tsLiquidacion" value="{{ now()->timestamp }}000"><br>
    <button>Enviar</button>
  </form>
</body>
</html>
