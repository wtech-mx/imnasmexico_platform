<!-- Modal -->
<div class="modal fade" id="manual_update_{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="manual_update_{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manual_update_{{ $item->id }}">Crear Documento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form method="POST" action="{{ route('documentos.update', $item->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body row">

                    <div class="form-group col-12">
                        <label for="name">Nombre</label>
                        <input id="nombre" name="nombre" type="text" class="form-control" required value="{{ $item->nombre }}">
                    </div>

                    <div class="form-group col-12">
                        <label for="name">Tipo</label>
                        <select name="tipo" id="tipo" class="form-select">
                            <option value="{{ $item->tipo }}">{{ $item->tipo }}</option>
                            <option value="Cedula de indetidad">CN - Cedula de identidad papel</option>
                            <option value="Credencial">CN - Credencial plastico</option>
                            <option value="Diploma">CN - Diploma</option>
                            <option value="Titulo Honorifico con QR">CN - Titulo Honorifico con QR</option>
                            <option value="Titulo Honorifico con QR">CN - Titulo Honorifico CFC</option>
                            <option value="Tira de materias">CN - Tira de materias</option>
                            <option value="Diploma_STPS">Diploma - STPS</option>
                            <option value="Titulo Honorifico Nuevo">Titulo Honorifico Nuevo</option>
                        </select>
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Imagen de portada</label>
                        <input type="file" name="img_portada" id="img_portada" class="form-control">
                        <img id="blah" src="{{ asset('tipos_documentos/'.$item->img_portada) }}" alt="Imagen" style="width:300px;">

                    </div>

                    <div class="form-group col-6">
                        <label for="name">Imagen de Reverso</label>
                        <input type="file" name="img_reverso" id="img_reverso" class="form-control">
                        <img id="blah" src="{{ asset('tipos_documentos/'.$item->img_reverso) }}" alt="Imagen" style="width:300px;">

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
