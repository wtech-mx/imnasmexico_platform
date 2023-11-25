<!-- Modal -->
<div class="modal fade" id="update_modal_{{ $curso->id }}" tabindex="-1" role="dialog" aria-labelledby="update_modal_{{ $curso->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="update_modal_{{ $curso->id }}">Link de Meet y recursos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('cursos.update_meet', $curso->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body row">
                    <div class="col-12">
                        <h6 class="">{{ $curso->nombre }}</h6>
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Clase grabada 1</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/user/icons/grabacion-de-video.png') }}" alt="" width="35px">
                            </span>
                            <input id="clase_grabada" name="clase_grabada" type="text" class="form-control" value="{{ $curso->clase_grabada }}">
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Clase grabada 2</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/user/icons/grabacion-de-video.png') }}" alt="" width="35px">
                            </span>
                            <input id="clase_grabada2" name="clase_grabada2" type="text" class="form-control" value="{{ $curso->clase_grabada2 }}">
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Clase grabada 3</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/user/icons/grabacion-de-video.png') }}" alt="" width="35px">
                            </span>
                            <input id="clase_grabada3" name="clase_grabada3" type="text" class="form-control" value="{{ $curso->clase_grabada3 }}">
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Clase grabada 4</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/user/icons/grabacion-de-video.png') }}" alt="" width="35px">
                            </span>
                            <input id="clase_grabada4" name="clase_grabada4" type="text" class="form-control" value="{{ $curso->clase_grabada4 }}">
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Clase grabada 5</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/user/icons/grabacion-de-video.png') }}" alt="" width="35px">
                            </span>
                            <input id="clase_grabada5" name="clase_grabada5" type="text" class="form-control" value="{{ $curso->clase_grabada5 }}">
                        </div>
                    </div>

                    <div class="form-group col-12">
                        <label for="name">Liga Meet</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/user/icons/meet.png') }}" alt="" width="35px">
                            </span>
                            <input id="recurso" name="recurso" type="text" class="form-control" value="{{ $curso->recurso }}">
                        </div>
                    </div>

                    <div class="col-12">
                        <h4>Reactivacion de videos</h4>
                    </div>

                    <div class="col-12 form-group">
                        <label for="name">Al activar esta opcion se visualizaran las clases grabadas otras 72 horas</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/user/icons/grabacion-de-video.png') }}" alt="" width="35px">
                            </span>
                            <select class="form-control" id="video_cad" name="video_cad">
                                <option value="">Selecione una opcion</option>
                                <option value="1">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>

        </div>
    </div>
</div>
