<!-- Modal -->
<div class="modal fade" id="modal_documentos{{ $cliente->id }}" tabindex="-1" role="dialog" aria-labelledby="modal_documentos{{ $cliente->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_documentos{{ $cliente->id }}">{{ $cliente->name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

            <form method="POST" action="{{ route('clientes.update_documentos', $cliente->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">

                <div class="modal-body row">

                    @if(!empty($documentos))
                        @foreach($documentos as $documento)
                            @if(($documento->id_usuario == $cliente->id))

                                <div class="col-6 form-group">
                                    <label for="ine">INE </label>
                                    <input id="ine" name="ine" type="file" class="form-control" >
                                    <img id="blah" src="{{asset('documentos/'.$documento->ine) }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                </div>

                                <div class="col-6 form-group">
                                    <label for="curp">CURP</label>
                                    <input id="curp" name="curp" type="file" class="form-control" >
                                    <img id="blah" src="{{asset('documentos/'.$documento->curp) }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                </div>

                                <div class="col-6 form-group">
                                    <label for="foto_tam_titulo">Foto tamaño titulo</label>
                                    <input id="foto_tam_titulo" name="foto_tam_titulo" type="file" class="form-control" >
                                    <img id="blah" src="{{asset('documentos/'.$documento->foto_tam_titulo) }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                </div>

                                <div class="col-6 form-group">
                                    <label for="foto_tam_infantil">Foto tamaño Infantil</label>
                                    <input id="foto_tam_infantil" name="foto_tam_infantil" type="file" class="form-control" >
                                    <img id="blah" src="{{asset('documentos/'.$documento->foto_tam_infantil) }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                </div>

                                <div class="col-6 form-group">
                                    <label for="carta_compromiso">Carta Compromiso</label>
                                    <input id="carta_compromiso" name="carta_compromiso" type="file" class="form-control" >
                                    <img id="blah" src="{{asset('documentos/'.$documento->carta_compromiso) }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                </div>

                                <div class="col-6 form-group">
                                    <label for="firma">Firma</label>
                                    <input id="firma" name="firma" type="file" class="form-control" >
                                    <img id="blah" src="{{asset('documentos/'.$documento->firma) }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                </div>

                                @else
                                <div class="col-6 form-group">
                                    <label for="ine">INE </label>
                                    <input id="ine" name="ine" type="file" class="form-control" >
                                </div>

                                <div class="col-6 form-group">
                                    <label for="curp">CURP</label>
                                    <input id="curp" name="curp" type="file" class="form-control" >
                                </div>

                                <div class="col-6 form-group">
                                    <label for="foto_tam_titulo">Foto tamaño titulo</label>
                                    <input id="foto_tam_titulo" name="foto_tam_titulo" type="file" class="form-control" >
                                </div>

                                <div class="col-6 form-group">
                                    <label for="foto_tam_infantil">Foto tamaño Infantil</label>
                                    <input id="foto_tam_infantil" name="foto_tam_infantil" type="file" class="form-control" >
                                </div>

                                <div class="col-6 form-group">
                                    <label for="carta_compromiso">Carta Compromiso</label>
                                    <input id="carta_compromiso" name="carta_compromiso" type="file" class="form-control" >
                                </div>

                                <div class="col-6 form-group">
                                    <label for="firma">Firma</label>
                                    <input id="firma" name="firma" type="file" class="form-control" >
                                </div>
                            @endif
                        @endforeach
                    @endif

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>

            </form>

        </div>
    </div>
</div>
