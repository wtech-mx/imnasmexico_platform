<!-- Modal -->
<div class="modal fade" id="estatus_{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="estatus_{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xs" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Cambiar estatus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body">

                    <form class="form row" action="{{ route('distribuidoras.update_estatus', $item->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <h4 class="text-center">¿Cambiar estatus?</h4>



                        <div class="form-group">
                            <label for="name">Estatus *</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">
                                    <img src="{{ asset('assets/cam/change.png') }}" alt="" width="35px">
                                </span>
                                <select class="form-select d-inline-block"  data-toggle="select" id="estatus_cotizacion" name="estatus_cotizacion" value="{{ old('estatus_cotizacion') }}">
                                    <option value="">Seleccionar Estatus</option>
                                    {{-- <option value="Pendiente">Pendiente</option> --}}
                                    <option value="Aprobada">Aprobada</option>
                                    <option value="Cancelada">Cancelada</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 mt-5">
                            <div class="d-flex justify-content-center">
                                <button type="submit" class="btn btn-success">Aprobar</button>
                            </div>
                        </div>

                    </form>

            </div>

        </div>
    </div>
</div>
