    <div class="accordion row" id="acordcion_mb_clases">
        <div class="col-12 text-center mb-3">
            <h3>Subir en formato PDF o Documento de WORD</h3>
        </div>
        @php
            $displayedFolders = []; // Keep track of displayed folders
        @endphp

        @foreach ($usuario_compro as $video)
            @if ($video->Cursos->CursosEstandares->count() > 0)
                @foreach ($estandaresComprados as $estandar)
                    @if ($estandar->nombre !== 'EC0193 - PRESTACIÓN DE SERVICIOS DE CORTES DE CABELLO')
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
                                                    $documentos_estandar = App\Models\CarpetaDocumentosEstandares::where('id_carpeta', $estandar->id)->where('guia', '=', NULL)->orderBy('orden', 'ASC')->get();
                                                @endphp
                                                <form id="formDocumentos_sepconocer{{$estandar->id}}" class="row mb-3" method="POST" enctype="multipart/form-data" style="padding:0px">

                                                        @csrf

                                                        @foreach ($documentos_estandar as $documento)
                                                            @php
                                                                $documentoDescargado = DB::table('documentos_estandares')->where('id_usuario', $cliente->id)->where('id_documento', $documento->id)->exists();
                                                                $documentoSubido = DB::table('documentos_estandares')->where('id_usuario', $cliente->id)->where('id_documento', $documento->id)->orderBy('created_at', 'desc')->first();
                                                            @endphp
                                                            <div class="row">

                                                                <div class="col-12  col-md-5 col-lg-5 mb-4 ">
                                                                    @if (pathinfo($documento->nombre, PATHINFO_EXTENSION) == 'png')
                                                                        <a style="text-decoration: none; color: #000">
                                                                            <img src="{{asset('assets/user/icons/pdf.png') }}" style="width: 45px; height: 45px;"/>
                                                                            Subir proyecto
                                                                        </a>
                                                                    @else
                                                                        <a href="{{asset('carpetasestandares/'.$estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="text-decoration: none; color: #000">
                                                                            <img src="{{asset('assets/user/icons/pdf.png') }}" style="width: 45px; height: 45px;"/>
                                                                            {{ substr($documento->nombre, 13) }}
                                                                        </a>
                                                                        <a class="text-center text-white btn btn-sm mt-2" href="{{asset('carpetasestandares/'.$estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="background: #836262; border-radius: 19px;">
                                                                            Descargar
                                                                        </a>
                                                                    @endif
                                                                </div>

                                                                <div class="col-6 col-md-3 col-lg-3 mb-4 ">

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
                                                                                    <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: 60px;"/><br>
                                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documentoSubido->documento) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                                                                </p>
                                                                        @endif

                                                                </div>

                                                                <div class="col-6 col-md-3 col-lg-4 mb-4 ">

                                                                        <p class="text-center">
                                                                            Se ha cargado tu archivo con exito- <img class="img_profile_label" src="{{asset('assets/user/icons/comprobado.png')}}" alt=""><br>
                                                                            ¿Quieres Borrarlo?
                                                                        </p>

                                                                        <div class="d-flex justify-content-center">
                                                                            <button type="button" class="btn btn-danger btn-sm" onclick="eliminarDocumentoAjax('{{ route('eliminar.documento', $documentoSubido->id) }}', this)">Eliminar</button>
                                                                            {{-- <button type="button" class="btn btn-danger btn-sm" onclick="eliminarDocumento('{{ route('eliminar.documento', $documentoSubido->id) }}')">Eliminar</button> --}}
                                                                        </div>

                                                                        @else
                                                                            <input type="hidden" name="documento_ids[]" value="{{ $documento->id }}">
                                                                            <input type="hidden" name="curso" value="{{ $video->Cursos->id }}">
                                                                            <input  name="archivos[]"  id="btnoriginal{{ $documento->id }}{{$video->id_tickets}}" class="form-control btnoriginal{{ $documento->id }}{{$video->id_tickets}}" type="file">
                                                                        @endif
                                                                        <div class="archivo-subido mt-2"></div>


                                                                        <!-- Barra de progreso -->
                                                                        <div class="progress mt-2 d-none progress-subida" style="height: 20px;">
                                                                            <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                                                role="progressbar"
                                                                                style="width: 0%;"
                                                                                aria-valuenow="0"
                                                                                aria-valuemin="0"
                                                                                aria-valuemax="100">0%</div>
                                                                        </div>
                                                                        <!-- Spinner -->
                                                                        <div class="spinner-border text-primary mt-2 d-none spinner-subida" role="status" style="width: 1.5rem; height: 1.5rem;">
                                                                            <span class="visually-hidden">Cargando...</span>
                                                                        </div>

                                                                        <script>
                                                                            function eliminarDocumentoAjax(url, button) {
                                                                                if (confirm('¿Estás seguro de que quieres eliminar este documento?')) {
                                                                                    // Mostrar un spinner o deshabilitar el botón mientras se procesa
                                                                                    button.disabled = true;

                                                                                    // Realizar la solicitud AJAX
                                                                                    $.ajax({
                                                                                        url: url,
                                                                                        type: 'DELETE',
                                                                                        headers: {
                                                                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                                                                        },
                                                                                        success: function(response) {
                                                                                            if (response.success) {
                                                                                                // Mostrar mensaje de éxito
                                                                                                alert(response.message);

                                                                                                // Obtener el contenedor principal de la columna
                                                                                                const parentCol = $(button).closest('.col-6');

                                                                                                // Remover el mensaje de éxito, el botón de eliminar y el contenido del archivo subido
                                                                                                parentCol.empty();

                                                                                                // Obtener el contenedor de la columna del archivo subido
                                                                                                const fileCol = parentCol.siblings('.col-md-3, .col-lg-3');

                                                                                                // Vaciar el contenido del contenedor del archivo subido
                                                                                                fileCol.empty();

                                                                                                // Insertar nuevamente el input para subir archivos
                                                                                                parentCol.append(`
                                                                                                    <input type="hidden" name="documento_ids[]" value="{{ $documento->id }}">
                                                                                                    <input type="hidden" name="curso" value="{{ $video->Cursos->id }}">
                                                                                                    <input name="archivos[]" id="btnoriginal{{ $documento->id }}{{$video->id_tickets}}" class="form-control btnoriginal{{ $documento->id }}{{$video->id_tickets}}" type="file">
                                                                                                `);
                                                                                                location.reload();
                                                                                            } else {
                                                                                                alert('Hubo un problema al eliminar el documento.');
                                                                                            }
                                                                                        },
                                                                                        error: function(xhr) {
                                                                                            console.error('Error:', xhr.responseText);
                                                                                            l
                                                                                            alert('Ocurrió un error al intentar eliminar el documento.');
                                                                                        },
                                                                                        complete: function() {
                                                                                            // Habilitar el botón nuevamente
                                                                                            button.disabled = false;
                                                                                        }
                                                                                    });
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
                    @endif
                @endforeach
            @endif
        @endforeach

        @foreach ($estandar_user as $estandar)
            @if ($estandar->Estandar )
                @if ($estandar->Estandar->id !== 54)
                    <div class="col-12">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{$estandar->Estandar->id}}" aria-expanded="true" aria-controls="collapseOne{{$estandar->id}}" style="background-color: #836262;">
                                    <img class="icon_nav_course" src="{{asset('assets/user/icons/folder.png')}}" alt="">
                                    {{$estandar->Estandar->nombre}}
                                    <img class="click_docmuentos" src="{{asset('assets/user/icons/clic2.png')}}" alt="" >
                                </button>
                            </h2>

                            <div id="collapseOne{{$estandar->Estandar->id}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#acordcion_mb_clases">
                                <div class="accordion-body row">
                                        @php
                                            $documentos_estandar = App\Models\CarpetaDocumentosEstandares::where('id_carpeta', $estandar->Estandar->id)->where('guia', '=', NULL)->orderBy('orden', 'ASC')->get();
                                        @endphp
                                        <form id="formDocumentos_sepconocer{{$estandar->Estandar->id}}" class="row mb-3" method="POST" enctype="multipart/form-data" style="padding:0px">

                                                @csrf

                                                @foreach ($documentos_estandar as $documento)
                                                    @php
                                                        $documentoDescargado = DB::table('documentos_estandares')->where('id_usuario', $cliente->id)->where('id_documento', $documento->id)->exists();
                                                        $documentoSubido = DB::table('documentos_estandares')->where('id_usuario', $cliente->id)->where('id_documento', $documento->id)->orderBy('created_at', 'desc')->first();
                                                    @endphp
                                                    <div class="row">

                                                        <div class="col-12  col-md-5 col-lg-5 mb-4 ">
                                                                <a href="{{asset('carpetasestandares/'.$estandar->Estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="text-decoration: none; color: #000">
                                                                    <img src="{{asset('assets/user/icons/pdf.png') }}" style="width: 45px; height: 45px;"/>
                                                                    {{ substr($documento->nombre, 13) }}
                                                                </a>
                                                                <a class="text-center text-white btn btn-sm mt-2" href="{{asset('carpetasestandares/'.$estandar->Estandar->nombre. '/' .$documento->nombre) }}" download="{{$documento->nombre}}" style="background: #836262; border-radius: 19px;">
                                                                    Descargar
                                                                </a>
                                                        </div>

                                                        <div class="col-6 col-md-3 col-lg-3 mb-4 ">

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
                                                                            <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: 60px;"/><br>
                                                                            <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $cliente->telefono . '/' .$documentoSubido->documento) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                                                        </p>
                                                                @endif

                                                        </div>

                                                        <div class="col-6 col-md-3 col-lg-4 mb-4 ">

                                                                <p class="text-center">
                                                                    Se ha cargado tu archivo con exito- <img class="img_profile_label" src="{{asset('assets/user/icons/comprobado.png')}}" alt=""><br>
                                                                    ¿Quieres Borrarlo?
                                                                </p>

                                                                <div class="d-flex justify-content-center">
                                                                    <button type="button" class="btn btn-danger btn-sm" onclick="eliminarDocumentoAjax('{{ route('eliminar.documento', $documentoSubido->id) }}', this)">Eliminar</button>                                                            </div>

                                                                @else
                                                                    <input type="hidden" name="documento_ids[]" value="{{ $documento->id }}">
                                                                    <input type="hidden" name="curso" value="{{ $estandar->id }}">
                                                                    <input  name="archivos[]"  id="btnoriginal{{ $documento->id }}{{$estandar->id}}" class="form-control btnoriginal{{ $documento->id }}{{$estandar->id}}" type="file">
                                                                @endif

                                                                <div class="archivo-subido mt-2"></div>


                                                                    <!-- Barra de progreso -->
                                                                    <div class="progress mt-2 d-none progress-subida" style="height: 20px;">
                                                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                                            role="progressbar"
                                                                            style="width: 0%;"
                                                                            aria-valuenow="0"
                                                                            aria-valuemin="0"
                                                                            aria-valuemax="100">0%</div>
                                                                    </div>
                                                                                                                                    <!-- Spinner -->
                                                                    <div class="spinner-border text-primary mt-2 d-none spinner-subida" role="status" style="width: 1.5rem; height: 1.5rem;">
                                                                        <span class="visually-hidden">Cargando...</span>
                                                                    </div>

                                                                    <script>
                                                                        function eliminarDocumentoAjax(url, button) {
                                                                            if (confirm('¿Estás seguro de que quieres eliminar este documento?')) {
                                                                                // Mostrar un spinner o deshabilitar el botón mientras se procesa
                                                                                button.disabled = true;

                                                                                // Realizar la solicitud AJAX
                                                                                $.ajax({
                                                                                    url: url,
                                                                                    type: 'DELETE',
                                                                                    headers: {
                                                                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                                                                    },
                                                                                    success: function(response) {
                                                                                        if (response.success) {
                                                                                            // Mostrar mensaje de éxito
                                                                                            alert(response.message);

                                                                                            // Obtener el contenedor principal de la columna
                                                                                            const parentCol = $(button).closest('.col-6');

                                                                                            // Remover el mensaje de éxito, el botón de eliminar y el contenido del archivo subido
                                                                                            parentCol.empty();

                                                                                            // Obtener el contenedor de la columna del archivo subido
                                                                                            const fileCol = parentCol.siblings('.col-md-3, .col-lg-3');

                                                                                            // Vaciar el contenido del contenedor del archivo subido
                                                                                            fileCol.empty();

                                                                                            // Insertar nuevamente el input para subir archivos
                                                                                            parentCol.append(`
                                                                                                <input type="hidden" name="documento_ids[]" value="{{ $documento->id }}">

                                                                                            `);
                                                                                            location.reload();
                                                                                        } else {
                                                                                            alert('Hubo un problema al eliminar el documento.');
                                                                                        }
                                                                                    },
                                                                                    error: function(xhr) {
                                                                                        console.error('Error:', xhr.responseText);
                                                                                        alert('Ocurrió un error al intentar eliminar el documento.');
                                                                                    },
                                                                                    complete: function() {
                                                                                        // Habilitar el botón nuevamente
                                                                                        button.disabled = false;
                                                                                    }
                                                                                });
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
                @endif
            @endif
        @endforeach
    </div>


