<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="EditexampleModal{{$video->id}}" tabindex="-1" role="dialog" aria-labelledby="EditexampleModal{{$video->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear video</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('videos_cam.update', $video->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">

                    <div class="modal-body">
                        <div class="row">

                            <div class="col-12">
                                <h5>Datos personales</h5>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Orden *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/expediente.png') }}" alt="" width="35px">
                                        </span>
                                        <select name="orden" id="orden" class="form-select d-inline-block" required>
                                            <option selected>{{ $video->orden }}</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                            <option value="6">6</option>
                                            <option value="7">7</option>
                                            <option value="8">8</option>
                                            <option value="9">9</option>
                                            <option value="10">10</option>
                                            <option value="11">11</option>
                                            <option value="12">12</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Nombre del video *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre" value="{{ $video->nombre }}">@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">Tipo</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/etiqueta.png') }}" alt="" width="35px">
                                        </span>
                                        <select name="tipo" id="tipo" class="form-select d-inline-block" required>
                                            <option selected>{{ $video->tipo }}</option>
                                            <option value="Evaluador Independiente">Evaluador Independiente</option>
                                            <option value="Centro Evaluador">Centro Evaluador</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name"> Link Video *</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets/cam/reproductor-de-video.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="link" name="link" type="text" class="form-control" placeholder="Link" value="{{ $video->video_url }}">@error('link') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
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
