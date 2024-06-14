<!-- Modal -->
<div class="modal fade" id="edit_guia_{{ $registro_imnas->id }}" tabindex="-1" role="dialog" aria-labelledby="update_cliente_{{ $registro_imnas->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $registro_imnas->nombre }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('update_guia.imnas', $registro_imnas->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body">

                <div class="row">
                    <input id="id_registro" name="id_registro" class="form-control" value="{{ $registro_imnas->id }}" type="hidden">
                    <div class="col-12 form-group">
                        <label for="name">Fecha de solicitud</label>
                        <input type="date" class="form-control" value="{{ $registro_imnas->fecha_compra }}" readonly>
                    </div>
                    <div class="col-6 form-group">
                        <label for="name">Fecha realizados</label>
                        <input type="date" class="form-control" value="{{ $registro_imnas->fecha_realizados }}" readonly>
                    </div>
                    <div class="col-6 form-group">
                        <label for="name">Fecha de envio</label>
                        <input type="date" class="form-control" value="{{ $registro_imnas->fecha_enviados }}" readonly>
                    </div>
                    <div class="col-6 form-group">
                        <label for="name">Guia de envio</label>
                        <input id="num_guia" name="num_guia" type="text" class="form-control" value="{{ $registro_imnas->num_guia }}" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>

        </div>
    </div>
</div>
