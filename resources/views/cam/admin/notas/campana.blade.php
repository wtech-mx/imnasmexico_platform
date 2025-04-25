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
                <div class="col-4 text-center">
                    <h5>Dias</h5>
                </div>
                @foreach ($notas_faltan_5_dias as $item)
                    <div class="row mb-2">
                        <div class="col-8">
                        <b> {{ $item->Cliente->name }} </b>
                        </div>
                        <div class="col-4  text-center">
                            5
                        </div>
                    </div>
                    <hr style="height:2px;border-width:0;color:gray;background-color:gray;">
                @endforeach
                @foreach ($notas_faltan_10_dias as $item)
                    <div class="row mb-2">
                        <div class="col-8">
                           <b> {{ $item->Cliente->name }} </b>
                        </div>
                        <div class="col-4  text-center">
                            10
                        </div>
                    </div>
                    <hr style="height:2px;border-width:0;color:gray;background-color:gray;">
                @endforeach
            </div>
            <div class="modal-footer">
                <a class="btn btn-warning" href="{{ route('envases.pdf') }}" target="_blank">Imprimir</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
