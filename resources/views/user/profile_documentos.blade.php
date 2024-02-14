<nav>
    <div class="d-flex justify-content-center">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-doc-perso-tab" data-bs-toggle="tab" data-bs-target="#nav-doc-perso" type="button" role="tab" aria-controls="nav-doc-perso" aria-selected="true">
                Doc. Personal
            </button>

            <button class="nav-link" id="nav-des-sub-doc-tab" data-bs-toggle="tab" data-bs-target="#nav-des-sub-doc" type="button" role="tab" aria-controls="nav-des-sub-doc" aria-selected="false">
                Descargas/Subir Documentos
            </button>

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

                        @if ($cliente->name == 'Asiyadeth Virginia Hernández Cruz')
                            <div class="col-6 form-group mb-5 mt-5">
                                <label for="firma">Cédula de evaluación</label><br>
                                <a class="text-center text-white btn btn-sm ml-2" href="{{asset('carpetasestandares/NUEVA CEDULA VIRGINIA EC1313 - FIRMADA.pdf') }}" download="NUEVA CEDULA VIRGINIA EC1313 - FIRMADA.pdf" style="background: #836262; border-radius: 19px;">
                                    Descargar Cédula
                                </a>
                            </div>
                        @endif
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

                    <div class="col-6 form-group mb-5">
                        <label for="foto_tam_infantil">Foto Infantil color</label>
                        <input id="foto_tam_infantil" name="foto_tam_infantil" type="file" class="form-control" >
                    </div>

                    <div class="col-6 form-group mb-5">
                        <label for="firma">Firma</label>
                        <input id="firma" name="firma" type="file" class="form-control" >
                    </div>

                    @if ($cliente->name == 'Asiyadeth Virginia Hernández Cruz')
                        <div class="col-6 form-group mb-5 mt-5">
                            <label for="firma">Cédula de evaluación</label><br>
                            <a class="text-center text-white btn btn-sm ml-2" href="{{asset('carpetasestandares/NUEVA CEDULA VIRGINIA EC1313 - FIRMADA.pdf') }}" download="NUEVA CEDULA VIRGINIA EC1313 - FIRMADA.pdf" style="background: #836262; border-radius: 19px;">
                                Descargar Cédula
                            </a>
                        </div>
                    @endif
                @endif
            </div>
            @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            @endif
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
            @foreach ($usuario_compro as $video)
                @if ($video->Cursos->CursosEstandares->count() > 0)
                    @foreach ($estandaresComprados as $estandar)
                        <div class="col-12">
                            <h4 class="text-center">{{ $estandar->nombre }}</h4> <br>
                                @php
                                    $documentos_estandar = App\Models\CarpetaDocumentosEstandares::where('id_carpeta', $estandar->id)->where('guia', '=', NULL)->get();
                                @endphp
                                    <form action="{{ route('documentos.store_cliente', $cliente->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
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
                                                            @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                                                                ¿Quieres Borrarlo?
                                                            @endif
                                                        </p>
                                                        @if ($cliente->name != 'Asiyadeth Virginia Hernández Cruz')
                                                            <div class="d-flex justify-content-center">
                                                                <button type="button" class="btn btn-danger btn-sm" onclick="eliminarDocumento('{{ route('eliminar.documento', $documentoSubido->id) }}')">Eliminar</button>
                                                            </div>
                                                        @endif
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
                                        <div class="row">
                                            <div class="col-8"></div>
                                            <div class="col-4">
                                                <button class="btn_save_profile d-inline-block mt-3 mb-3" style="background: {{$configuracion->color_boton_save}}; color: #ffff" type="submit">Guardar Documentos</button>
                                            </div>
                                        </div>
                                    </form>
                        </div>
                    @endforeach
                @endif
            @endforeach
        </div>
    </div>

    <div class="tab-pane fade" id="nav-estan-doc" role="tabpanel" aria-labelledby="nav-estan-doc-tab" tabindex="0" style="min-height: auto!important;">
        <div class="row">
            @foreach ($estandaresComprados as $estandar)
            <div class="col-12">
                    <h4 class="text-center">Guía para estándar {{ $estandar->nombre }}</h4> <br>
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
                        </div>
            </div>
            @endforeach
        </div>
    </div>

</div>
