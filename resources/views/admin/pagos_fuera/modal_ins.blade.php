<!-- Modal -->
<div class="modal fade" id="showDataModal{{$pago_fuera->id}}" tabindex="-1" role="dialog" aria-labelledby="showDataModal{{$pago_fuera->id}}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Ver Pago</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>

            </div>
                <div class="modal-body">

                    <div class="row">

                            <div class="form-group col-6">
                                <label for="">Fecha y hora de ingreso</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="30px">
                                    </span>
                                    <input id="fecha_hora_1" name="fecha_hora_1" type="text" class="form-control" value="{{$pago_fuera->fecha_hora_1}}" disabled>
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label for="">Usario que lo registro</label><br>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/ine.png') }}" alt="" width="30px">
                                    </span>
                                    <input id="usuario" name="usuario" type="text" class="form-control" value="{{$pago_fuera->usuario}}" disabled>
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label for="">Nombre de cliente</label><br>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/medico.png') }}" alt="" width="30px">
                                    </span>
                                    <input id="nombre" name="nombre" type="text" class="form-control" value="{{$pago_fuera->nombre}}" disabled>
                                </div>
                            </div>


                            <div class="form-group col-6">
                                <label for="">Correo</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/correo-electronico.png') }}" alt="" width="30px">
                                    </span>
                                    <input id="correo" name="correo" type="email" class="form-control" value="{{$pago_fuera->correo}}" disabled>
                                </div>
                            </div>

                            <div class="form-group col-12">
                                <label for="">Curso</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/acta.png') }}" alt="" width="30px">
                                    </span>
                                    <input id="" name="" type="text" class="form-control" value="{{$pago_fuera->curso}}" disabled>
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label for="">Forma de pago</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/metodo-de-pago.png') }}" alt="" width="30px">
                                    </span>
                                    <input id="curso" name="curso" type="text" class="form-control" value="{{$pago_fuera->modalidad}}" disabled>
                                </div>
                            </div>

                            <div class="form-group col-6">
                                <label for="">Telefono</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets/cam/llamar.png') }}" alt="" width="30px">
                                    </span>
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

                        <div class="form-group col-4">
                            <label>Monto *</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/dinero.png') }}" alt="" width="30px">
                                </span>
                                <input class="form-control" type="number" id="pago" name="pago" value="{{$pago_fuera->monto}}" disabled>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="abono">Abono 1</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/dar-dinero.png') }}" alt="" width="30px">
                                </span>
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

                        <div class="col-12">
                            <h4 class="text-left mt-3 mb-3"><strong>Comprobacion de pagos por transferencia o deposito</strong></h4>
                        </div>

                        <div class="col 12">

                            <p class="d-inline-flex gap-1">
                                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                    Comprobar pago Banxico <img src="https://www.banxico.org.mx/DIBM/resources/img/logoBM-Monograma.png" alt="" style="width: 20px">
                                </a>
                              </p>

                              <div class="collapse" id="collapseExample">
                                <div class="card card-body row" style="padding: 0 !important;border: solid 5px #836263;border-radius: 10px;">
                                    <div class="col-12">
                                        <iframe src="https://www.banxico.org.mx/cep/" frameborder="0" style="width: 100%;height: 600px;"></iframe>
                                    </div>
                                </div>
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
