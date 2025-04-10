<div class="modal fade" id="guiaModal{{ $nota->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Subir guia</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

            <form method="POST" action="{{ route('notas_cosmica.update_guia', $nota->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="name">Doc Guia</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/user/icons/picture.png') }}" alt="" width="35px">
                                    </span>
                                    <input class="form-control" type="file" id="doc_guia" name="doc_guia">
                                </div>
                        </div>
                        @if ($nota->metodo_pago == 'Contra Entrega')
                            <h5>Pedido Contra Entrega</h5>
                            <p>Fecha entrega: {{ $nota->fecha_entrega }}</p>
                            <p>Direccion: {{ $nota->direccion_entrega }}</p>
                        @elseif($nota->metodo_pago == 'Envio')
                            <div class="col-12">
                                <embed src="{{ asset('pago_fuera/'.$nota->doc_guia) }}" type="application/pdf" style="width: 450px; height: 400px;" />
                            </div>
                        @elseif($nota->metodo_pago == 'Reposicion')
                            <div class="col-12">
                                <embed src="{{ asset('pago_fuera/'.$nota->doc_guia) }}" type="application/pdf" style="width: 450px; height: 400px;" />
                            </div>

                            <label for="name">Comentario</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/user/icons/picture.png') }}" alt="" width="35px">
                                </span>
                                <input class="form-control" type="text" id="comentario_rep" name="comentario_rep" value="{{ $nota->comentario_rep }}" disabled>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>

      </div>
    </div>
  </div>

<script>
    $(document).ready(function() {
        $('.modal').on('shown.bs.modal', function() {
            var $modal = $(this);

            $modal.find('.estatus-cotizacion').change(function() {
                var selectedValue = $(this).val();
                if (selectedValue === 'Aprobada') {
                    $modal.find('.estado-select').show();
                } else {
                    $modal.find('.estado-select').hide();
                }
            }).trigger('change'); // Activar el evento para el valor actual.
        });
    });

</script>
