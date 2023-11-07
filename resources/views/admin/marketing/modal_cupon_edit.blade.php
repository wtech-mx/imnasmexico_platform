<!-- Modal -->
<div class="modal fade" id="update_cupon_{{ $cupon->id }}" tabindex="-1" role="dialog" aria-labelledby="update_cupon_{{ $cupon->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="update_cupon_{{ $cupon->id }}">Editar  cupon</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
            <form method="POST" action="{{ route('cupones.update', $cupon->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">

                <div class="modal-body row">
                <div class="form-group col-6">
                    <label class="" for="nombre">Nombre</label>
                    <div class="input-group mb-2 mr-sm-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text">@</div>
                      </div>
                      <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $cupon->nombre }}">
                    </div>
                </div>

                <div class="form-group col-6">
                    <label class="" for="nombre">Tipo de descuento</label>
                    <input type="text" class="form-control" id="tipo_de_descuento" name="tipo_de_descuento" value="porcentaje" readonly>
                </div>

                <div class="form-group col-6">
                    <label class="" for="importe">Descuento en %</label>
                    <div class="input-group mb-2 mr-sm-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text">@</div>
                      </div>
                      <input type="number" class="form-control" id="importe" name="importe" value="{{ $cupon->importe }}">
                    </div>
                </div>

                <div class="form-group col-6">
                    <label class="" for="gasto_min">Gasto Minimo</label>
                    <div class="input-group mb-2 mr-sm-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text">@</div>
                      </div>
                      <input type="number" class="form-control" id="gasto_min" name="gasto_min" value="{{ $cupon->gasto_min }}">
                    </div>
                </div>

                <div class="form-group col-6">
                    <label class="" for="fecha_inicio">Fecha de inicio</label>
                    <div class="input-group mb-2 mr-sm-2">
                      <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="{{ $cupon->fecha_inicio }}">
                    </div>
                </div>

                <div class="form-group col-6">
                    <label class="" for="fecha_fin">Fecha de Fin</label>
                    <div class="input-group mb-2 mr-sm-2">
                      <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="{{ $cupon->fecha_fin }}">
                    </div>
                </div>


                {{-- <div class="form-group col-12">
                    <label class="" for="nombre">Incluir Cursos</label>
                    <select id="inc_cursos" name="inc_cursos" class="form-control" >
                      <option selected>Seleciona el curso </option>
                    </select>
                </div>

                <div class="form-group col-12">
                    <label class="" for="nombre">Excluir Cursos</label>
                    <select id="exc_cursos" name="exc_cursos" class="form-control" >
                      <option selected>Seleciona el curso </option>
                    </select>
                </div> --}}

                <div class="form-group col-12">
                    <label class="" for="nombre">Estado</label>
                    <select id="estado" name="estado" class="form-control" >
                      <option selected>Seleciona el estado </option>
                      <option value="activo">Activo</option>
                      <option value="desactivado">Desactivado</option>
                    </select>
                </div>

                <div class="form-group col-6">
                    <label class="" for="limite_uso_por_cupon">Limite de uso por cupon</label>
                    <div class="input-group mb-2 mr-sm-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text">@</div>
                      </div>
                      <input type="number" class="form-control" id="limite_uso_por_cupon" name="limite_uso_por_cupon" value="{{ $cupon->limite_uso_por_cupon }}">
                    </div>
                </div>

                {{-- <div class="form-group col-6">
                    <label class="" for="limite_uso_por_usuario">Limite de uso po usuarios</label>
                    <div class="input-group mb-2 mr-sm-2">
                      <div class="input-group-prepend">
                        <div class="input-group-text">@</div>
                      </div>
                      <input type="number" class="form-control" id="limite_uso_por_usuario" name="limite_uso_por_usuario" value="{{ $cupon->limite_uso_por_usuario }}">
                    </div>
                </div> --}}

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
