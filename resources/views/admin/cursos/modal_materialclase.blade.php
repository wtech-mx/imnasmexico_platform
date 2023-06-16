<!-- Modal -->
<div class="modal fade" id="material_modal_{{ $curso->id }}" tabindex="-1" role="dialog" aria-labelledby="material_modal_{{ $curso->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="material_modal_{{ $curso->id }}">Material de Clase</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="row">
                <div class="col-12">
                    <p class="p-3">{{ $curso->nombre }}</p>
                </div>
            </div>

            <form method="POST" action="{{ route('cursos.material_clase', $curso->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body row">
                    <div class="col-1">
                        <label for="name">-</label>
                        <div class="form-group">
                            <button class="" type="button" id="agregarCampo" style="border-radius: 9px;width: 36px;height: 40px;">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-11">
                        <div class="form-group">
                            <div id="camposContainer">
                                <div class="campo" id="campoExistente">
                                    <div class="row">
                                        <div class="col-7">
                                            <label for="">Nombre</label>
                                            <div class="form-group">
                                                <input type="text" name="campo[]" class="form-control nombre">
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <label for="">Archivo</label>
                                            <div class="form-group">
                                                <input type="file" name="campo1[]" class="form-control archivo">
                                            </div>
                                        </div>
                                    </div>
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
