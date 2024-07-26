
<!-- Modal -->
<div class="modal fade" id="por_vencer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="por_vencerLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="por_vencerLabel">Distribuidoras por vencer</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: #000;"></button>
        </div>

        <div class="modal-body row">
                <div class="col-4">
                    <h5>Nombre</h5>
                </div>
                <div class="col-4">
                    <h5>Dias / Puntos</h5>
                </div>
                <div class="col-4">
                    <h5>Accion</h5>
                </div>
            @foreach ($usuarios_por_vencer as $item)
                @php
                    $mensaje = "Hola, Distribuidora querida. Queremos recordarte con cariño que tu membresía está a punto de vencer en {$item->dias_restantes} días. Aún necesitas alcanzar la meta para seguir disfrutando de todos los beneficios de ser parte de Cosmica. Te faltan {$item->puntos_faltantes} puntos de compra. Recuerda que, si tu membresía expira, lamentablemente perderás tus puntos acumulados: {$item->puntos_acomulados}. ¡Estamos aquí para ayudarte a alcanzar tus objetivos!";
                    $mensajeWhatsApp = urlencode($mensaje);
                    $numeroWhatsApp = $item->User->telefono; // Asumiendo que el número de teléfono está almacenado en la columna 'telefono'
                    $enlaceWhatsApp = "https://wa.me/{$numeroWhatsApp}?text={$mensajeWhatsApp}";
                @endphp
                <div class="row">
                    <div class="col-4">
                        {{ $item->User->name }}<br>
                        {{ $item->User->telefono }}
                    </div>
                    <div class="col-4">
                        <label class="badge" style="color: #b600e3;background-color: #ae00e340;">Dias Faltantes: <b> {{ $item->dias_restantes }} </b></label><br>
                        Puntos faltantes: <b> {{ $item->puntos_faltantes }} </b>
                    </div>
                    <div class="col-4">
                        <a href="{{ $enlaceWhatsApp }}" target="_blank" class="btn btn-primary">Enviar recordatorio</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
