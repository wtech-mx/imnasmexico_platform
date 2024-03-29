<nav>
    <div class="d-flex justify-content-center">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-doc-perso-tab" data-bs-toggle="tab" data-bs-target="#nav-doc-perso" type="button" role="tab" aria-controls="nav-doc-perso" aria-selected="true">
                Doc. Personal
            </button>

            <button class="nav-link" id="nav-des-sub-doc-tab" data-bs-toggle="tab" data-bs-target="#nav-des-sub-doc" type="button" role="tab" aria-controls="nav-des-sub-doc" aria-selected="false">
                Descargas/Subir Documentos
            </button>

            @foreach ($estandaresComprados as $estandar)
                @if ($estandar->nombre == 'EC0010 - Prestación de Servicios Estéticos Corporales SEP CONOCER')
                    <button class="nav-link" id="nav-des-ejemplo-tab" data-bs-toggle="tab" data-bs-target="#nav-des-ejemplo" type="button" role="tab" aria-controls="nav-des-ejemplo" aria-selected="false">
                        Ejemplos de llenado
                    </button>
                @endif
            @endforeach

            <button class="nav-link" id="nav-estan-doc-tab" data-bs-toggle="tab" data-bs-target="#nav-estan-doc" type="button" role="tab" aria-controls="nav-estan-doc" aria-selected="false">
                Guia Estandar
            </button>
        </div>
    </div>
</nav>

