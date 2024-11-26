<div class="modal fade" id="modal_foto_{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Cargar Foto #{{$item->folio}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

            <form method="POST" id="myForm" action="{{ route('update.documentos_externo', $item->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">

                <div class="modal-body">
                    <div class="row">

                        <div class="col-12">
                            <div class="form-group">
                                <label for="nota">Foto</label>
                                <input type="file" id="foto" name="foto" class="form-control" >
                            </div>
                        </div>
                        <div class="col-12">
                            <p class="text-center mt-2">
                                <img id="blah" src="{{asset('utilidades_documentos/'.$item->foto) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                             </p>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">
                        Actualizar
                    </button>
                </div>
            </form>

      </div>
    </div>
  </div>
