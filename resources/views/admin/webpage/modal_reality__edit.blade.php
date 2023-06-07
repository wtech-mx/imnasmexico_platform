<!-- Modal -->
<div class="modal fade" id="update_reality_{{ $voto->id }}" tabindex="-1" role="dialog" aria-labelledby="update_reality_{{ $voto->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="update_reality_{{ $voto->id }}">Editar</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
            <form method="POST" action="{{ route('reality.update', $voto->id) }}" enctype="multipart/form-data" role="form">

                @csrf
                <input type="hidden" name="_method" value="PATCH">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input id="nombre" name="nombre" type="text" class="form-control" value="{{ $voto->nombre }}" >
                    </div>

                    <div class="form-group">
                        <label for="facebook">facebook</label>
                        <input id="facebook" name="facebook" type="text" class="form-control" value="{{ $voto->facebook }}">
                    </div>

                    <div class="form-group">
                        <label for="instagram">instagram</label>
                        <input id="instagram" name="instagram" type="text" class="form-control" value="{{ $voto->instagram }}">
                    </div>

                    <div class="form-group">
                        <label for="tiktok">tiktok</label>
                        <input id="tiktok" name="tiktok" type="text" class="form-control" value="{{ $voto->tiktok }}">
                    </div>

                    <div class="form-group">
                        <label for="Estatus">Estatus</label>
                        <select name="estatus" id="estatus" class="form-control">
                            <option selected value="">{{ $voto->estatus }}</option>
                            <option value="Activo">Activo</option>
                            <option value="Desabilitado">Desabilitado</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="image">image</label>
                        <input id="foto_perfil" name="foto_perfil" type="file" class="form-control">
                        <img id="blah" src="{{asset('reality/'.$voto->foto_perfil) }}" alt="Imagen" style="width: 60px; height: 60px;"/></th>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
