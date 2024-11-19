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
                <div class="col-6">
                    <h5>Nombre</h5>
                </div>
                <div class="col-3 text-center">
                    <h5>Stock</h5>
                </div>
                <div class="col-3 text-center">
                    <h5>Tipo</h5>
                </div>
                @foreach ($etiqueta_lateral as $item)
                    <div class="row mb-2">
                        <div class="col-6">
                           <b> {{ $item->nombre }} </b>
                        </div>
                        <div class="col-3 text-center">
                            {{ $item->etiqueta_lateral }}
                        </div>
                        <div class="col-3 text-center">
                            Lateral
                        </div>
                    </div>
                    <hr style="height:2px;border-width:0;color:gray;background-color:gray;">
                @endforeach
                @foreach ($etiqueta_tapa as $item)
                    <div class="row mb-2">
                        <div class="col-6">
                        <b> {{ $item->nombre }} </b>
                        </div>
                        <div class="col-3 text-center">
                            {{ $item->etiqueta_tapa }}
                        </div>
                        <div class="col-3 text-center">
                            Tapa
                        </div>
                    </div>
                    <hr style="height:2px;border-width:0;color:gray;background-color:gray;">
                @endforeach
                @foreach ($etiqueta_frente as $item)
                    <div class="row mb-2">
                        <div class="col-6">
                        <b> {{ $item->nombre }} </b>
                        </div>
                        <div class="col-3 text-center">
                            {{ $item->etiqueta_frente }}
                        </div>
                        <div class="col-3 text-center">
                            Frente
                        </div>
                    </div>
                    <hr style="height:2px;border-width:0;color:gray;background-color:gray;">
                @endforeach
                @foreach ($etiqueta_reversa as $item)
                    <div class="row mb-2">
                        <div class="col-6">
                        <b> {{ $item->nombre }} </b>
                        </div>
                        <div class="col-3 text-center">
                            {{ $item->etiqueta_reversa }}
                        </div>
                        <div class="col-3 text-center">
                            Reversa
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
