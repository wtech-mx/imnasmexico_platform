<!-- Modal -->
<div class="modal fade" id="showDataModal{{$pago_fuera->id}}" tabindex="-1" role="dialog" aria-labelledby="showDataModal{{$pago_fuera->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Ver Pago</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
                <div class="modal-body">

                    <div class="row">

                        <div class="col-6">
                            <label for="name">Fecha y hora de ingreso</label><br>
                            <input id="fecha_hora_1" name="fecha_hora_1" type="text" class="form-control" value="{{$pago_fuera->fecha_hora_1}}" disabled>
                        </div>

                        <div class="col-6">
                            <label for="name">Usario que lo registro</label><br>
                            <input id="usuario" name="usuario" type="text" class="form-control" value="{{$pago_fuera->usuario}}" disabled>
                        </div>

                        <div class="form-group col-6 mt-5">
                            <label for="name">Nombre de cliente</label><br>
                            <input id="nombre" name="nombre" type="text" class="form-control" value="{{$pago_fuera->nombre}}" disabled>
                        </div>

                        <div class="form-group col-6 mt-5">
                            <label for="correo">Correo</label>
                            <input id="correo" name="correo" type="email" class="form-control" value="{{$pago_fuera->correo}}" disabled>
                        </div>

                        <div class="form-group col-12">
                            <label for="curso">Curso</label><br>
                            <textarea class="form-control" cols="50" rows="3" disabled>{{$pago_fuera->curso}}</textarea>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="nota">Forma de pago</label>
                                <input id="curso" name="curso" type="text" class="form-control" value="{{$pago_fuera->modalidad}}" disabled>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="telefono">Telefono</label>
                                <input id="telefono" name="telefono" type="number" class="form-control" value="{{$pago_fuera->telefono}}" disabled>
                            </div>
                        </div>

                        <div class="col-2">
                            <label>Deudor</label>
                            <div class="form-check">
                                @if ($pago_fuera->deudor == '1')
                                    <input class="form-check-input" type="checkbox" id="deudor" name="deudor" checked disabled>
                                @else
                                    <input class="form-check-input" type="checkbox" id="deudor" name="deudor" disabled>
                                @endif
                            </div>
                        </div>

                        <div class="col-4">
                            <label>Monto *</label>
                            <div class="form-group">
                                <input class="form-control" type="number" id="pago" name="pago" value="{{$pago_fuera->monto}}" disabled>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="abono">Abono 1</label>
                                <input id="abono" name="abono" type="number" class="form-control" value="{{$pago_fuera->abono}}" disabled>
                            </div>
                        </div>

                        <div class="col-12">
                            <p class="text-left mt-3 mb-3"><strong>Agregar restante del pago:</strong></p>
                        </div>

                        <form method="POST" action="{{ route('pagos.update_deudores', $pago_fuera->id) }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <input id="fecha_hora_2" name="fecha_hora_2" type="hidden"  value="{{ $fechaActual }}">

                            <div class="col-12">
                                <div class="col-12">
                                    <div class="form-group">
                                      <label for="comentario">Comentarios y/o Nota</label>
                                      <textarea class="form-control" name="comentario" id="comentario" cols="30" rows="3">{{$pago_fuera->comentario}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="deudorCampos">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="foto2">Comprobante *</label>
                                        <input id="foto2" name="foto2" type="file" class="form-control" @if($pago_fuera->foto2) disabled @endif required>
                                        @error('foto2') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="abono2">Abono 2</label>
                                        <input id="abono2" name="abono2" type="number" class="form-control" value="{{ $pago_fuera->abono2 ? $pago_fuera->abono2 : '' }}" @if($pago_fuera->abono2) disabled @endif>
                                    </div>
                                </div>

                                <div class="col-6">
                                    @if(!$pago_fuera->foto2 && !$pago_fuera->abono2)
                                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                                    @endif
                                </div>

                                <div class="col-6">
                                    <label for="abono2">Fecha y hora del abono 2</label>
                                    <input id="fecha_hora_2" name="fecha_hora_2" type="text" class="form-control" value="{{$pago_fuera->fecha_hora_2}}" disabled>
                                </div>
                            </div>
                        </form>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="foto">Comprobante 1</label> <br>
                                @if (pathinfo($pago_fuera->foto, PATHINFO_EXTENSION) === 'pdf')
                                    <iframe src="{{ asset('pago_fuera/'.$pago_fuera->foto) }}" width="100%" ></iframe>
                                @else
                                    <img id="blah" src="{{ asset('pago_fuera/'.$pago_fuera->foto) }}" alt="Imagen" style="width: 100%">
                                @endif
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="foto">Comprobante 2</label> <br>
                                @if (pathinfo($pago_fuera->foto2, PATHINFO_EXTENSION) === 'pdf')
                                    <iframe src="{{ asset('pago_fuera/'.$pago_fuera->foto2) }}" width="100%" ></iframe>
                                @else
                                    <img id="blah" src="{{ asset('pago_fuera/'.$pago_fuera->foto2) }}" alt="Imagen" style="width: 100%">
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const deudorCheckbox = document.getElementById('deudor');
        const camposDeudor = document.getElementById('deudorCampos');

        function toggleCamposDeudor() {
            camposDeudor.style.display = deudorCheckbox.checked ? 'block' : 'none';
        }

        // Ejecutar al cargar la página
        toggleCamposDeudor();

        // Ejecutar cuando el checkbox cambie su estado
        deudorCheckbox.addEventListener('change', toggleCamposDeudor);
    });
</script>
