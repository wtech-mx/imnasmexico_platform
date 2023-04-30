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

                <nav>
                    <div class="d-flex justify-content-center">
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link active" id="nav-login-tab" data-bs-toggle="tab" data-bs-target="#nav-login{{ $cliente->id }}" type="button" role="tab" aria-controls="nav-login{{ $cliente->id }}" aria-selected="true">
                                Oficiales
                            </button>

                            <button class="nav-link" id="nav-register-tab" data-bs-toggle="tab" data-bs-target="#nav-register{{ $cliente->id }}" type="button" role="tab" aria-controls="nav-register{{ $cliente->id }}" aria-selected="false">
                                Estandares
                            </button>
                        </div>
                    </div>
                </nav>

            <div class="tab-content" id="nav-tabContent" style="">

                <div class="tab-pane fade show active" id="nav-login{{ $cliente->id }}" role="tabpanel" aria-labelledby="nav-login-tab" tabindex="0" style="min-height: auto!important;">
                    <form method="POST" action="{{ route('clientes.update_documentos', $cliente->id) }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">

                        <div class="modal-body row">
                            @php
                                $tiene_documentos = false;
                            @endphp
                            @foreach($documentos as $documento)
                                @if($documento->id_usuario == $cliente->id)
                                    @php
                                        $tiene_documentos = true;
                                    @endphp
                                    <div class="col-6 form-group">
                                        <label for="ine">INE </label>
                                        <input id="ine" name="ine" type="file" class="form-control" >
                                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine) }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="curp">CURP</label>
                                        <input id="curp" name="curp" type="file" class="form-control" >
                                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="foto_tam_titulo">Foto tamaño titulo</label>
                                        <input id="foto_tam_titulo" name="foto_tam_titulo" type="file" class="form-control" >
                                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo) }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="foto_tam_infantil">Foto tamaño Infantil</label>
                                        <input id="foto_tam_infantil" name="foto_tam_infantil" type="file" class="form-control" >
                                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="carta_compromiso">Carta Compromiso</label>
                                        <input id="carta_compromiso" name="carta_compromiso" type="file" class="form-control" >
                                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->carta_compromiso) }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="firma">Firma</label>
                                        <input id="firma" name="firma" type="file" class="form-control" >
                                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma) }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                    </div>
                                @endif
                            @endforeach

                            @if($tiene_documentos)
                                <!-- Si el usuario tiene documentos, no mostramos el formulario -->
                            @else
                                <!-- Si el usuario no tiene documentos, mostramos el formulario -->
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

                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                        </div>

                    </form>
                </div>

                <div class="tab-pane fade" id="nav-register{{ $cliente->id }}" role="tabpanel" aria-labelledby="nav-register-tab" tabindex="0" style="min-height: auto!important;">
                    @php
                        $tiene_documentos_estandar = false;
                    @endphp
                    <ul>
                        @foreach($documentos_estandares as $documento)
                            @if($documento->id_usuario == $cliente->id)
                                @php
                                    $tiene_documentos = true;
                                @endphp
                                <li>{{ $documento->documento }} <a href="{{ route('descargar_documento', ['id' => $documento->id, 'cliente_id' => $cliente->id]) }}">Descargar</a></li>
                            @endif
                        @endforeach
                    </ul>

                    @if($tiene_documentos)
                        <!-- Si el usuario tiene documentos, no mostramos el formulario -->
                        @else
                        <p>No se han subido archivos aún.</p>
                    @endif

                    <form method="POST" action="{{ route('documentos.store', $cliente->id) }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <input type="file" name="archivos[]" multiple>
                        <button type="submit">Subir archivos</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
