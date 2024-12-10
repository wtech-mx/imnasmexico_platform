<div class="modal fade" id="alertaModal" tabindex="-1" aria-labelledby="alertaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titulo_modal"></h5>
                <a class="btn btn-warning" href="{{ route('granel.pdf') }}" target="_blank">Imprimir</a>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <div class="modal-body row">
                <div class="col-8">
                    <h5>Nombre</h5>
                </div>
                <div class="col-3 text-center">
                    <h5>Stock</h5>
                </div>
                @foreach ($bajo_granel as $item)
                    <div class="row mb-2">
                        <div class="col-8">
                           <b> {{ $item->nombre }} </b>
                        </div>
                        <div class="col-3 text-center" style="background-color: #e74c3c; color:#fff">
                            {{ number_format($item->conteo_lab, 2) }}
                        </div>
                    </div>
                    <hr style="height:2px;border-width:0;color:gray;background-color:gray;">
                @endforeach
                @foreach ($medio_granel as $item)
                    <div class="row mb-2">
                        <div class="col-8">
                        <b> {{ $item->nombre }} </b>
                        </div>
                        <div class="col-3 text-center" style="background-color: #e7dc3c; color:#fff">
                            {{ number_format($item->conteo_lab, 2) }}
                        </div>
                    </div>
                    <hr style="height:2px;border-width:0;color:gray;background-color:gray;">
                @endforeach
            </div>
            <div class="modal-footer">
                <a class="btn btn-warning" href="{{ route('granel.pdf') }}" target="_blank">Imprimir</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
