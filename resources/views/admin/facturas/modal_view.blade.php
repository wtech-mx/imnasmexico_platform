<!-- Modal -->
<div class="modal fade" id="update_cliente_{{ $factura->id }}" tabindex="-1" role="dialog" aria-labelledby="update_cliente_{{ $factura->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="update_cliente_{{ $factura->id }}">{{ $factura->User->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('perfil.update_situacionfiscal', $factura->User->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body row">
                        <div class="col-12 form-group">
                            <label for="rfc">RFC</label>
                            <input id="rfc" name="rfc" type="text" class="form-control" disabled value="{{ $factura->User->rfc }}">
                        </div>
                        <div class="col-12 form-group">
                            <label for="razon_social">Razon social</label>
                            <input id="razon_social" name="razon_social" type="text" class="form-control" disabled value="{{ $factura->User->razon_social }}">
                        </div>
                        <div class="col-12 form-group">
                            <label for="cfdi">CFDI</label>
                            <input id="cfdi" name="cfdi" type="text" class="form-control" disabled value="{{ $factura->User->cfdi }}">
                        </div>
                        <div class="col-12 form-group">
                            <label for="cfdi">direccion</label>
                            <textarea class="form-control" name="" id="" cols="30" rows="3" disabled>
                                {{ $factura->User->direccion }}
                            </textarea>
                        </div>

                        <div class="col-12 form-group">
                            <label for="cfdi">Situacion Fiscal</label>
                            <input id="situacion_fiscal" name="situacion_fiscal" type="file" class="form-control" value="">
                        </div>

                        <div class="col-12">
                            <p class="text-center">
                            @if ($factura->User->situacion_fiscal != '' )
                                <a target="_blank" href="{{ asset('documentos/' . $factura->User->telefono . '/' . $factura->User->situacion_fiscal) }}">
                                    Ver Situacion Fiscal
                                </a>
                                @else
                                No hay situacion fiscal
                            @endif
                            </p>
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>

        </div>
    </div>
</div>
