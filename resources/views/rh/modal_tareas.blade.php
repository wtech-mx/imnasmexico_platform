<div class="modal fade" id="tareasModal" tabindex="-1" aria-labelledby="tareasModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Crear Tarea</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form method="POST" action="{{ route('store.nominas_avisos') }}" id="" enctype="multipart/form-data" role="form">
            @csrf

            <div class="modal-body">
                <div class="row">
                    <div class="col-12 form-group">
                        <label for="name">Titulo *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="25px">
                            </span>
                            <input name="titulo" id="titulo" type="text" class="form-control" required>
                        </div>
                    </div>

                    <div class="col-12 form-group">
                        <label for="name">Descripcion *</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/inventario.png.webp') }}" alt="" width="25px">
                            </span>
                            <textarea name="descripcion" id="descripcion" class="form-control" rows="3" required></textarea>
                        </div>
                    </div>

                    <div class="col-12 form-group">
                        <label for="name">Fecha de Programada</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/calendario.webp') }}" alt="" width="25px">
                            </span>
                            <input name="fecha_programada" id="fecha_programada" type="datetime-local" class="form-control">
                        </div>
                    </div>

                    <div class="col-6 form-group">
                        <label for="name">Tipo</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/expediente.png') }}" alt="" width="25px">
                            </span>
                            <select id="tipo" name="tipo" class="form-select" required>
                                <option value="Junta">Junta</option>
                                <option value="Aviso">Aviso</option>
                                <option value="Tarea">Tarea</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-6 form-group">
                        <label for="name">Prioridad</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/opciones.webp') }}" alt="" width="25px">
                            </span>
                            <select id="tipo_prioridad" name="tipo_prioridad" class="form-select">
                                <option value="">Seleccionar opcion</option>
                                <option value="Urgente">Urgente</option>
                                <option value="Importante">Importante</option>
                                <option value="Ni Urgente ni Importante">Ni Urgente ni Importante</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-12 form-group">
                        <label for="name">Url</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/web-link.png') }}" alt="" width="25px">
                            </span>
                            <input name="url" id="url" type="text" class="form-control">
                        </div>
                    </div>

                    <div class="col-12 form-group">
                        <label for="name">Documento</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/usuario.png') }}" alt="" width="25px">
                            </span>
                            <input name="documento1" id="documento1" type="file" class="form-control">
                        </div>
                    </div>

                    <div class="col-6 form-group">
                        <label for="name">Asignar</label>
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets/cam/opciones.webp') }}" alt="" width="25px">
                            </span>
                            <select name="empleados[]" id="empleados[]" class="form-select empleados" multiple="multiple" required style="width: 70%!important;">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{$user->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Guardar</button>
              </div>
        </form>
      </div>
    </div>
  </div>
