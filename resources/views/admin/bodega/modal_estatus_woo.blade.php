<div class="modal fade" id="estatusModal_woo_{{$order->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title">Cambio de Estatus Woo #{{$order->id}}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form method="POST" action="{{ route('notas_cotizacion.update_estatus', $order->id) }}" enctype="multipart/form-data" role="form">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
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

                                @if(isset($order->meta_data))
                                    @foreach($order->meta_data as $meta)
                                        @if($meta->key == 'fecha_y_hora_guia')

                                            @if ($meta->value == NULL)
                                                <input class="form-control" type="text" disabled>
                                            @else
                                                <input class="form-control" type="text" value="{{ \Carbon\Carbon::parse($meta->value)->isoFormat('dddd DD MMMM hh:mm a') }}" disabled>
                                            @endif

                                        @endif
                                    @endforeach
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
                                @if(isset($order->meta_data))
                                    @foreach($order->meta_data as $meta)
                                        @if($meta->key == 'preparado_hora_y_guia')

                                            @if ($meta->value == NULL)
                                                <input class="form-control" type="text" disabled>
                                            @else
                                                <input class="form-control" type="text" value="{{ \Carbon\Carbon::parse($meta->value)->isoFormat('dddd DD MMMM hh:mm a') }}" disabled>
                                            @endif

                                        @endif
                                    @endforeach
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
                                @if(isset($order->meta_data))
                                    @foreach($order->meta_data as $meta)
                                        @if($meta->key == 's')

                                            @if ($meta->value == NULL)
                                                <input class="form-control" type="text" disabled>
                                            @else
                                                <input class="form-control" type="text" value="{{ \Carbon\Carbon::parse($meta->value)->isoFormat('dddd DD MMMM hh:mm a') }}" disabled>
                                            @endif

                                        @endif
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </form>

      </div>
    </div>
  </div>
