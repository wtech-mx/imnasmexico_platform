<!-- Modal -->
<div class="modal fade" id="modal_imnas_guia_{{ $order->User->id }}" tabindex="-1" aria-labelledby="modal_documentosLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm">
      <div class="modal-content">

        <div class="modal-header">
            <h1 class="modal-title fs-5" id="modal_documentosLabel">Cargar Guia</h1>
            <button type="button" class="btn-secondary" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

          <div class="modal-body row">

            <form method="POST" action="{{ route('cursos.update_guia',$order->id ) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">

                <div class="row">
                    <div class="form-group col-12">
                        <label for="name">Guia de Docuementos -*</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/firma-digital.png')}}" alt="" width="30px">
                            </span>
                            <input id="guia_doc" name="guia_doc" type="file" class="form-control">
                        </div>
                    </div>

                    <div class="col-12">

                        @if (pathinfo($order->guia, PATHINFO_EXTENSION) == 'pdf')
                            <iframe class="mt-2" src="{{asset('guias/' .$order->guia)}}" style="width: 100%; height: 350px;"></iframe>
                        @endif

                    </div>

                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-success     btn-xs w-100 " >Cargar Guia</button>
                    </div>
                </div>
            </form>

          </div>
      </div>
    </div>
</div>
