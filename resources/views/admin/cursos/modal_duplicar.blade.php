<!-- Modal para ingresar las fechas y horas de inicio y finalización -->
<div class="modal fade" id="duplicarModal{{ $curso->id }}" tabindex="-1" role="dialog" aria-labelledby="duplicarModalLabel{{ $curso->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="duplicarModalLabel{{ $curso->id }}">Duplicar Curso</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para ingresar las fechas y horas de inicio y finalización -->
                <form action="{{ route('cursos.duplicar', $curso->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="fecha_inicio">Fecha de inicio</label>
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="hora_inicio">Hora de inicio</label>
                                <select class="form-control" id="hora_inicio" name="hora_inicio" required>
                                    <option value="11:00">11 am</option>
                                    <option value="15:00">03 pm</option>
                                    <option value="19:00">07 pm</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="fecha_final">Fecha de finalización</label>
                                <input type="date" class="form-control" id="fecha_final" name="fecha_final" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="hora_final">Hora de finalización</label>
                                <select class="form-control" id="hora_final" name="hora_final" required>
                                    <option value="15:00">03 pm</option>
                                    <option value="19:00">07 pm</option>
                                    <option value="22:30">10:30 pm</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-check col-6">
                            <label for="nota">Sin Hora F.</label>
                            <div class="form-group">
                                <input class="form-check-input" type="checkbox" value="1" id="sin_fin" name="sin_fin">
                            </div>
                        </div>

                        <div class="form-check col-6">
                            <label for="nota">Liga de Meet</label>
                            <input type="text" id="recurso" name="recurso" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Duplicar Curso</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
