<!-- filepath: c:\laragon\www\imnasmexico_platform\resources\views\admin\products\modal_categorias.blade.php -->
<!-- Modal -->
<div class="modal fade" id="create_categoria" tabindex="-1" role="dialog" aria-labelledby="create_categoria" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create_categoria">Crear Categoria</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('store_categorias') }}" enctype="multipart/form-data" role="form">
                @csrf

                <div class="modal-body row">
                    <div class="form-group col-md-6">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="linea">Línea</label>
                        <select name="linea" class="form-control" required>
                            <option value="facial">Facial</option>
                            <option value="corporal">Corporal</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="fecha_inicio">Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="fecha_fin">Fecha de Fin</label>
                        <input type="date" name="fecha_fin" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="descuento">Descuento</label>
                        <input type="number" name="descuento" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="estatus_descuento">Línea</label>
                        <select name="estatus_descuento" class="form-control" required>
                            <option value="Activo">Facial</option>
                            <option value="Pausa">Pausa</option>
                        </select>
                    </div>


                    <div class="form-group col-md-6">
                        <label for="estatus_visibilidad">Estatus Visibilidad</label>
                        <input type="text" name="estatus_visibilidad" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="color">Color</label>
                        <input type="color" name="color" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="frase">Frase</label>
                        <input type="text" name="frase" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="imagen">Imagen</label>
                        <input type="file" name="imagen" class="form-control">
                    </div>

                    <div class="form-group col-md-6">
                        <label for="portada">Portada</label>
                        <input type="file" name="portada" class="form-control">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
