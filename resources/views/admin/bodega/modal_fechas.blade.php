<div class="modal fade" id="estatusFechasModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Bitacora de estatus</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>


                <div class="modal-body">
                    <div class="row">

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Estatus</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/box.png') }}" alt="" width="35px">
                                    </span>
                                    <input class="form-control" type="text" value="En preparación" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Fecha</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/calendarioo.png') }}" alt="" width="35px">
                                    </span>
                                    @if ($item->fecha_preparacion == NULL)
                                        <input class="form-control" type="text" disabled>
                                    @else
                                        <input class="form-control" type="text" value="{{ \Carbon\Carbon::parse($item->fecha_preparacion)->isoFormat('dddd DD MMMM hh:mm a') }}" disabled>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Estatus</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/package.png') }}" alt="" width="35px">
                                    </span>
                                    <input class="form-control" type="text" value="Preparado" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Fecha</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/calendarioo.png') }}" alt="" width="35px">
                                    </span>
                                    @if ($item->fecha_preparado == NULL)
                                        <input class="form-control" type="text" disabled>
                                    @else
                                        <input class="form-control" type="text" value="{{ \Carbon\Carbon::parse($item->fecha_preparado)->isoFormat('dddd DD MMMM hh:mm a') }}" disabled>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Estatus</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/delivery.png') }}" alt="" width="35px">
                                    </span>
                                    <input class="form-control" type="text" value="Enviado" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Fecha</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/calendarioo.png') }}" alt="" width="35px">
                                    </span>
                                    @if ($item->fecha_envio == NULL)
                                        <input class="form-control" type="text" disabled>
                                    @else
                                        <input class="form-control" type="text" value="{{ \Carbon\Carbon::parse($item->fecha_envio)->isoFormat('dddd DD MMMM hh:mm a') }}" disabled>
                                    @endif

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>

      </div>
    </div>
  </div>
