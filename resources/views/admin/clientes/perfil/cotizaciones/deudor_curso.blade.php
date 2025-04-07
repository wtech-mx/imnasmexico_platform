<!-- Modal -->
@php
   $precio_curso = $pago_fuera->OrdersTickets->Cursos->precio;
   $abono = $pago_fuera->PagosFuera->abono;
   $restande = $precio_curso - $abono;
@endphp
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
                            <label for="">Fecha de ingreso</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="30px">
                                </span>
                                <input id="fecha_hora_1" name="fecha_hora_1" type="text" class="form-control" value="{{ \Carbon\Carbon::parse($pago_fuera->fecha)->translatedFormat('d \d\e F h:i a') }}" disabled>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="">Usario que lo registro</label><br>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/ine.png') }}" alt="" width="30px">
                                </span>
                                <input id="usuario" name="usuario" type="text" class="form-control" value="{{$pago_fuera->User->name}}" disabled>
                            </div>
                        </div>

                        <div class="col-2">
                            <label>Deudor</label>
                            <div class="form-check">
                                @if ($pago_fuera->PagosFuera->deudor == '1')
                                    <input class="form-check-input" type="checkbox" id="deudor" name="deudor" checked disabled>
                                @else
                                    <input class="form-check-input" type="checkbox" id="deudor" name="deudor" disabled>
                                @endif
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="abono">Abono 1</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/dar-dinero.png') }}" alt="" width="30px">
                                </span>
                                <input id="abono" name="abono" type="number" class="form-control" value="{{$pago_fuera->PagosFuera->abono}}" disabled>
                            </div>
                        </div>

                        <div class="form-group col-12">
                            <label for="">Curso</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/acta.png') }}" alt="" width="30px">
                                </span>
                                <input id="" name="" type="text" class="form-control" value="{{$pago_fuera->PagosFuera->curso}}" disabled>
                            </div>
                        </div>

                        <div class="col-12">
                            <p class="text-left mt-3 mb-3"><strong>Agregar restante del pago:</strong></p>
                        </div>

                        <form method="POST" action="{{ route('pagos.update_deudores', $pago_fuera->PagosFuera->id) }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                            <input id="fecha_hora_2" name="fecha_hora_2" type="hidden"  value="{{ $fechaActual }}">

                            <div class="col-12">
                                <div class="col-12">
                                    <div class="form-group">
                                      <label for="comentario">Comentarios y/o Nota</label>
                                      <textarea class="form-control" name="comentario" id="comentario" cols="30" rows="3">{{$pago_fuera->PagosFuera->comentario}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row" id="">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="foto2">Comprobante</label>
                                        <input id="foto2" name="foto2" type="file" class="form-control" @if($pago_fuera->PagosFuera->foto2) disabled @endif>
                                        @error('foto2') <span class="error text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="abono2">Abono 2</label>
                                        <input id="abono2" name="abono2" type="number" class="form-control" value="{{ $pago_fuera->PagosFuera->abono2 ? $pago_fuera->PagosFuera->abono2 : $restande }}" @if($pago_fuera->PagosFuera->abono2) disabled @endif>
                                    </div>
                                </div>

                                <div class="col-6">
                                    @if(!$pago_fuera->PagosFuera->foto2 && !$pago_fuera->PagosFuera->abono2)
                                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                                    @endif
                                </div>

                                <div class="col-6">
                                    <label for="abono2">Fecha y hora del abono 2</label>
                                    <input id="fecha_hora_2" name="fecha_hora_2" type="text" class="form-control" value="{{$pago_fuera->PagosFuera->fecha_hora_2}}" disabled>
                                </div>
                            </div>
                        </form>

                        <div class="col-6">
                            <div class="form-group  mt-3">
                                <label for="foto">Comprobante 1</label> <br>
                                @if (pathinfo($pago_fuera->PagosFuera->foto, PATHINFO_EXTENSION) === 'pdf')
                                    <iframe src="{{ asset('pago_fuera/'.$pago_fuera->PagosFuera->foto) }}" width="100%" height="500px"></iframe>
                                @else
                                    <img id="blah" src="{{ asset('pago_fuera/'.$pago_fuera->PagosFuera->foto) }}" alt="Imagen" style="width: 100%">
                                @endif
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="foto">Comprobante 2</label> <br>
                                @if (pathinfo($pago_fuera->PagosFuera->foto2, PATHINFO_EXTENSION) === 'pdf')
                                    <iframe src="{{ asset('pago_fuera/'.$pago_fuera->PagosFuera->foto2) }}" width="100%" ></iframe>
                                @else
                                    <img id="blah" src="{{ asset('pago_fuera/'.$pago_fuera->PagosFuera->foto2) }}" alt="Imagen" style="width: 100%">
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
        </div>
    </div>
</div>
