<div class="modal fade" id="alertaModal" tabindex="-1" aria-labelledby="alertaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titulo_modal"></h5>
                <a class="btn btn-warning" href="{{ route('etiquetas_nas.pdf') }}" target="_blank">Imprimir</a>
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
                            @if ($item->etiqueta_lateral <= 50)
                                <p style="background-color: #e74c3c; color:#fff">{{ $item->etiqueta_lateral }}</p>
                            @elseif ($item->etiqueta_lateral > 51 && $item->etiqueta_lateral <= 150)
                                <p style="background-color: #e7dc3c; color:#fff">{{ $item->etiqueta_lateral }}</p>
                            @elseif ($item->etiqueta_lateral > 151)
                                <p style="background-color: #72e73c; color:#fff">{{ $item->etiqueta_lateral }}</p>
                            @endif
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
                            @if ($item->etiqueta_tapa <= 50)
                                <p style="background-color: #e74c3c; color:#fff">{{ $item->etiqueta_tapa }}</p>
                            @elseif ($item->etiqueta_tapa > 51 && $item->etiqueta_tapa <= 150)
                                <p style="background-color: #e7dc3c; color:#fff">{{ $item->etiqueta_tapa }}</p>
                            @elseif ($item->etiqueta_tapa > 151)
                                <p style="background-color: #72e73c; color:#fff">{{ $item->etiqueta_tapa }}</p>
                            @endif
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
                            @if ($item->etiqueta_frente <= 50)
                                <p style="background-color: #e74c3c; color:#fff">{{ $item->etiqueta_frente }}</p>
                            @elseif ($item->etiqueta_frente > 51 && $item->etiqueta_frente <= 150)
                                <p style="background-color: #e7dc3c; color:#fff">{{ $item->etiqueta_frente }}</p>
                            @elseif ($item->etiqueta_frente > 151)
                                <p style="background-color: #72e73c; color:#fff">{{ $item->etiqueta_frente }}</p>
                            @endif
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
                            @if ($item->etiqueta_reversa <= 50)
                                <p style="background-color: #e74c3c; color:#fff">{{ $item->etiqueta_reversa }}</p>
                            @elseif ($item->etiqueta_reversa > 51 && $item->etiqueta_reversa <= 150)
                                <p style="background-color: #e7dc3c; color:#fff">{{ $item->etiqueta_reversa }}</p>
                            @elseif ($item->etiqueta_reversa > 151)
                                <p style="background-color: #72e73c; color:#fff">{{ $item->etiqueta_reversa }}</p>
                            @endif
                        </div>
                        <div class="col-3 text-center">
                            Reversa
                        </div>
                    </div>
                    <hr style="height:2px;border-width:0;color:gray;background-color:gray;">
                @endforeach
            </div>
            <div class="modal-footer">
                <a class="btn btn-warning" href="{{ route('etiquetas_nas.pdf') }}" target="_blank">Imprimir</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
