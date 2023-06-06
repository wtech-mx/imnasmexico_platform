<!-- Modal -->
<div class="modal fade" id="create_reality" tabindex="-1" role="dialog" aria-labelledby="create_reality" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create_reality">Reality</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
            <form method="POST" action="{{ route('reality.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" name="nombre" type="text" class="form-control"  required>@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="facebook">facebook</label>
                        <input id="facebook" name="facebook" type="text" class="form-control" >@error('facebook') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="instagram">instagram</label>
                        <input id="instagram" name="instagram" type="text" class="form-control" >@error('instagram') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="tiktok">tiktok</label>
                        <input id="tiktok" name="tiktok" type="text" class="form-control" >@error('tiktok') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group">
                        <label for="Estatus">Estatus</label>
                        <select name="estatus" id="estatus" class="form-control">
                            <option value="Activo">Activo</option>
                            <option value="Desabilitado">Desabilitado</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="foto_perfil">image</label>
                        <input id="foto_perfil" name="foto_perfil" type="file" class="form-control">@error('foto_perfil') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
