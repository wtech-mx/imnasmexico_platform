<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear carpeta</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
            <form method="POST" action="{{ route('crear_carpeta.documentos') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body">
                    <div class="row">

                        <div class="col-12">
                            <div class="form-group">
                                <label for="name">Sección</label>
                                <select name="nombre" id="nombre" class="form-select d-inline-block">
                                    <option value="Manuales Digitales CONOCER">Manuales Digitales CONOCER</option>
                                    <option value="REGLAMENTO Y MANUALES DE PROCEDIMIENTOS IMNAS">REGLAMENTO Y MANUALES DE PROCEDIMIENTOS IMNAS</option>
                                    <option value="FORMATOS RESOLUCION DE QUEJAS">FORMATOS RESOLUCION DE QUEJAS</option>
                                    <option value="LOGO CONOCER EVALUADOR INDEPENDIENTE">LOGO CONOCER EVALUADOR INDEPENDIENTE</option>
                                    <option value="ACREDITACION CE o EI">ACREDITACION CE o EI</option>
                                    <option value="ESPECIFICACIONES FOTOGRAFIA">ESPECIFICACIONES FOTOGRAFIA</option>
                                    <option value="OPERACION CE">OPERACION CE</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <input class="form-control" type="file" name="archivos[]" multiple>
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
