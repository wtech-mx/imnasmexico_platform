<div class="modal fade" id="pagoModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Comprobante pago</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route('notas_cosmica.update_pago', $item->id) }}" enctype="multipart/form-data" role="form">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group col-12">
                            <label for="name">Comprobante pago</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/user/icons/picture.png') }}" alt="" width="35px">
                                    </span>
                                    <input class="form-control" type="file" id="foto_pago" name="foto_pago">
                                </div>
                        </div>

                        <div class="col-12">
                            <embed src="{{ asset('pago_fuera/'.$item->foto_pago) }}" type="application/pdf" style="width: 450px; height: 400px;" />
                        </div>
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
