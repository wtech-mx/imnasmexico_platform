<!-- Modal -->
<div class="modal fade" id="estatus_{{ $nota->id }}" tabindex="-1" role="dialog" aria-labelledby="estatus_{{ $nota->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Productos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <form class="form" action="{{ route('distribuidoras.update_estatus', $nota->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <h4>¿Cambiar estatus a Aprobado?</h4>
                        <img id="blah" src="{{ asset('assets/user/icons/cheque-de-pago.png') }}" alt="Imagen" style="width: 50%">
                        <div class="col-12 mt-2">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
