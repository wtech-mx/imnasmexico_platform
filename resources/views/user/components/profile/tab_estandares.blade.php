    <div class="accordion row" id="acordcion_mb_clases">
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
                                <div class="accordion-body row">
                                        @php
                                            $documentos_estandar = App\Models\CarpetaDocumentosEstandares::where('id_carpeta', $estandar->id)->where('guia', '=', NULL)->get();
                                        @endphp
                                        <form id="formDocumentos_sepconocer{{$estandar->id}}" class="row" method="POST" enctype="multipart/form-data">

                                                @csrf

                                                @foreach ($documentos_estandar as $documento)
                                                    @php
                                                        $documentoDescargado = DB::table('documentos_estandares')->where('id_usuario', $cliente->id)->where('id_documento', $documento->id)->exists();
                                                        $documentoSubido = DB::table('documentos_estandares')->where('id_usuario', $cliente->id)->where('id_documento', $documento->id)->orderBy('created_at', 'desc')->first();
                                                    @endphp
                                                    <div class="row">

                                                        <div class="col-5  ">
                                                                <a href="{{asset('carpetasestandares/'.$estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="text-decoration: none; color: #000">
                                                                    <img src="{{asset('assets/user/icons/pdf.png') }}" style="width: 45px; height: 45px;"/>
                                                                    {{ substr($documento->nombre, 13) }}
                                                                </a>
                                                                <a class="text-center text-white btn btn-sm mt-2" href="{{asset('carpetasestandares/'.$estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="background: #836262; border-radius: 19px;">
                                                                    Descargar
                                                                </a>
                                                        </div>

                                                        <div class="col-3 ">

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
                                                                            <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$documentoSubido->documento) }}" alt="Imagen" style="width: 120px;height:auto;"/><br>
                                                                            <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documentoSubido->documento) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                                                        </p>
                                                                @endif

                                                        </div>

                                                        <div class="col-4 ">

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
                                                                    <input  name="archivos[]"  id="btnoriginal{{ $documento->id }}{{$video->id_tickets}}" class="form-control btnoriginal{{ $documento->id }}{{$video->id_tickets}}" type="file">
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

                @endforeach
            @endif
        @endforeach

    </div>

