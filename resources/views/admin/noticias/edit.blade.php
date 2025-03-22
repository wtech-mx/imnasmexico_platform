<!-- Modal -->
<div class="modal fade" id="edit_noticia{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="edit_noticia{{$item->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_noticia{{$item->id}}">Editar Noticia</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
            <form method="POST" action="{{ route('noticias.update', $item->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">@csrf
                <div class="modal-body row">
                    <div class="col-12 form-group">
                        <label for="name">Titulo *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/user/icons/abc-block.png') }}" alt="" width="35px">
                            </span>
                            <input id="titulo" name="titulo" type="text" class="form-control"  value="{{ $item->titulo }}">@error('titulo') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-12 form-group">
                        <label for="link">Link</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/user/icons/clic2.png') }}" alt="" width="35px">
                            </span>
                            <input id="link" name="link" type="text" class="form-control" value="{{ $item->link }}">@error('link') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-6 form-group">
                        <label for="name">Tipo</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/change.png') }}" alt="" width="35px">
                            </span>
                            <select name="tipo" id="tipo" class="form-select d-inline-block" value="{{ $item->id }}">
                                <option selected>{{ $item->tipo }}</option>
                                <option value="imagen" {{ old('tipo') == 'imagen' ? 'selected' : '' }}>imagen</option>
                                <option value="Video" {{ old('tipo') == 'Video' ? 'selected' : '' }}>Video</option>
                            </select>
                        </div>

                    </div>

                    <div class="col-6 form-group">
                        <label for="estatus">Estatus</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/gestion-del-cambio.png') }}" alt="" width="35px">
                            </span>
                            <select name="estatus" id="estatus" class="form-select d-inline-block" value="{{ $item->id }}">
                                <option selected>{{ $item->estatus }}</option>
                                <option value="Activo" {{ old('estatus') == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Desactivado" {{ old('estatus') == 'Desactivado' ? 'selected' : '' }}>Desactivado</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 form-group">
                        <label for="estatus">Descripcion</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" style="height: 100px">{{ $item->descripcion }}</textarea>
                    </div>

                    <div class="col-12 form-group">
                        <label for="image">Imagen / Video</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/user/icons/picture.png') }}" alt="" width="35px">
                            </span>
                            <input id="multimedia" name="multimedia" type="file" class="form-control">
                        </div>

                    </div>

                    <div class="col-6 form-group">
                        <label for="name">Orden</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/user/icons/informacion.png') }}" alt="" width="35px">
                            </span>
                            <input id="orden" name="orden" type="text" class="form-control" value="{{ $item->orden }}">
                        </div>
                    </div>

                    <div class="col-6 form-group">
                        <label for="seccion">Seccion</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/carta_res.png') }}" alt="" width="35px">
                            </span>
                            <select name="seccion" id="seccion" class="form-select d-inline-block" value="{{ $item->id }}">
                                <option selected>{{ $item->seccion }}</option>
                                <option value="NAS_SLIDE" {{ old('seccion') == 'NAS_SLIDE' ? 'selected' : '' }}>NAS Tienda Slide</option>
                                <option value="NAS_BANNER" {{ old('seccion') == 'NAS_BANNER' ? 'selected' : '' }}>NAS Banner</option>
                                <option value="Cosmica" {{ old('seccion') == 'Cosmica' ? 'selected' : '' }}>Tienda Cosmica</option>
                                <option value="Inicio" {{ old('seccion') == 'Inicio' ? 'selected' : '' }}>Inicio</option>
                                <option value="Videos_Alumnas" {{ old('seccion') == 'Videos_Alumnas' ? 'selected' : '' }}>Videos_Alumnas</option>
                                <option value="Videos_Productos" {{ old('seccion') == 'Videos_Productos' ? 'selected' : '' }}>Videos_Productos</option>
                                <option value="Galeria Cursos" {{ old('seccion') == 'Galeria Cursos' ? 'selected' : '' }}>Galeria Cursos</option>

                            </select>
                        </div>
                    </div>

                    <div class="col-12">
                        <img id="blah" src="{{asset('noticias/'.$item->multimedia) }}" alt="Imagen" style="width: 100%; height: auto;"/>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>
