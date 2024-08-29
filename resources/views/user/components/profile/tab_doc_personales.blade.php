<form id="formDocumentos" method="POST" enctype="multipart/form-data">

    @csrf
    <input type="hidden" name="_method" value="PATCH">
    @php
        $tiene_documentos = count($documentos) > 0;
    @endphp
    <div class="modal-body row">
        @if($tiene_documentos)

            @foreach($documentos as $documento)
                    <div class="col-6 form-group mb-5">
                        <label for="ine">INE Frente y Atras</label>

                        @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                            <input id="ine" name="ine" type="file" class="form-control ine_input" >
                        @endif
                        @if ($documento->ine == NULL)
                            <img id="blah" src="{{asset('cursos/no-image.jpg') }}" alt="Imagen" style="width: 60px; height: auto"/>
                        @else

                        <div id="contenedor_ine">
                            @if (pathinfo($documento->ine, PATHINFO_EXTENSION) == 'pdf')
                                <p class="text-center ">
                                    <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine)}}" style="width: 60%; height: auto"></iframe>
                                </p>
                                        <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                @elseif (pathinfo($documento->ine, PATHINFO_EXTENSION) == 'doc')
                                <p class="text-center ">
                                    <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto"/>
                                </p>
                                        <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                @elseif (pathinfo($documento->ine, PATHINFO_EXTENSION) == 'docx')
                                <p class="text-center ">
                                    <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto"/>
                                </p>
                                        <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                @else
                                    <p class="text-center mt-2">
                                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine) }}" alt="Imagen" style="width: 60px;height: auto;"/><br>
                                    </p>
                                    <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                @endif

                                @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                                    <button type="button" class="btn btn-danger btn-sm " onclick="eliminarDocumento('{{ route('eliminar.documentoper', ['id' => $documento->id, 'tipo' => 'ine']) }}')">Eliminar</button>
                                @endif
                        </div>

                        @endif

                        <div id="resultado_ine"></div>

                    </div>

                    <div class="col-6 form-group mb-5">
                        <label for="curp">CURP</label>
                        @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                            <input id="curp" name="curp" type="file" class="form-control curp_input" >
                        @endif

                            @if ($documento->curp == NULL)
                                <img id="blah" src="{{asset('cursos/no-image.jpg') }}" alt="Imagen" style="width: 60px; height: auto;"/>
                            @else
                        <div id="contenedor_curp">

                            @if (pathinfo($documento->curp, PATHINFO_EXTENSION) == 'pdf')
                            <p class="text-center ">
                                <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp)}}" style="width: 60%; height: auto;"></iframe>
                            </p>
                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                            @elseif (pathinfo($documento->curp, PATHINFO_EXTENSION) == 'doc')
                            <p class="text-center ">
                                <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto;"/>
                            </p>
                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                            @elseif (pathinfo($documento->curp, PATHINFO_EXTENSION) == 'docx')
                            <p class="text-center ">
                                <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto;"/>
                            </p>
                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                            @else
                                <p class="text-center mt-2">
                                    <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" alt="Imagen" style="width: 60px;height: auto;"/><br>
                                </p>
                                    <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                            @endif
                            @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                                <button type="button" class="btn btn-danger btn-sm mt-2" onclick="eliminarDocumento('{{ route('eliminar.documentoper', ['id' => $documento->id, 'tipo' => 'curp']) }}')">Eliminar</button>
                            @endif
                        </div>
                        @endif

                        <div id="resultado_curp"></div>

                    </div>

                    @foreach ($usuario_compro as $video)
                        @if ($video->Cursos->sep == '1')
                            <div class="col-6 form-group mb-5">
                                <label for="estudios">Último grado de estudio (oficial)</label>
                                @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                                    <input id="estudios" name="estudios" type="file" class="form-control estudios_input" >
                                @endif

                                @if ($documento->estudios == NULL)
                                    <img id="blah" src="{{asset('cursos/no-image.jpg') }}" alt="Imagen" style="width: 60px; height: auto;"/>
                                @else
                                <div id="contenedor_estudios">

                                    @if (pathinfo($documento->estudios, PATHINFO_EXTENSION) == 'pdf')
                                    <p class="text-center ">
                                        <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->estudios)}}" style="width: 60%; height: auto;"></iframe>
                                    </p>
                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->estudios) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                    @elseif (pathinfo($documento->estudios, PATHINFO_EXTENSION) == 'doc')
                                    <p class="text-center ">
                                        <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto;"/>
                                    </p>
                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->estudios) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                    @elseif (pathinfo($documento->estudios, PATHINFO_EXTENSION) == 'docx')
                                    <p class="text-center ">
                                        <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto;"/>
                                    </p>
                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->estudios) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                    @else
                                        <p class="text-center mt-2">
                                            <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->estudios) }}" alt="Imagen" style="width: 60px;height: auto;"/><br>
                                        </p>
                                            <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->estudios) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                    @endif
                                    @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                                        <button type="button" class="btn btn-danger btn-sm mt-2" onclick="eliminarDocumento('{{ route('eliminar.documentoper', ['id' => $documento->id, 'tipo' => 'estudios']) }}')">Eliminar</button>
                                    @endif
                                </div>
                                @endif

                                <div id="resultado_estudios"></div>

                            </div>

                            <div class="col-6 form-group mb-5">
                                <label for="domicilio">Comprobante de domicilio</label>
                                @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                                    <input id="domicilio" name="domicilio" type="file" class="form-control domicilio_input" >
                                @endif
                                @if ($documento->domicilio == NULL)
                                    <img id="blah" src="{{asset('cursos/no-image.jpg') }}" alt="Imagen" style="width: 60px; height: auto;"/>
                                @else

                                <div id="contenedor_domicilio">

                                    @if (pathinfo($documento->domicilio, PATHINFO_EXTENSION) == 'pdf')
                                    <p class="text-center ">
                                        <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->domicilio)}}" style="width: 60%; height: auto;"></iframe>
                                    </p>
                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->domicilio) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                    @elseif (pathinfo($documento->domicilio, PATHINFO_EXTENSION) == 'doc')
                                    <p class="text-center ">
                                        <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto;"/>
                                    </p>
                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->domicilio) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                    @elseif (pathinfo($documento->domicilio, PATHINFO_EXTENSION) == 'docx')
                                    <p class="text-center ">
                                        <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto;"/>
                                    </p>
                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->domicilio) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                    @else
                                        <p class="text-center mt-2">
                                            <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->domicilio) }}" alt="Imagen" style="width: 60px;height: auto;"/><br>
                                        </p>
                                            <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->domicilio) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                    @endif
                                    @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                                        <button type="button" class="btn btn-danger btn-sm mt-2" onclick="eliminarDocumento('{{ route('eliminar.documentoper', ['id' => $documento->id, 'tipo' => 'domicilio']) }}')">Eliminar</button>
                                    @endif
                                </div>

                                @endif
                                <div id="resultado_domicilio"></div>

                            </div>

                            @break
                        @endif
                    @endforeach

                    @foreach ($usuario_compro as $video)
                        @if ($video->Cursos->imnas == '1')
                            <div class="col-6 form-group mb-5">
                                <label for="foto_infantil_blanco">Foto Infantil Blanco y negro</label>
                                @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                                    <input id="foto_infantil_blanco" name="foto_infantil_blanco" type="file" class="form-control infantil_blanco_input" >
                                @endif
                                @if ($documento->foto_infantil_blanco == NULL)
                                    <img id="blah" src="{{asset('cursos/no-image.jpg') }}" alt="Imagen" style="width: 60px; height: auto;"/>
                                @else

                                <div id="contenedor_foto_infantil_blanco">

                                    @if (pathinfo($documento->foto_infantil_blanco, PATHINFO_EXTENSION) == 'pdf')
                                    <p class="text-center ">
                                        <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_infantil_blanco)}}" style="width: 60%; height: auto;"></iframe>
                                    </p>
                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_infantil_blanco) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                    @elseif (pathinfo($documento->foto_infantil_blanco, PATHINFO_EXTENSION) == 'doc')
                                    <p class="text-center ">
                                        <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto;"/>
                                    </p>
                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_infantil_blanco) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                    @elseif (pathinfo($documento->foto_infantil_blanco, PATHINFO_EXTENSION) == 'docx')
                                    <p class="text-center ">
                                        <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto;"/>
                                    </p>
                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_infantil_blanco) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                    @else
                                        <p class="text-center mt-2">
                                            <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_infantil_blanco) }}" alt="Imagen" style="width: 60px;height: auto;"/><br>
                                        </p>
                                            <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_infantil_blanco) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                    @endif
                                </div>
                                @endif
                                <div id="resultado_foto_infantil_blanco"></div>

                            </div>
                            @break
                        @endif
                    @endforeach

                    <div class="col-6 form-group mb-5">
                        <label for="foto_tam_infantil">Foto Infantil a colors</label>
                        @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                            <input id="foto_tam_infantil" name="foto_tam_infantil" type="file" class="form-control foto_tam_infantil_input" >
                        @endif
                        @if ($documento->foto_tam_infantil == NULL)
                            <img id="blah" src="{{asset('cursos/no-image.jpg') }}" alt="Imagen" style="width: 60px; height: auto;"/>
                        @else

                        <div id="contenedor_foto_tam_infantil">
                            @if (pathinfo($documento->foto_tam_infantil, PATHINFO_EXTENSION) == 'pdf')
                            <p class="text-center ">
                                <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil)}}" style="width: 60%; height: auto;"></iframe>
                            </p>
                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                            @elseif (pathinfo($documento->foto_tam_infantil, PATHINFO_EXTENSION) == 'doc')
                            <p class="text-center ">
                                <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto;"/>
                            </p>
                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                            @elseif (pathinfo($documento->foto_tam_infantil, PATHINFO_EXTENSION) == 'docx')
                            <p class="text-center ">
                                <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto;"/>
                            </p>
                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                            @else
                                <p class="text-center mt-2">
                                    <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" alt="Imagen" style="width: 60px;height: auto;"/><br>
                                </p>
                                    <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                            @endif
                            @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                                <button type="button" class="btn btn-danger btn-sm mt-2" onclick="eliminarDocumento('{{ route('eliminar.documentoper', ['id' => $documento->id, 'tipo' => 'foto_tam_infantil']) }}')">Eliminar</button>
                            @endif
                        </div>
                        @endif

                        <div id="resultado_foto_tam_infantil"></div>

                    </div>

                    <div class="col-6 form-group mb-5">
                        <label for="firma">Firma</label>

                        @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                            <input id="firma" name="firma" type="file" class="form-control firma_input" >
                        @endif
                        @if ($documento->firma == NULL)
                            <img id="blah" src="{{asset('cursos/no-image.jpg') }}" alt="Imagen" style="width: 60px; height: auto"/>
                        @else

                        <div id="contenedor_firma">

                            @if (pathinfo($documento->firma, PATHINFO_EXTENSION) == 'pdf')
                                <p class="text-center ">
                                    <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma)}}" style="width: 60%; height: auto"></iframe>
                                </p>
                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                            @elseif (pathinfo($documento->firma, PATHINFO_EXTENSION) == 'doc')
                                <p class="text-center ">
                                    <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto"/>
                                </p>
                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                            @elseif (pathinfo($documento->firma, PATHINFO_EXTENSION) == 'docx')
                                <p class="text-center ">
                                    <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto"/>
                                </p>
                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                            @else
                                <p class="text-center ">
                                    <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma) }}" alt="Imagen" style="width: 60px;height: auto;"/><br>
                                </p>
                                    <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                            @endif
                            @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                                <button type="button" class="btn btn-danger btn-sm mt-2" onclick="eliminarDocumento('{{ route('eliminar.documentoper', ['id' => $documento->id, 'tipo' => 'firma']) }}')">Eliminar</button>
                            @endif
                        </div>
                        @endif
                        <div id="resultado_firma"></div>

                    </div>

                    @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                        <div class="col-6 form-group mb-5">
                            <label for="firma">Foto <b>Blanco y negro</b></label>
                            <input id="foto_infantil_blanco" name="foto_infantil_blanco" type="file" class="form-control infantil_blanco_input" >
                            @if ($documento->foto_tam_titulo == NULL)
                                <img id="blah" src="{{asset('cursos/no-image.jpg') }}" alt="Imagen" style="width: 60px; height: auto;"/>
                            @else

                            <div id="contenedor_foto_tam_titulo">

                                @if (pathinfo($documento->foto_tam_titulo, PATHINFO_EXTENSION) == 'pdf')
                                    <p class="text-center ">
                                        <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo)}}" style="width: 60%; height: auto;"></iframe>
                                    </p>
                                        <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                @elseif (pathinfo($documento->foto_tam_titulo, PATHINFO_EXTENSION) == 'doc')
                                    <p class="text-center ">
                                        <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto;"/>
                                    </p>
                                        <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                @elseif (pathinfo($documento->foto_tam_titulo, PATHINFO_EXTENSION) == 'docx')
                                    <p class="text-center ">
                                        <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto;"/>
                                    </p>
                                        <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                @else
                                    <p class="text-center ">
                                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo) }}" alt="Imagen" style="width: 60px;height: auto;"/><br>
                                    </p>
                                        <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                @endif
                                <button type="button" class="btn btn-danger btn-sm mt-2" onclick="eliminarDocumento('{{ route('eliminar.documentoper', ['id' => $documento->id, 'tipo' => 'foto_tam_titulo']) }}')">Eliminar</button>
                            </div>
                            @endif

                            <div id="resultado_foto_tam_titulo"></div>
                        </div>
                    @endif
            @endforeach

        @else
            <div class="col-6 form-group mb-5">
                <label for="ine">INE Frente y Atras</label>
                <input id="ine" name="ine" type="file" class="form-control ine_input">
                <div id="resultado_ine"></div>
            </div>

            <div class="col-6 form-group mb-5">
                <label for="curp">CURPs</label>
                <input id="curp" name="curp" type="file" class="form-control curp_input" >
                <div id="resultado_curp"></div>
            </div>

            @foreach ($usuario_compro as $video)
                @if ($video->Cursos->sep == '1')
                    <div class="col-6 form-group mb-5">
                        <label for="estudios">Último grado de estudio (oficial)</label>
                        <input id="estudios" name="estudios" type="file" class="form-control estudios_input" >
                        <div id="resultado_estudios"></div>
                    </div>

                    <div class="col-6 form-group mb-5">
                        <label for="domicilio">Comprobante de domicilio</label>
                        <input id="domicilio" name="domicilio" type="file" class="form-control domicilio_input" >
                        <div id="resultado_domicilio"></div>
                    </div>
                    @break
                @endif
            @endforeach

            <div class="col-6 form-group mb-5">
                <label for="foto_tam_infantil">Foto Infantil color</label>
                <input id="foto_tam_infantil" name="foto_tam_infantil" type="file" class="form-control foto_tam_infantil_input" >
                <div id="resultado_foto_tam_infantil"></div>
            </div>

            <div class="col-6 form-group mb-5">
                <label for="foto_infantil_blanco">Foto Infantil Blanco y negro</label>
                <input id="foto_infantil_blanco" name="foto_infantil_blanco" type="file" class="form-control infantil_blanco_input" >
                <div id="resultado_foto_tam_titulo"></div>
            </div>

            <div class="col-6 form-group mb-5">
                <label for="firma">Firma</label>
                <input id="firma" name="firma" type="file" class="form-control firma_input" >
                <div id="resultado_firma"></div>
            </div>
        @endif
    </div>

    @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
        <div class="modal-footer">
            <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff;display: none;" id="btnSubmit"></button>
        </div>
    @endif

    <div class="row">
        <div class="col-6">
            @foreach ($usuario_compro as $video)
                @if ($video->Cursos->imnas == '1')
                <p><b>Registro IMNAS</b></p>
                <a class="example-image-link" href="{{asset('documentos/imnas1.jpg') }}" data-lightbox="example-2" data-title="imnas" target="_blank">
                        <img id="img_material_clase example-image" src="{{asset('documentos/imnas1.jpg') }}" alt="material de clase" style="width: 90%;border-radius: 19px;box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);"/>
                    </a>
                    @break
                @endif
            @endforeach
        </div>
        <div class="col-6">
            @foreach ($usuario_compro as $video)
                @if ($video->Cursos->sep == '1')
                    <p><b>Requisitos RVOE</b></p>
                    <a class="example-image-link" href="{{asset('documentos/rvoe.jpg') }}" data-lightbox="example-2" data-title="imnas" target="_blank">
                        <img id="img_material_clase example-image" src="{{asset('documentos/rvoe.jpg') }}" alt="material de clase" style="width: 90%;border-radius: 19px;box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);"/>
                    </a>
                    @break
                @endif
            @endforeach
        </div>
        <div class="col-6">
            @if (isset($estandar_user))
                <p><b>Requisitos CONOCER</b></p>
                <a class="example-image-link" href="{{asset('documentos/conocer.jpg') }}" data-lightbox="example-2" data-title="conocer" target="_blank">
                    <img id="img_material_clase example-image" src="{{asset('documentos/conocer.jpg') }}" alt="material de clase" style="width: 90%;border-radius: 19px;box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);"/>
                </a>
            @endif
        </div>
    </div>
</form>
<script>
    function eliminarDocumento(url) {
        if (confirm('¿Estás seguro de que deseas eliminar este documento?')) {
            // Realiza la solicitud al servidor para eliminar el documento
            window.location.href = url;
        }
    }
</script>
