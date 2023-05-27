<!-- Modal -->
<div class="modal fade" id="factura{{ $factura->id }}" tabindex="-1" role="dialog" aria-labelledby="factura{{ $factura->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="factura{{ $factura->id }}">{{ $factura->User->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('facturas.update', $factura->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" id="id_user" name="id_user"  value="{{ $factura->User->id }}">

                <div class="modal-body row">
                        <div class="col-12 form-group">
                            <label for="rfc">Etatus</label>
                            <select class="form-select" aria-label="Default select example" id="estatus" name="estatus">
                                <option selected>{{ $factura->estatus }}</option>
                                <option value="En Proceso">En Proceso</option>
                                <option value="En Espera">En Espera</option>
                                <option value="Realizado">Realizado</option>
                            </select>
                        </div>

                        <div class="col-12 form-group">
                            <div class="form-group">
                                <label for="factura">Factura PDF</label>
                                <input type="file" id="factura" name="factura" class="form-control">
                            </div>
                        </div>

                        <div class="col-12">
                            <p class="text-center">
                            @if ($factura->factura != '' )
                                <a target="_blank" href="{{ asset('documentos/' . $factura->User->telefono . '/' . $factura->factura) }}">
                                    Ver Factura
                                </a>
                                @else
                               No se ha cargado la Factura
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
