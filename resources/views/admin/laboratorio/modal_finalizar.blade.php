<!-- Modal -->
<div class="modal fade" id="ordenes_lab_update_finalizar{{ $item->id }}" tabindex="-1" aria-labelledby="modal_documentosLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">

        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modal_documentosLabel">Finalizar pedido</h1>
            <button type="button" class="btn-secondary" data-bs-dismiss="modal" aria-label="Close">X</button>
        </div>

          <div class="modal-body row">

            <form method="POST" action="{{ route('ordenes_lab_update_finalizar.update',$item->id ) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">

                <div class="row">
                    <div class="form-group col-12">
                        <label for="name">¿Por que se finalizara? *</label>
                        <div class="input-group">
                            <textarea class="form-control" name="comentario" id="comentario" cols="30" rows="10" required></textarea>
                        </div>
                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-success btn-xs w-100 ">Finalizar</button>
                    </div>
                </div>
            </form>

          </div>
      </div>
    </div>
</div>
