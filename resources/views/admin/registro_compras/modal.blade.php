<!-- Modal -->
<div class="modal fade" id="modal{{ $compra->id }}" tabindex="-1" role="dialog" aria-labelledby="modal{{ $compra->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >{{ $compra->nombre }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 form-group">
                            <label for="name">Nombre</label>
                            <input type="text" class="form-control" value="{{ $compra->nombre }}" readonly>
                        </div>
                        <div class="col-6 form-group">
                            <label for="name">Telefono</label>
                            <input type="text" class="form-control" value="{{ $compra->telefono }}" readonly>
                        </div>
                        <div class="col-6 form-group">
                            <label for="name">Correo</label>
                            <input type="text" class="form-control" value="{{ $compra->correo }}" readonly>
                        </div>
                        <div class="col-6 form-group">
                            <label for="name">Ciudad</label>
                            <input type="text" class="form-control" value="{{ $compra->ciudad }}" readonly>
                        </div>
                        <div class="col-6 form-group">
                            <label for="name">Monto</label>
                            <input type="text" class="form-control" value="{{ $compra->monto }}" readonly>
                        </div>
                        <div class="col-6 form-group">
                            <label for="name">Distribucion</label>
                            <input type="text" class="form-control" value="{{ $compra->distribucion }}" readonly>
                        </div>
                        <div class="col-6 form-group">
                            <label for="name">Distribucion</label>
                            <textarea class="form-control" cols="30" rows="3">{{$compra->sugerencia}}</textarea>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
