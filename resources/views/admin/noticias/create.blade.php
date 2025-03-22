<!-- Modal -->
<div class="modal fade" id="create_noticia" tabindex="-1" role="dialog" aria-labelledby="create_noticia" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create_noticia">Crear Noticia</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
            <form method="POST" action="{{ route('noticias.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body row">
                    <div class="col-12 form-group">
                        <label for="name">Titulo *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/user/icons/abc-block.png') }}" alt="" width="35px">
                            </span>
                            <input id="titulo" name="titulo" type="text" class="form-control"  required>@error('titulo') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-12 form-group">
                        <label for="link">Link</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/user/icons/clic2.png') }}" alt="" width="35px">
                            </span>
                            <input id="link" name="link" type="text" class="form-control" >@error('link') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-6 form-group">
                        <label for="name">Tipo</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/change.png') }}" alt="" width="35px">
                            </span>
                            <select name="tipo" id="tipo" class="form-select d-inline-block" required>
                                <option value="">Seleccione una opción</option>
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
                            <select name="estatus" id="estatus" class="form-select d-inline-block" required>
                                <option value="">Seleccione una opción</option>
                                <option value="Activo" {{ old('estatus') == 'Activo' ? 'selected' : '' }}>Activo</option>
                                <option value="Desactivado" {{ old('estatus') == 'Desactivado' ? 'selected' : '' }}>Desactivado</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 form-group">
                        <label for="estatus">Descripcion</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" style="height: 100px"></textarea>
                    </div>

                    <div class="col-12 form-group">
                        <label for="image">Imagen / Video</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/user/icons/picture.png') }}" alt="" width="35px">
                            </span>
                            <input id="multimedia" name="multimedia" type="file" class="form-control">@error('multimedia') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-6 form-group">
                        <label for="name">Orden</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/user/icons/informacion.png') }}" alt="" width="35px">
                            </span>

                            <input id="orden" name="orden" type="number" class="form-control" >@error('orden') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="col-6 form-group">
                        <label for="seccion">Seccion</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/carta_res.png') }}" alt="" width="35px">
                            </span>
                            <select name="seccion" id="seccion" class="form-select d-inline-block" required>
                                <option value="">Seleccione una opción</option>
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

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
