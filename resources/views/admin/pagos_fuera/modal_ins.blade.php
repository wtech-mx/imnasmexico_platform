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
                    <div class="form-group">
                        <label for="name">Nombre</label><br>
                        <textarea cols="50" rows="3" disabled>{{$pago_fuera->nombre}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo</label>
                        <input id="correo" name="correo" type="email" class="form-control" value="{{$pago_fuera->correo}}" disabled>
                    </div>

                    <div class="form-group">
                        <label for="curso">Curso</label><br>
                        <textarea cols="50" rows="3" disabled>{{$pago_fuera->curso}}</textarea>
                    </div>

                    <div class="row">
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
                        <div class="col-6">
                            <div class="form-group">
                                <label for="foto">Foto</label>
                                @if (pathinfo($pago_fuera->foto, PATHINFO_EXTENSION) === 'pdf')
                                    <iframe src="{{ asset('pago_fuera/'.$pago_fuera->foto) }}" width="100%" height="500px"></iframe>
                                @else
                                    <img id="blah" src="{{ asset('pago_fuera/'.$pago_fuera->foto) }}" alt="Imagen" style="width: 250px; height: 300px;">
                                @endif
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
                            <div class="form-group">
                                <label for="abono">Abono</label>
                                <input id="abono" name="abono" type="number" class="form-control" value="{{$pago_fuera->abono}}" disabled>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
