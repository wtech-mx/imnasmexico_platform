<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Crear Pago sss</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
            <form method="POST" action="{{ route('pagos.store') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input id="nombre" name="nombre" type="text" class="form-control" placeholder="Nombre" required>@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="name">Apellido</label>
                                <input id="apellido" name="apellido" type="text" class="form-control" placeholder="Apellido" required>@error('nombre') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input id="correo" name="correo" type="email" class="form-control" placeholder="correo" required>@error('correo') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="curso">Curso</label>
                        <input id="curso" name="curso" type="text" class="form-control" placeholder="curso" required>@error('curso') <span class="error text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nota">Modalidad</label>
                                <select id="modalidad" name="modalidad" class="form-control" required>
                                    <option value="Online">Online</option>
                                    <option value="Presencial">Presencial</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="telefono">Telefono</label>
                                <input id="telefono" name="telefono" type="tel" minlength="10" maxlength="10" class="form-control" placeholder="55-55-55-55" pattern="[0-9]{10}" required>@error('telefono') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                <input id="foto" name="foto" type="file" class="form-control" placeholder="foto" required>@error('foto') <span class="error text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-2">
                            <label>Deudor</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="deudor" name="deudor" value="1" id="flexCheckChecked">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="abono">Abono</label>
                                <input id="abono" name="abono" type="number" class="form-control" placeholder="Abono">@error('abono') <span class="error text-danger">{{ $message }}</span> @enderror
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
