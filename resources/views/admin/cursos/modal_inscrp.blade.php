<!-- Modal para ingresar las fechas y horas de inicio y finalización -->
<div class="modal fade" id="inscripcion_{{ $curso->id }}" tabindex="-1" role="dialog" aria-labelledby="inscripcion_{{ $curso->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inscripcion_{{ $curso->id }}">Inscribir a otro curso (Masivo)</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario para ingresar las fechas y horas de inicio y finalización -->
                <form action="{{ route('masiva.inscripcion', $curso->id) }}" method="POST">
                    @csrf
                    <div class="row">
                        <input type="text" class="form-control" id="curso_origen" name="curso_origen" value="{{$curso->id}}">

                        <div class="col-6">
                            <div class="form-group">
                                <label for="fecha_final">Motivo</label>
                                <input type="text" class="form-control" id="forma_pago" name="forma_pago" required>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="">Curso</label>
                                <select class="form-control" id="curso_destino" name="curso_destino" required>
                                    @foreach ($cursos_modal as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}  / {{ $item->Cursos->fecha_inicial }} - {{ $item->Cursos->modalidad }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Duplicar Curso</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
