<div class="row">
    <div class="col-12">
        <h2 class="title_curso mb-5">Reconocimientos</h2>
    </div>


    <nav>
        <div class="d-flex justify-content-center">
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-descargas-tab" data-bs-toggle="tab" data-bs-target="#nav-descargas" type="button" role="tab" aria-controls="nav-descargas" aria-selected="true">
                    Descargas
                </button>

                <button class="nav-link" id="nav-login-tab" data-bs-toggle="tab" data-bs-target="#nav-login" type="button" role="tab" aria-controls="nav-login" aria-selected="true">
                    Oficiales
                </button>

                <button class="nav-link" id="nav-register-tab" data-bs-toggle="tab" data-bs-target="#nav-register" type="button" role="tab" aria-controls="nav-register" aria-selected="false">
                    Estandares
                </button>
            </div>
        </div>
    </nav>

    <div class="tab-content" id="nav-tabContent" style="">
        <div class="tab-pane fade show active" id="nav-descargas" role="tabpanel" aria-labelledby="nav-descargas-tab" tabindex="0" style="min-height: auto!important;">
            <div class="row">
                @foreach ($estandaresComprados as $estandar)
                <div class="col-4">
                        <h4>{{ $estandar->nombre }}</h4> <br>
                            @php
                                $documentos = App\Models\CarpetaDocumentosEstandares::where('id_carpeta', $estandar->id)->get();
                            @endphp
                            @foreach ($documentos as $documento)
                                @if (pathinfo($documento->nombre, PATHINFO_EXTENSION) == 'pdf')
                                    <p class="text-center ">
                                        <img src="{{asset('assets/user/icons/pdf.png') }}" style="width: 70px; height: 70px;"/>
                                        <a class="text-center text-dark btn btn-sm" href="{{asset('carpetasestandares/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                                            Descargar
                                        </a>
                                    </p>
                                @else
                                    <p class="text-center mt-2">
                                        <img src="{{asset('assets/user/icons/docx.png') }}" style="width: 70px; height: 70px;"/>
                                        <a class="text-center text-dark btn btn-sm" href="{{asset('carpetasestandares/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                                            Descargar
                                        </a>
                                    </p>
                                @endif
                            @endforeach
                        </ul>
                </div>
                @endforeach
            </div>
        </div>

        <div class="tab-pane fade" id="nav-login" role="tabpanel" aria-labelledby="nav-login-tab" tabindex="0" style="min-height: auto!important;">
            <form method="POST" action="{{ route('clientes.update_documentos_cliente', $cliente->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">

                <div class="row">
                    @php
                        $tiene_documentos = false;
                    @endphp
                    @foreach($documentos as $documento)
                            @php
                                $tiene_documentos = true;
                            @endphp
                            <div class="col-6 form-group p-3 mt-2">
                                <label for="ine">INE </label>
                                <input id="ine" name="ine" type="file" class="form-control" >
                                @if (pathinfo($documento->ine, PATHINFO_EXTENSION) == 'pdf')
                                    <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine)}}" style="width: 60%; height: 60px;"></iframe>
                                    <p class="text-center ">
                                        <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver archivo</a>
                                    </p>
                                @else
                                    <p class="text-center mt-2">
                                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                        <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver Imagen</a>
                                    </p>
                                @endif
                            </div>

                            <div class="col-6 form-group p-3 mt-2">
                                <label for="curp">CURP</label>
                                <input id="curp" name="curp" type="file" class="form-control" >
                                @if (pathinfo($documento->curp, PATHINFO_EXTENSION) == 'pdf')
                                    <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp)}}" style="width: 60%; height: 60px;"></iframe>
                                    <p class="text-center ">
                                        <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver archivo</a>
                                    </p>
                                @else
                                    <p class="text-center mt-2">
                                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                        <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver Imagen</a>
                                    </p>
                                @endif
                            </div>

                            <div class="col-6 form-group p-3 mt-2">
                                <label for="foto_tam_titulo">Foto tamaño titulo</label>
                                <input id="foto_tam_titulo" name="foto_tam_titulo" type="file" class="form-control" >
                                @if (pathinfo($documento->foto_tam_titulo, PATHINFO_EXTENSION) == 'pdf')
                                    <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo)}}" style="width: 60%; height: 60px;"></iframe>
                                    <p class="text-center ">
                                        <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver archivo</a>
                                    </p>
                                @else
                                    <p class="text-center mt-2">
                                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                        <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver Imagen</a>
                                    </p>
                                @endif
                            </div>

                            <div class="col-6 form-group p-3 mt-2">
                                <label for="foto_tam_infantil">Foto tamaño Infantil</label>
                                <input id="foto_tam_infantil" name="foto_tam_infantil" type="file" class="form-control" >
                                @if (pathinfo($documento->foto_tam_infantil, PATHINFO_EXTENSION) == 'pdf')
                                    <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil)}}" style="width: 60%; height: 60px;"></iframe>
                                    <p class="text-center ">
                                        <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver archivo</a>
                                    </p>
                                @else
                                    <p class="text-center mt-2">
                                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                        <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver Imagen</a>
                                    </p>
                                @endif
                            </div>

                            <div class="col-6 form-group p-3 mt-2">
                                <label for="carta_compromiso">Carta Compromiso</label>
                                <input id="carta_compromiso" name="carta_compromiso" type="file" class="form-control" >
                                @if (pathinfo($documento->carta_compromiso, PATHINFO_EXTENSION) == 'pdf')
                                    <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->carta_compromiso)}}" style="width: 60%; height: 60px;"></iframe>
                                    <p class="text-center ">
                                        <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->carta_compromiso) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver archivo</a>
                                    </p>
                                @else
                                    <p class="text-center mt-2">
                                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->carta_compromiso) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                        <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->carta_compromiso) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver Imagen</a>
                                    </p>
                                @endif
                            </div>

                            <div class="col-6 form-group p-3 mt-2">
                                <label for="firma">Firma</label>
                                <input id="firma" name="firma" type="file" class="form-control" >
                                @if (pathinfo($documento->firma, PATHINFO_EXTENSION) == 'pdf')
                                    <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma)}}" style="width: 60%; height: 60px;"></iframe>
                                    <p class="text-center ">
                                        <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver archivo</a>
                                    </p>
                                @else
                                    <p class="text-center mt-2">
                                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                        <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver Imagen</a>
                                    </p>
                                @endif
                            </div>
                    @endforeach

                    @if($tiene_documentos)
                        <!-- Si el usuario tiene documentos, no mostramos el formulario -->
                    @else
                        <!-- Si el usuario no tiene documentos, mostramos el formulario -->
                        <div class="col-6 form-group p-3 mt-2">
                            <label for="ine">INE </label>
                            <input id="ine" name="ine" type="file" class="form-control" >
                        </div>

                        <div class="col-6 form-group p-3 mt-2">
                            <label for="foto_tam_titulo">CURP</label>
                            <input id="curp" name="curp" type="file" class="form-control" >
                        </div>

                        <div class="col-6 form-group p-3 mt-2">
                            <label for="foto_tam_titulo">Foto tamaño titulo</label>
                            <input id="foto_tam_titulo" name="foto_tam_titulo" type="file" class="form-control" >
                        </div>

                        <div class="col-6 form-group p-3 mt-2">
                            <label for="foto_tam_infantil">Foto tamaño Infantil</label>
                            <input id="foto_tam_infantil" name="foto_tam_infantil" type="file" class="form-control" >
                        </div>

                        <div class="col-6 form-group p-3 mt-2">
                            <label for="carta_compromiso">Carta Compromiso</label>
                            <input id="carta_compromiso" name="carta_compromiso" type="file" class="form-control" >
                        </div>

                        <div class="col-6 form-group p-3 mt-2">
                            <label for="firma">Firma</label>
                            <input id="firma" name="firma" type="file" class="form-control" >
                        </div>
                    @endif

                    <div class="col-12">
                        <button type="submit" class="btn_save_profile d-inline-block" >
                            Guardar
                        </button>
                    </div>

                </div>

            </form>
        </div>

        <div class="tab-pane fade" id="nav-register" role="tabpanel" aria-labelledby="nav-register-tab" tabindex="0" style="min-height: auto!important;">
            @php
                $tiene_documentos_estandar = false;
            @endphp
            <div clasS="row">
                @foreach($documentos_estandares as $documento)
                        @php
                            $tiene_documentos = true;
                        @endphp
                        <div class="col-6">
                            @if (pathinfo($documento->documento, PATHINFO_EXTENSION) == 'pdf')
                                <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->documento)}}" style="width: 60%; height: 60px;"></iframe>
                                <p class="text-center ">
                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->documento) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver archivo</a>
                                </p>
                            @else
                                <p class="text-center mt-2">
                                    <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->documento) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                    <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->documento) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver Imagen</a>
                                </p>
                            @endif
                        </div>
                @endforeach
            </div>

            <div clasS="row">

                @if($tiene_documentos)
                    <!-- Si el usuario tiene documentos, no mostramos el formulario -->
                    @else
                    <div class="col-12">
                        <p class="text-center">No se han subido archivos aún.</p>
                    </div>
                @endif

                <div class="col-12">
                    <div class="d-flex justify-content-center">

                        <form method="POST" action="{{ route('documentos.store_cliente', $cliente->id) }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input class="form-control" type="file" name="archivos[]" multiple>
                            <button class="btn_save_profile d-inline-block mt-3" style="margin-left:8rem;" type="submit">Subir archivos</button>
                        </form>

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
