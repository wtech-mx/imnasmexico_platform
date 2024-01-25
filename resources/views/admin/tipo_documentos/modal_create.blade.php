<!-- Modal -->
<div class="modal fade" id="create_manual" tabindex="-1" role="dialog" aria-labelledby="create_manual" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create_manual">Crear Manual</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form method="POST" action="{{ route('documentos.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body row">

                    <div class="form-group col-12">
                        <label for="name">Nombre</label>
                        <input id="nombre" name="nombre" type="text" class="form-control" required >
                    </div>

                    <div class="form-group col-12">
                        <label for="name">Tipo</label>
                        <select name="tipo" id="tipo" class="form-select">
                            <option value="Cedula de indetidad">CN - Cedula de identidad papel</option>
                            <option value="Credencial">CN - Credencial plastico</option>
                            <option value="Diploma">CN - Diploma</option>
                            <option value="Titulo Honorifico con QR">CN - Titulo Honorifico con QR</option>
                            <option value="Titulo Honorifico con QR_CFC">CN - Titulo Honorifico CFC</option>
                            <option value="Tira de materias">CN - Tira de materias</option>
                            <option value="Diploma_STPS">Diploma - STPS</option>
                            <option value="Titulo Honorifico Nuevo">Titulo Honorifico Nuevo</option>

                        </select>
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Imagen de portada</label>
                        <input type="file" name="img_portada" id="img_portada" class="form-control">
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Imagen de Reverso</label>
                        <input type="file" name="img_reverso" id="img_reverso" class="form-control">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
