<!-- Modal -->
<div class="modal fade" id="create_recurso" tabindex="-1" role="dialog" aria-labelledby="create_recurso" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Material de Curso</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('recursos.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body row">
                    <div class="col-12">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-7">
                                    <label for="">Nombre del curso</label>
                                    <div class="form-group">
                                        <input type="text" name="nombre" class="form-control nombre">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="">Modalidad</label>
                                    <select class="form-control" id="tipo" name="tipo" required>
                                        <option value="Online">Online</option>
                                        <option value="Presencial">Presencial</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <label for="">Foto curso</label>
                                    <input type="file" id="foto" name="foto" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label for="">Material de clase</label>
                                    <input type="file" id="material" name="material" class="form-control">
                                </div>
                                <div class="col-12">
                                    <label for="">PDF</label>
                                    <input type="file" id="pdf" name="pdf" class="form-control">
                                </div>
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
