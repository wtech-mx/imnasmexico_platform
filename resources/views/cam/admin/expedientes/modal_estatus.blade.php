<!-- Modal -->
<div class="modal fade bd-example-modal-sm" id="exampleModalEstatus{{$estandar_usuario->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('expediente.estatus', $estandar_usuario->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <h5>Cambio de Estatus</h5>
                            </div>
                            <input type="hidden" name="_method" value="PATCH">
                            <input type="hidden" name="id_client" id="id_client" value="{{ $expediente->Nota->id_cliente }}">
                            <input type="hidden" name="id_nota" id="id_nota" value="{{ $expediente->Nota->id }}">
                            <div class="form-group">
                                <label for="name">Evaluador</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="evaluador" name="evaluador" type="text" class="form-control" value="{{$estandar_usuario->evaluador}}" placeholder="Evaluador">@error('evaluador') <span class="error text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name">Estatus *</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/carta_res.png') }}" alt="" width="35px">
                                    </span>
                                    <select name="estatus" id="estatus" class="form-select d-inline-block" required>
                                        <option value="{{$estandar_usuario->estatus}}">{{$estandar_usuario->estatus}}</option>
                                        <option value="Programado">Programado</option>
                                        <option value="Evaluado">Evaluado</option>
                                        <option value="En proceso">En proceso</option>
                                        <option value="Entregado">Entregado</option>
                                        <option value="Entregado por otra identidad">Entregado por otra identidad</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name">Fecha evaluación</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="fecha_evaluar" name="fecha_evaluar" type="date" class="form-control" value="{{$estandar_usuario->fecha_evaluar}}" >
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                </div>

            </form>

        </div>
    </div>
</div>
