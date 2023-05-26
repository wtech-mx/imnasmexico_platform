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

                <nav class="mt-3">
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
                                        @if (pathinfo($documento->ine, PATHINFO_EXTENSION) == 'pdf')
                                            <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine)}}" style="width: 100%; height: 350px;"></iframe>
                                            <p class="text-center ">
                                                <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver archivo</a>
                                            </p>
                                        @else
                                        <p class="text-center mt-2">
                                            <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine) }}" alt="Imagen" style="width: 250px;height: 100%;"/><br>
                                            <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver Imagen</a>
                                        </p>

                                        @endif
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="curp">CURP</label>
                                        <input id="curp" name="curp" type="file" class="form-control" >
                                        @if (pathinfo($documento->curp, PATHINFO_EXTENSION) == 'pdf')
                                        <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp)}}" style="width: 100%; height: 350px;"></iframe>
                                        <p class="text-center">
                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver archivo</a>
                                        </p>
                                        @elseif (pathinfo($documento->curp, PATHINFO_EXTENSION) == 'png' || pathinfo($documento->curp, PATHINFO_EXTENSION) == 'jpg' || pathinfo($documento->curp, PATHINFO_EXTENSION) == 'jpeg')
                                        <p class="text-center mt-2">
                                            <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" alt="Imagen" style="width: 250px;height: 100%;"/><br>
                                            <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver Imagen</a>
                                        </p>
                                        @endif
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="foto_tam_titulo">Foto tamaño titulo</label>
                                        <input id="foto_tam_titulo" name="foto_tam_titulo" type="file" class="form-control" >
                                        @if (pathinfo($documento->foto_tam_titulo, PATHINFO_EXTENSION) == 'pdf')
                                            <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo)}}" style="width: 100%; height: 350px;"></iframe>
                                            <p class="text-center">
                                                <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver archivo</a>
                                            </p>
                                        @elseif (pathinfo($documento->foto_tam_titulo, PATHINFO_EXTENSION) == 'png' || pathinfo($documento->foto_tam_titulo, PATHINFO_EXTENSION) == 'jpg' || pathinfo($documento->foto_tam_titulo, PATHINFO_EXTENSION) == 'jpeg')
                                        <p class="text-center mt-2">
                                            <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo) }}" alt="Imagen" style="width: 250px;height: 100%;"/><br>
                                            <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver Imagen</a>
                                        </p>
                                        @endif

                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="foto_tam_infantil">Foto tamaño Infantil</label>
                                        <input id="foto_tam_infantil" name="foto_tam_infantil" type="file" class="form-control" >
                                        @if (pathinfo($documento->foto_tam_infantil, PATHINFO_EXTENSION) == 'pdf')
                                        <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil)}}" style="width: 100%; height: 350px;"></iframe>
                                        <p class="text-center text-dark">
                                            <a class="btn btn-sm btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil)}}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver archivo</a>
                                        </p>
                                        @elseif (pathinfo($documento->foto_tam_infantil, PATHINFO_EXTENSION) == 'png' || pathinfo($documento->foto_tam_infantil, PATHINFO_EXTENSION) == 'jpg' || pathinfo($documento->foto_tam_infantil, PATHINFO_EXTENSION) == 'jpeg')
                                        <p class="text-center mt-2">
                                            <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" alt="Imagen" style="width: 250px;height: 100%;"/><br>
                                            <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver Imagen</a>
                                        </p>
                                        @endif
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="carta_compromiso">Carta Compromiso</label>
                                        <input id="carta_compromiso" name="carta_compromiso" type="file" class="form-control" >
                                        @if (pathinfo($documento->carta_compromiso, PATHINFO_EXTENSION) == 'pdf')
                                        <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->carta_compromiso)}}" style="width: 100%; height: 350px;"></iframe>
                                        <p class="text-center ">
                                            <a class="btn btn-sm btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->carta_compromiso)}}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver archivo</a>
                                        </p>
                                        @elseif (pathinfo($documento->carta_compromiso, PATHINFO_EXTENSION) == 'png' || pathinfo($documento->carta_compromiso, PATHINFO_EXTENSION) == 'jpg' || pathinfo($documento->carta_compromiso, PATHINFO_EXTENSION) == 'jpeg')
                                        <p class="text-center mt-2">
                                            <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->carta_compromiso) }}" alt="Imagen" style="width: 250px;height: 100%;"/><br>
                                            <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->carta_compromiso) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver Imagen</a>
                                        </p>
                                        @endif
                                    </div>

                                    <div class="col-6 form-group">
                                        <label for="firma">Firma</label>
                                        <input id="firma" name="firma" type="file" class="form-control" >
                                        @if (pathinfo($documento->firma, PATHINFO_EXTENSION) == 'pdf')
                                        <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma)}}" style="width: 100%; height: 350px;"></iframe>
                                        <p class="text-center ">
                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma)}}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver archivo</a>
                                        </p>
                                        @elseif (pathinfo($documento->firma, PATHINFO_EXTENSION) == 'png' || pathinfo($documento->firma, PATHINFO_EXTENSION) == 'jpg' || pathinfo($documento->firma, PATHINFO_EXTENSION) == 'jpeg')
                                        <p class="text-center mt-2">
                                            <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma) }}" alt="Imagen" style="width: 250px;height: 100%;"/><br>
                                            <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver Imagen</a>
                                        </p>
                                        @endif
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
                            <button type="submit" class="btn close-modal" style="">Guardar</button>
                        </div>

                    </form>
                </div>

                <div class="tab-pane fade" id="nav-register{{ $cliente->id }}" role="tabpanel" aria-labelledby="nav-register-tab" tabindex="0" style="min-height: auto!important;">
                    @php
                        $tiene_documentos_estandar = false;
                    @endphp
                        <form  method="POST" action="{{ route('documentos.store', $cliente->id) }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <div class="modal-body row">
                                <div class="col-12">
                                    <input class="form-control" type="file" name="archivos[]" multiple>
                                </div>
                                @foreach($cliente->DocumentosEstandares as $documento)
                                <div class="col-6 form-group">
                                    @if (pathinfo($documento->documento, PATHINFO_EXTENSION) == 'pdf')
                                        <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->documento)}}" style="width: 100%; height: 350px;"></iframe>
                                    @else
                                        <p class="text-center mt-2">
                                            <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->documento) }}" alt="Imagen" style="width: 220px;height: 100%;"/>
                                            <a href="{{ route('descargar_documento', ['id' => $documento->id, 'cliente_id' => $cliente->id]) }}">
                                                Descargar
                                            </a>
                                        </p>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                            </div>
                        </form>

                </div>
            </div>

        </div>
    </div>
</div>
