<!-- Modal -->
<div class="modal fade" id="exampleModal_{{$item->id}}" tabindex="-1" aria-labelledby="exampleModal_{{$item->id}}Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModal_{{$item->id}}Label">Estatus</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body row">

            <form method="POST" action="{{ route('bitacora_documentos.update', $item->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">

                    <div class="col-12 form-group">
                        <label for="rfc">Etatus</label>
                        <select class="form-select" aria-label="Default select example" id="estatus" name="estatus">
                            <option value="">Selciona una opcion</option>
                            <option value="Enviado x paqueteria">Enviado x paqueteria</option>
                            <option value="Enviado  x email">Enviado  x email</option>
                            <option value="En Espera">En Espera</option>
                            <option value="Generado">Generado</option>
                            <option value="Cancelado">Cancelado</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff"> <i class="fa fa-send" title="Ver Orden"></i>actualziar</button>
                    </div>
            </form>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
