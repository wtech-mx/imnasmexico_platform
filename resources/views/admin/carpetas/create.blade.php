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
            <form method="POST" action="{{ route('carpetas.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body row">

                    <div class="form-group col-12">
                        <label for="name">Nombre</label>
                        <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre" required>@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group col-6">
                        <label for="">Area: </label>
                            <select name="area" id="area" class="form-select">
                                <option value="Material">Material</option>
                                <option value="Literatura">Literatura</option>
                            </select>
                    </div>

                    <div class="form-group col-6">
                        <label for="">Sub Area: </label>
                            <select name="area" id="area" class="form-select">
                                <option value="corporal">corporal</option>
                                <option value="facial">facial</option>
                            </select>
                    </div>

                    <div class="col-12">
                        <input class="form-control" type="file" name="archivos[]" multiple>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