<div class="tab-content" id="nav-tabContent" style="">

    <div class="tab-pane fade show active" id="nav-doc-perso" role="tabpanel" aria-labelledby="nav-doc-perso-tab" tabindex="0" style="min-height: auto!important;">
        <form method="POST" action="{{ route('clientes.update_documentos_cliente', $cliente->id) }}" enctype="multipart/form-data" role="form">
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
                                    <input id="ine" name="ine" type="file" class="form-control" >
                                @endif
                                @if ($documento->ine == NULL)
                                    <img id="blah" src="{{asset('cursos/no-image.jpg') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                @else
                                    @if (pathinfo($documento->ine, PATHINFO_EXTENSION) == 'pdf')
                                    <p class="text-center ">
                                        <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine)}}" style="width: 60%; height: 60px;"></iframe>
                                    </p>
                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                    @elseif (pathinfo($documento->ine, PATHINFO_EXTENSION) == 'doc')
                                    <p class="text-center ">
                                        <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                    </p>
                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                    @elseif (pathinfo($documento->ine, PATHINFO_EXTENSION) == 'docx')
                                    <p class="text-center ">
                                        <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                    </p>
                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                    @else
                                        <p class="text-center mt-2">
                                            <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                        </p>
                                            <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->ine) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>

                                    @endif
                                    @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                                        <button type="button" class="btn btn-danger btn-sm " onclick="eliminarDocumento('{{ route('eliminar.documentoper', ['id' => $documento->id, 'tipo' => 'ine']) }}')">Eliminar</button>
                                    @endif
                                @endif
                            </div>

                            <div class="col-6 form-group mb-5">
                                <label for="curp">CURP</label>
                                @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                                    <input id="curp" name="curp" type="file" class="form-control" >
                                @endif
                                @if ($documento->curp == NULL)
                                    <img id="blah" src="{{asset('cursos/no-image.jpg') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                @else
                                    @if (pathinfo($documento->curp, PATHINFO_EXTENSION) == 'pdf')
                                    <p class="text-center ">
                                        <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp)}}" style="width: 60%; height: 60px;"></iframe>
                                    </p>
                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                    @elseif (pathinfo($documento->curp, PATHINFO_EXTENSION) == 'doc')
                                    <p class="text-center ">
                                        <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                    </p>
                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                    @elseif (pathinfo($documento->curp, PATHINFO_EXTENSION) == 'docx')
                                    <p class="text-center ">
                                        <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                    </p>
                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                    @else
                                        <p class="text-center mt-2">
                                            <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                        </p>
                                            <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->curp) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                    @endif
                                    @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                                        <button type="button" class="btn btn-danger btn-sm mt-2" onclick="eliminarDocumento('{{ route('eliminar.documentoper', ['id' => $documento->id, 'tipo' => 'curp']) }}')">Eliminar</button>
                                    @endif
                                @endif
                            </div>

                            @foreach ($usuario_compro as $video)
                                @if ($video->Cursos->sep == '1')
                                    <div class="col-6 form-group mb-5">
                                        <label for="estudios">Último grado de estudio (oficial)</label>
                                        @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                                            <input id="estudios" name="estudios" type="file" class="form-control" >
                                        @endif
                                        @if ($documento->estudios == NULL)
                                            <img id="blah" src="{{asset('cursos/no-image.jpg') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                        @else
                                            @if (pathinfo($documento->estudios, PATHINFO_EXTENSION) == 'pdf')
                                            <p class="text-center ">
                                                <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->estudios)}}" style="width: 60%; height: 60px;"></iframe>
                                            </p>
                                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->estudios) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                            @elseif (pathinfo($documento->estudios, PATHINFO_EXTENSION) == 'doc')
                                            <p class="text-center ">
                                                <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                            </p>
                                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->estudios) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                            @elseif (pathinfo($documento->estudios, PATHINFO_EXTENSION) == 'docx')
                                            <p class="text-center ">
                                                <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                            </p>
                                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->estudios) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                            @else
                                                <p class="text-center mt-2">
                                                    <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->estudios) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                </p>
                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->estudios) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                            @endif
                                            @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                                                <button type="button" class="btn btn-danger btn-sm mt-2" onclick="eliminarDocumento('{{ route('eliminar.documentoper', ['id' => $documento->id, 'tipo' => 'estudios']) }}')">Eliminar</button>
                                            @endif
                                        @endif
                                    </div>

                                    <div class="col-6 form-group mb-5">
                                        <label for="domicilio">Comprobante de domicilio</label>
                                        @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                                            <input id="domicilio" name="domicilio" type="file" class="form-control" >
                                        @endif
                                        @if ($documento->domicilio == NULL)
                                            <img id="blah" src="{{asset('cursos/no-image.jpg') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                        @else
                                            @if (pathinfo($documento->domicilio, PATHINFO_EXTENSION) == 'pdf')
                                            <p class="text-center ">
                                                <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->domicilio)}}" style="width: 60%; height: 60px;"></iframe>
                                            </p>
                                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->domicilio) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                            @elseif (pathinfo($documento->domicilio, PATHINFO_EXTENSION) == 'doc')
                                            <p class="text-center ">
                                                <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                            </p>
                                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->domicilio) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                            @elseif (pathinfo($documento->domicilio, PATHINFO_EXTENSION) == 'docx')
                                            <p class="text-center ">
                                                <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                            </p>
                                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->domicilio) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                            @else
                                                <p class="text-center mt-2">
                                                    <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->domicilio) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                </p>
                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->domicilio) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                            @endif
                                            @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                                                <button type="button" class="btn btn-danger btn-sm mt-2" onclick="eliminarDocumento('{{ route('eliminar.documentoper', ['id' => $documento->id, 'tipo' => 'domicilio']) }}')">Eliminar</button>
                                            @endif
                                        @endif
                                    </div>

                                    @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                                        <div class="col-6 form-group mb-5">
                                            <label for="firma">Foto Óvalo</label>
                                            <input id="foto_tam_titulo" name="foto_tam_titulo" type="file" class="form-control" >
                                            @if ($documento->foto_tam_titulo == NULL)
                                                <img id="blah" src="{{asset('cursos/no-image.jpg') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                            @else
                                                @if (pathinfo($documento->foto_tam_titulo, PATHINFO_EXTENSION) == 'pdf')
                                                    <p class="text-center ">
                                                        <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo)}}" style="width: 60%; height: 60px;"></iframe>
                                                    </p>
                                                        <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                                @elseif (pathinfo($documento->foto_tam_titulo, PATHINFO_EXTENSION) == 'doc')
                                                    <p class="text-center ">
                                                        <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                                    </p>
                                                        <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                                @elseif (pathinfo($documento->foto_tam_titulo, PATHINFO_EXTENSION) == 'docx')
                                                    <p class="text-center ">
                                                        <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                                    </p>
                                                        <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                                @else
                                                    <p class="text-center ">
                                                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                    </p>
                                                        <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_titulo) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                                @endif
                                                    <button type="button" class="btn btn-danger btn-sm mt-2" onclick="eliminarDocumento('{{ route('eliminar.documentoper', ['id' => $documento->id, 'tipo' => 'foto_tam_titulo']) }}')">Eliminar</button>
                                            @endif
                                        </div>
                                    @endif
                                    @break
                                @endif
                            @endforeach

                            @foreach ($usuario_compro as $video)
                                @if ($video->Cursos->imnas == '1')
                                    <div class="col-6 form-group mb-5">
                                        <label for="foto_infantil_blanco">Foto Infantil Blanco y negro</label>
                                        @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                                            <input id="foto_infantil_blanco" name="foto_infantil_blanco" type="file" class="form-control" >
                                        @endif
                                        @if ($documento->foto_infantil_blanco == NULL)
                                            <img id="blah" src="{{asset('cursos/no-image.jpg') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                        @else
                                            @if (pathinfo($documento->foto_infantil_blanco, PATHINFO_EXTENSION) == 'pdf')
                                            <p class="text-center ">
                                                <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_infantil_blanco)}}" style="width: 60%; height: 60px;"></iframe>
                                            </p>
                                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_infantil_blanco) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                            @elseif (pathinfo($documento->foto_infantil_blanco, PATHINFO_EXTENSION) == 'doc')
                                            <p class="text-center ">
                                                <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                            </p>
                                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_infantil_blanco) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                            @elseif (pathinfo($documento->foto_infantil_blanco, PATHINFO_EXTENSION) == 'docx')
                                            <p class="text-center ">
                                                <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                            </p>
                                                    <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_infantil_blanco) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                            @else
                                                <p class="text-center mt-2">
                                                    <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_infantil_blanco) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                </p>
                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_infantil_blanco) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                            @endif
                                        @endif
                                    </div>
                                    @break
                                @endif
                            @endforeach

                            <div class="col-6 form-group mb-5">
                                <label for="foto_tam_infantil">Foto Infantil a color</label>
                                @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                                    <input id="foto_tam_infantil" name="foto_tam_infantil" type="file" class="form-control" >
                                @endif
                                @if ($documento->foto_tam_infantil == NULL)
                                    <img id="blah" src="{{asset('cursos/no-image.jpg') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                @else
                                    @if (pathinfo($documento->foto_tam_infantil, PATHINFO_EXTENSION) == 'pdf')
                                    <p class="text-center ">
                                        <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil)}}" style="width: 60%; height: 60px;"></iframe>
                                    </p>
                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                    @elseif (pathinfo($documento->foto_tam_infantil, PATHINFO_EXTENSION) == 'doc')
                                    <p class="text-center ">
                                        <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                    </p>
                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                    @elseif (pathinfo($documento->foto_tam_infantil, PATHINFO_EXTENSION) == 'docx')
                                    <p class="text-center ">
                                        <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                    </p>
                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                    @else
                                        <p class="text-center mt-2">
                                            <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                        </p>
                                            <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->foto_tam_infantil) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                    @endif
                                    @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                                        <button type="button" class="btn btn-danger btn-sm mt-2" onclick="eliminarDocumento('{{ route('eliminar.documentoper', ['id' => $documento->id, 'tipo' => 'foto_tam_infantil']) }}')">Eliminar</button>
                                    @endif
                                @endif
                            </div>

                            <div class="col-6 form-group mb-5">
                                <label for="firma">Firma</label>
                                @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                                    <input id="firma" name="firma" type="file" class="form-control" >
                                @endif
                                @if ($documento->firma == NULL)
                                    <img id="blah" src="{{asset('cursos/no-image.jpg') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                @else
                                    @if (pathinfo($documento->firma, PATHINFO_EXTENSION) == 'pdf')
                                        <p class="text-center ">
                                            <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma)}}" style="width: 60%; height: 60px;"></iframe>
                                        </p>
                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                    @elseif (pathinfo($documento->firma, PATHINFO_EXTENSION) == 'doc')
                                        <p class="text-center ">
                                            <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                        </p>
                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                    @elseif (pathinfo($documento->firma, PATHINFO_EXTENSION) == 'docx')
                                        <p class="text-center ">
                                            <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                        </p>
                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                    @else
                                        <p class="text-center ">
                                            <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                        </p>
                                            <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->firma) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                    @endif
                                    @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                                        <button type="button" class="btn btn-danger btn-sm mt-2" onclick="eliminarDocumento('{{ route('eliminar.documentoper', ['id' => $documento->id, 'tipo' => 'firma']) }}')">Eliminar</button>
                                    @endif
                                @endif
                            </div>
                    @endforeach

                @else
                    <div class="col-6 form-group mb-5">
                        <label for="ine">INE Frente y Atras</label>
                        <input id="ine" name="ine" type="file" class="form-control" >
                    </div>

                    <div class="col-6 form-group mb-5">
                        <label for="curp">CURP</label>
                        <input id="curp" name="curp" type="file" class="form-control" >
                    </div>

                    @foreach ($usuario_compro as $video)
                        @if ($video->Cursos->sep == '1')
                            <div class="col-6 form-group mb-5">
                                <label for="estudios">Último grado de estudio (oficial)</label>
                                <input id="estudios" name="estudios" type="file" class="form-control" >
                            </div>

                            <div class="col-6 form-group mb-5">
                                <label for="domicilio">Comprobante de domicilio</label>
                                <input id="domicilio" name="domicilio" type="file" class="form-control" >
                            </div>

                            <div class="col-6 form-group mb-5">
                                <label for="foto_tam_infantil">Foto Óvalo</label>
                                <input id="foto_tam_titulo" name="foto_tam_titulo" type="file" class="form-control" >
                            </div>
                            @break
                        @endif
                    @endforeach

                    @foreach ($usuario_compro as $video)
                        @if ($video->Cursos->imnas == '1')
                            <div class="col-6 form-group mb-5">
                                <label for="foto_infantil_blanco">Foto Infantil Blanco y negro</label>
                                <input id="foto_infantil_blanco" name="foto_infantil_blanco" type="file" class="form-control" >
                            </div>
                            @break
                        @endif
                    @endforeach

                    <div class="col-6 form-group mb-5">
                        <label for="foto_tam_infantil">Foto Infantil color</label>
                        <input id="foto_tam_infantil" name="foto_tam_infantil" type="file" class="form-control" >
                    </div>

                    <div class="col-6 form-group mb-5">
                        <label for="firma">Firma</label>
                        <input id="firma" name="firma" type="file" class="form-control" >
                    </div>
                @endif
            </div>
            @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
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
                    @foreach ($usuario_compro as $video)
                        @if ($video->Cursos->redconocer == '1')
                            <p><b>Requisitos CONOCER</b></p>
                            <a class="example-image-link" href="{{asset('documentos/conocer.jpg') }}" data-lightbox="example-2" data-title="conocer" target="_blank">
                                <img id="img_material_clase example-image" src="{{asset('documentos/conocer.jpg') }}" alt="material de clase" style="width: 90%;border-radius: 19px;box-shadow: 6px 6px 15px -10px rgb(0 0 0 / 50%);"/>
                            </a>
                            @break
                        @endif
                    @endforeach
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
    </div>

    <div class="tab-pane fade" id="nav-des-sub-doc" role="tabpanel" aria-labelledby="nav-des-sub-doc-tab" tabindex="0" style="min-height: auto!important;">
        <div class="modal-body row">
            <div class="accordion" id="acordcion_mb_clases">
                @php
                    $displayedFolders = []; // Keep track of displayed folders
                @endphp
                @foreach ($usuario_compro as $video)
                    @if ($video->Cursos->CursosEstandares->count() > 0)
                        @foreach ($estandaresComprados as $estandar)
                        @php
                                            // Check if the folder has been displayed already
                                            if (!in_array($estandar->nombre, $displayedFolders)) {
                                                $displayedFolders[] = $estandar->nombre; // Mark the folder as displayed
                                            } else {
                                                continue; // Skip displaying the folder if it has been displayed already
                                            }
                        @endphp
                            <div class="col-12">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$estandar->id}}" aria-expanded="true" aria-controls="collapseOne{{$estandar->id}}" style="background-color: #836262;">
                                                <img class="icon_nav_course" src="{{asset('assets/user/icons/folder.png')}}" alt="">
                                                {{$estandar->nombre}}
                                                <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                                            </button>
                                        </h2>

                                        <div id="collapseOne{{$estandar->id}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#acordcion_mb_clases">
                                            <div class="accordion-body">
                                                <div class="row">
                                                    @php
                                                        $documentos_estandar = App\Models\CarpetaDocumentosEstandares::where('id_carpeta', $estandar->id)->where('guia', '=', NULL)->get();
                                                    @endphp
                                                    <form action="{{ route('documentos.store_cliente', $cliente->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <h4>Por favor, carga tus documentos y luego haz clic en <b>'Guardar'</b>.</h4>
                                                            </div>
                                                            <div class="col-12">
                                                                <button class="btn_save_profile d-inline-block mt-3 mb-3 blinking" style="background: {{$configuracion->color_boton_save}}; color: #ffff" type="submit">Guardar</button>
                                                            </div>
                                                        </div>
                                                        @foreach ($documentos_estandar as $documento)
                                                            @php
                                                                $documentoDescargado = DB::table('documentos_estandares')->where('id_usuario', $cliente->id)->where('id_documento', $documento->id)->exists();
                                                                $documentoSubido = DB::table('documentos_estandares')->where('id_usuario', $cliente->id)->where('id_documento', $documento->id)->orderBy('created_at', 'desc')->first();
                                                            @endphp
                                                            <div class="row">

                                                                <div class="col-6  mb-2">
                                                                        <a href="{{asset('carpetasestandares/'.$estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="text-decoration: none; color: #000">
                                                                            <img src="{{asset('assets/user/icons/pdf.png') }}" style="width: 45px; height: 45px;"/>
                                                                            {{ substr($documento->nombre, 13) }}
                                                                        </a>
                                                                        <a class="text-center text-white btn btn-sm ml-2" href="{{asset('carpetasestandares/'.$estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="background: #836262; border-radius: 19px;">
                                                                            Descargar
                                                                        </a>
                                                                </div>

                                                                <div class="col-3 form-group p-3 mt-2">

                                                                    @if ($documentoDescargado)

                                                                        @if (pathinfo($documentoSubido->documento, PATHINFO_EXTENSION) == 'pdf')
                                                                            <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$documentoSubido->documento)}}" style="width: 60%; height: 60px;"></iframe>
                                                                            <p class="text-center ">
                                                                                <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documentoSubido->documento) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                                                            </p>
                                                                        @elseif (pathinfo($documento->documento, PATHINFO_EXTENSION) == 'doc')
                                                                            <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                                                            <p class="text-center ">
                                                                                <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->documento) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                                                            </p>
                                                                        @elseif (pathinfo($documento->documento, PATHINFO_EXTENSION) == 'docx')
                                                                            <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: 60px;"/>
                                                                            <p class="text-center ">
                                                                                <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$documento->documento) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                                                            </p>
                                                                        @else
                                                                            <p class="text-center mt-2">
                                                                                <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documentoSubido->documento) }}" alt="Imagen" style="width: 120px;height: 80%;"/><br>
                                                                                <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documentoSubido->documento) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                                                            </p>
                                                                        @endif

                                                                </div>

                                                                <div class="col-3 form-group p-3 mt-2">

                                                                        <p class="text-center">
                                                                            Se ha cargado tu archivo con exito- <img class="img_profile_label" src="{{asset('assets/user/icons/comprobado.png')}}" alt=""><br>

                                                                                ¿Quieres Borrarlo?

                                                                        </p>

                                                                            <div class="d-flex justify-content-center">
                                                                                <button type="button" class="btn btn-danger btn-sm" onclick="eliminarDocumento('{{ route('eliminar.documento', $documentoSubido->id) }}')">Eliminar</button>
                                                                            </div>

                                                                    @else
                                                                        <input type="hidden" name="documento_ids[]" value="{{ $documento->id }}">
                                                                        <input type="hidden" name="curso" value="{{ $video->Cursos->id }}">
                                                                        <input   name="archivos[]" hidden id="btnoriginal{{ $documento->id }}{{$video->id_tickets}}" class="form-control text-center col-md-6" onChange="document.getElementById('tagsmall{{ $documento->id }}{{$video->id_tickets}}').innerText=document.getElementById('btnoriginal{{ $documento->id }}{{$video->id_tickets}}').files[0]['name'];" type="file" value="Adjuntar doc">
                                                                        <button type="button" id="botonpersonal{{ $documento->id }}{{$video->id_tickets}}" onClick="document.getElementById('btnoriginal{{ $documento->id }}{{$video->id_tickets}}').click();">Adjuntar doc</button>
                                                                        <small id='tagsmall{{ $documento->id }}{{$video->id_tickets}}'>No hay archivos adjuntos</small>
                                                                    @endif

                                                                    <script>
                                                                        function eliminarDocumento(url) {
                                                                            if (confirm('¿Estás seguro de que quieres eliminar este documento?')) {
                                                                                var form = document.createElement('form');
                                                                                form.method = 'POST';
                                                                                form.action = url;

                                                                                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                                                                                var hiddenField = document.createElement('input');
                                                                                hiddenField.type = 'hidden';
                                                                                hiddenField.name = '_token';
                                                                                hiddenField.value = csrfToken;

                                                                                form.appendChild(hiddenField);

                                                                                document.body.appendChild(form);
                                                                                form.submit();
                                                                            }
                                                                        }
                                                                    </script>

                                                                </div>
                                                            </div>
                                                        @endforeach

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
                @if ($cliente->name == 'Asiyadeth Virginia Hernández Cruz')
                    <div class="col-6  mb-2">
                        <a href="{{asset('carpetasestandares/Cedula de Evaluacion EC1313 ASIYADETH - Firmada-1.pdf') }}" download="Cedula de Evaluacion EC1313 ASIYADETH - Firmada-1.pdf" style="text-decoration: none; color: #000">
                            <img src="{{asset('assets/user/icons/pdf.png') }}" style="width: 45px; height: 45px;"/>
                            Cédula de evaluación
                        </a>
                        <a class="text-center text-white btn btn-sm ml-2" href="{{asset('carpetasestandares/Cedula de Evaluacion EC1313 ASIYADETH - Firmada-1.pdf') }}" download="Cedula de Evaluacion EC1313 ASIYADETH - Firmada-1.pdf" style="background: #836262; border-radius: 19px;">
                            Descargar
                        </a>
                    </div>

                    <div class="col-3 form-group p-3 mt-2">
                        <iframe class="mt-2" src="{{asset('carpetasestandares/Cedula de Evaluacion EC1313 ASIYADETH - Firmada-1.pdf')}}" style="width: 60%; height: 60px;"></iframe>
                        <p class="text-center ">
                            <a class="btn btn-sm text-dark" href="{{asset('carpetasestandares/Cedula de Evaluacion EC1313 ASIYADETH - Firmada-1.pdf') }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="nav-des-ejemplo" role="tabpanel" aria-labelledby="nav-des-ejemplo-tab" tabindex="0" style="min-height: auto!important;">
        <div class="modal-body row">
            <div class="row">
                <div class="col-6  mb-2">
                    <a href="{{asset('documentos/FICHA CLINICA CORPORAL.pdf') }}" download="FICHA CLINICA CORPORAL" style="text-decoration: none; color: #000">
                        <img src="{{asset('assets/user/icons/pdf.png') }}" style="width: 45px; height: 45px;"/>
                        FICHA CLINICA CORPORAL
                    </a>
                </div>
                <div class="col-6  mb-2">
                    <iframe class="mt-2" src="{{asset('documentos/FICHA CLINICA CORPORAL.pdf')}}" style="width: 60%; height: 60px;"></iframe>
                    <p class="text-center ">
                        <a class="btn btn-sm text-dark" href="{{asset('documentos/FICHA CLINICA CORPORAL.pdf') }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                    </p>
                </div>

                <div class="col-6  mb-2">
                    <a href="{{asset('documentos/FICHA CLINICA FACIAL.pdf') }}" download="FICHA CLINICA FACIAL" style="text-decoration: none; color: #000">
                        <img src="{{asset('assets/user/icons/pdf.png') }}" style="width: 45px; height: 45px;"/>
                        FICHA CLINICA FACIAL
                    </a>
                </div>
                <div class="col-6  mb-2">
                    <iframe class="mt-2" src="{{asset('documentos/FICHA CLINICA FACIAL.pdf')}}" style="width: 60%; height: 60px;"></iframe>
                    <p class="text-center ">
                        <a class="btn btn-sm text-dark" href="{{asset('documentos/FICHA CLINICA FACIAL.pdf') }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane fade" id="nav-estan-doc" role="tabpanel" aria-labelledby="nav-estan-doc-tab" tabindex="0" style="min-height: auto!important;">
        <div class="row">
            @foreach ($estandaresComprados as $estandar)
                <div class="col-12">
                        <h4 class="text-center">Guía para evaluar estándar {{ $estandar->nombre }}</h4> <br>
                        @php
                            $documentos_estandar = App\Models\CarpetaDocumentosEstandares::where('id_carpeta', $estandar->id)->where('guia', '=', '1')->get();
                        @endphp
                        <div class="row">
                            @foreach ($documentos_estandar as $documento)
                                @if (pathinfo($documento->nombre, PATHINFO_EXTENSION) == 'pdf')
                                <div class="col-4">
                                    <p class="text-center ">
                                        <a href="{{asset('carpetasestandares/'.$estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="text-decoration: none; color: #000">
                                            <img src="{{asset('assets/user/icons/pdf.png') }}" style="width: 45px; height: 45px;"/><br>
                                            {{ substr($documento->nombre, 13) }}
                                        </a><br>
                                        <a class="text-center text-white btn btn-sm" href="{{asset('carpetasestandares/'.$estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="background: #836262; border-radius: 19px;">
                                            Descargar
                                        </a>
                                    </p>
                                </div>
                                @else
                                <div class="col-4">
                                    <p class="text-center mt-2">
                                        <a href="{{asset('carpetasestandares/'.$estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="text-decoration: none; color: #000">
                                            <img src="{{asset('assets/user/icons/docx.png') }}" style="width: 45px; height: 45px;"/><br>
                                            {{ substr($documento->nombre, 13) }}
                                        </a><br>
                                        <a class="text-center text-white btn btn-sm" href="{{asset('carpetasestandares/'.$estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="background: #836262; border-radius: 19px;">
                                            Descargar
                                        </a>
                                    </p>
                                </div>
                                @endif
                            @endforeach
                            @if ($estandar->nombre == 'EC0616 - Prestación de Servicios Auxiliares de Enfermería en Cuidados Básicos y Orientación a Personas en Unidades de Atención Médica SEP CONOCER')
                                <div class="col-6 mb-5">
                                    <a href="https://www.youtube.com/watch?v=v06BVRvXvVI" style="text-decoration: none; color: #000" target="_blank">
                                        <img src="{{asset('assets/user/icons/youtube.png') }}" style="width: 45px; height: 45px;"/>
                                        Historia de la Enfermería en México
                                    </a><br>
                                    <a class="text-center text-white btn btn-sm ml-2" href="https://www.youtube.com/watch?v=v06BVRvXvVI" style="background: #836262; border-radius: 19px;" target="_blank">
                                        Ver Video
                                    </a>
                                </div>

                                <div class="col-6 mb-5">
                                    <a href="https://www.youtube.com/watch?v=gtAcz6VfkYk" style="text-decoration: none; color: #000" target="_blank">
                                        <img src="{{asset('assets/user/icons/youtube.png') }}" style="width: 45px; height: 45px;"/>
                                        ASEO Y CONFORT Uso de chata en hombre
                                    </a><br>
                                    <a class="text-center text-white btn btn-sm ml-2" href="https://www.youtube.com/watch?v=gtAcz6VfkYk" style="background: #836262; border-radius: 19px;" target="_blank">
                                        Ver Video
                                    </a>
                                </div>

                                <div class="col-6 mb-5">
                                    <a href="https://www.youtube.com/watch?v=8K1kOXVJ7wg" style="text-decoration: none; color: #000" target="_blank">
                                        <img src="{{asset('assets/user/icons/youtube.png') }}" style="width: 45px; height: 45px;"/>
                                        ASEO Y CONFORT Uso de chata en mujer
                                    </a><br>
                                    <a class="text-center text-white btn btn-sm ml-2" href="https://www.youtube.com/watch?v=8K1kOXVJ7wg" style="background: #836262; border-radius: 19px;" target="_blank">
                                        Ver Video
                                    </a>
                                </div>

                                <div class="col-6 mb-5">
                                    <a href="https://www.youtube.com/watch?v=uoEvPvZ624Q" style="text-decoration: none; color: #000" target="_blank">
                                        <img src="{{asset('assets/user/icons/youtube.png') }}" style="width: 45px; height: 45px;"/>
                                        Tendidos de camas
                                    </a><br>
                                    <a class="text-center text-white btn btn-sm ml-2" href="https://www.youtube.com/watch?v=uoEvPvZ624Q" style="background: #836262; border-radius: 19px;" target="_blank">
                                        Ver Video
                                    </a>
                                </div>

                                <div class="col-6 mb-5">
                                    <a href="https://www.youtube.com/watch?v=PGaQjxZp73M" style="text-decoration: none; color: #000" target="_blank">
                                        <img src="{{asset('assets/user/icons/youtube.png') }}" style="width: 45px; height: 45px;"/>
                                        Cómo hacer una cama hospitalaria ocupada
                                    </a><br>
                                    <a class="text-center text-white btn btn-sm ml-2" href="https://www.youtube.com/watch?v=PGaQjxZp73M" style="background: #836262; border-radius: 19px;" target="_blank">
                                        Ver Video
                                    </a>
                                </div>

                                <div class="col-6 mb-5">
                                    <a href="https://www.youtube.com/watch?v=chx-bc32vwU" style="text-decoration: none; color: #000" target="_blank">
                                        <img src="{{asset('assets/user/icons/youtube.png') }}" style="width: 45px; height: 45px;"/>
                                        La Reanimación Cardiopulmonar (RCP) : Primeros Auxilios
                                    </a><br>
                                    <a class="text-center text-white btn btn-sm ml-2" href="https://www.youtube.com/watch?v=chx-bc32vwU" style="background: #836262; border-radius: 19px;" target="_blank">
                                        Ver Video
                                    </a>
                                </div>

                                <div class="col-6 mb-5">
                                    <a href="https://www.youtube.com/watch?v=JX0dHdFuf5k" style="text-decoration: none; color: #000" target="_blank">
                                        <img src="{{asset('assets/user/icons/youtube.png') }}" style="width: 45px; height: 45px;"/>
                                        Oxigenoterapia - Técnica de enfermería
                                    </a><br>
                                    <a class="text-center text-white btn btn-sm ml-2" href="https://www.youtube.com/watch?v=JX0dHdFuf5k" style="background: #836262; border-radius: 19px;" target="_blank">
                                        Ver Video
                                    </a>
                                </div>

                                <div class="col-6 mb-5">
                                    <a href="https://www.youtube.com/watch?v=F1rf1ZLIhZ8" style="text-decoration: none; color: #000" target="_blank">
                                        <img src="{{asset('assets/user/icons/youtube.png') }}" style="width: 45px; height: 45px;"/>
                                        TECNICA DE AMORTAJAMIENTO
                                    </a><br>
                                    <a class="text-center text-white btn btn-sm ml-2" href="https://www.youtube.com/watch?v=F1rf1ZLIhZ8" style="background: #836262; border-radius: 19px;" target="_blank">
                                        Ver Video
                                    </a>
                                </div>

                                <div class="col-6 mb-5">
                                    <a href="https://www.youtube.com/watch?v=XPONFUeQeig" style="text-decoration: none; color: #000" target="_blank">
                                        <img src="{{asset('assets/user/icons/youtube.png') }}" style="width: 45px; height: 45px;"/>
                                        Enfermeras y turno de noche: cuidados necesarios orientados al descanso del paciente
                                    </a><br>
                                    <a class="text-center text-white btn btn-sm ml-2" href="https://www.youtube.com/watch?v=XPONFUeQeig" style="background: #836262; border-radius: 19px;" target="_blank">
                                        Ver Video
                                    </a>
                                </div>

                                <div class="col-6 mb-5">
                                    <a href="https://www.youtube.com/watch?v=v8G9mxIfEXw" style="text-decoration: none; color: #000" target="_blank">
                                        <img src="{{asset('assets/user/icons/youtube.png') }}" style="width: 45px; height: 45px;"/>
                                        Adrenalina (Epinefrina) en Choque anafiláctico By Dr. Zamarrón
                                    </a><br>
                                    <a class="text-center text-white btn btn-sm ml-2" href="https://www.youtube.com/watch?v=v8G9mxIfEXw" style="background: #836262; border-radius: 19px;" target="_blank">
                                        Ver Video
                                    </a>
                                </div>

                                <div class="col-6 mb-5">
                                    <a href="https://www.youtube.com/watch?v=UGhc8mAHrVQ" style="text-decoration: none; color: #000" target="_blank">
                                        <img src="{{asset('assets/user/icons/youtube.png') }}" style="width: 45px; height: 45px;"/>
                                        BAÑO DE PACIENTE EN CAMA
                                    </a><br>
                                    <a class="text-center text-white btn btn-sm ml-2" href="https://www.youtube.com/watch?v=UGhc8mAHrVQ" style="background: #836262; border-radius: 19px;" target="_blank">
                                        Ver Video
                                    </a>
                                </div>
                            @endif
                        </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
