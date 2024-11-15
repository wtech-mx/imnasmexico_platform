<div class="modal fade" id="alertaModal" tabindex="-1" aria-labelledby="alertaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titulo_modal"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body row">
                <div class="col-8">
                    <h5>Nombre</h5>
                </div>
                <div class="col-2 text-center">
                    <h5>Stock</h5>
                </div>
                @foreach ($envases_vencer as $item)
                    <div class="row mb-2">
                        <div class="col-8">
                           <b> {{ $item->envase }} </b>
                        </div>
                        <div class="col-2 text-center">
                            {{ $item->conteo }}
                        </div>
                        <div class="col-12">
                            {{ $item->descripcion }}
                        </div>
                    </div>
                    <hr style="height:2px;border-width:0;color:gray;background-color:gray;">
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
