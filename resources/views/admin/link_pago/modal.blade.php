{{-- — Modal para Crear/Editar — --}}
<div class="modal fade" id="modalLinkPago" tabindex="-1" aria-labelledby="modalLinkPagoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="formLinkPago">
                @csrf
                {{-- Para actualizar usaremos método PUT --}}
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" name="id" id="linkPago_id">

                <div class="modal-header">
                    <h5 class="modal-title" id="modalLinkPagoLabel">Crear Link Pago</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <div class="modal-body">
                    {{-- Mensaje de validación --}}
                    <div id="formErrors" class="alert alert-danger d-none"></div>

                    <div class="mb-3">
                        <label for="cliente" class="form-label">Cliente</label>
                        <input
                            type="text"
                            class="form-control"
                            id="cliente"
                            name="cliente"
                            placeholder="Nombre del cliente"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input
                            type="text"
                            class="form-control"
                            id="titulo"
                            name="titulo"
                            placeholder="Título del enlace"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <textarea
                            class="form-control"
                            id="descripcion"
                            name="descripcion"
                            rows="2"
                            placeholder="Descripción (opcional)"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="estatus" class="form-label">Estatus</label>
                        <select class="form-select" id="estatus" name="estatus" required>
                            <option value="">-- Seleccionar estatus --</option>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="monto" class="form-label">Monto</label>
                        <input
                            type="number"
                            step="0.01"
                            min="0"
                            class="form-control"
                            id="monto"
                            name="monto"
                            placeholder="Monto (0.00)"
                            required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-secondary"
                        data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary" id="btnGuardar">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
