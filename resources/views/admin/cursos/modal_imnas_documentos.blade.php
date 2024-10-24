<!-- Modal -->
<div class="modal fade" id="modal_imnas_documentos_{{ $order->User->id }}" tabindex="-1" aria-labelledby="modal_documentosLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modal_documentosLabel">Generar Diploma y/o Certificacion IMNAS Listas</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <nav class="mt-3">
            <div class="d-flex justify-content-center">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-emitir-imnas-tab" data-bs-toggle="tab" data-bs-target="#nav-emitir-imnas{{$order->User->id }}" type="button" role="tab" aria-controls="nav-emitir-imnas{{$order->User->id }}" aria-selected="true">
                        Emision
                    </button>

                    <button class="nav-link" id="nav-registro-imnas-tab" data-bs-toggle="tab" data-bs-target="#nav-registro-imnas{{$order->User->id }}" type="button" role="tab" aria-controls="nav-registro-imnas{{$order->User->id }}" aria-selected="false">
                        Estatus
                    </button>
                </div>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent" style="">
            <div class="tab-pane fade show active" id="nav-emitir-imnas{{$order->User->id }}" role="tabpanel" aria-labelledby="nav-emitir-imnas-tab" tabindex="0" style="min-height: auto!important;">
                <div class="modal-body row">

                    <div class="col-12">
                        <form method="POST" action="{{ route('generar_enviar.documento') }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="email" id="email" value="{{ $order->User->email }}">

                            <div class="row">
                                    <input id="id_curso" name="id_curso" type="text" class="form-control" value="{{ $ticket->Cursos->id }}" style="display: none" >
                                    <input id="id_ticket" name="id_ticket" type="text" class="form-control" value="{{ $ticket->id }}" style="display: none" >
                                    <input id="id_ticket_orders" name="id_ticket_orders" type="text" class="form-control" value="{{ $order->id }}" style="display: none">
                                    <input id="id_usuario" name="id_usuario" type="text" class="form-control" value="{{ $order->id_usuario }}" style="display: none" >

                                    <div class="form-group col-12 mt-3">
                                        <label for="name">Nombre Completo *</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img class="img_profile_label" src="{{asset('assets/user/icons/mujer.png')}}" alt="" width="30px">
                                            </span>
                                            <input id="nombre" name="nombre" type="text" class="form-control" value="{{ $order->User->name }}" readonly >
                                        </div>
                                    </div>

                                    <div class="form-group col-12 ">
                                        <label for="name">Curso *</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img class="img_profile_label" src="{{asset('assets/user/icons/aprender-en-linea.webp')}}" alt="" width="30px">
                                            </span>
                                            <input id="curso" name="curso" type="text" class="form-control" value="{{ $ticket->Cursos->nombre }}" readonly >
                                        </div>
                                    </div>

                                    <div class="form-group col-6 ">
                                        <label for="name">Fecha del Curso *</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img class="img_profile_label" src="{{asset('assets/user/icons/fecha-limite.webp')}}" alt="" width="30px">
                                            </span>
                                            <input id="fecha" name="fecha" type="text" class="form-control" value="{{ $ticket->Cursos->fecha_inicial }}" readonly >
                                        </div>
                                    </div>

                                    <div class="form-group col-6">
                                        <label for="name">Tipo de documento *</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img class="img_profile_label" src="{{asset('assets/user/icons/certificate.png')}}" alt="" width="30px">
                                            </span>
                                            <select name="tipo" id="tipo" class="form-select" >
                                                    <option value="2">RN-Cedula de identidad de papel General</option>
                                                    {{-- <option value="3">RN - Titulo Honorifico Generico QRS</option> --}}
                                                    <option value="4">RN - Diploma Imnas</option>
                                                    <option value="5">RN - Credencial General</option>
                                                    <option value="3">RN - Titulo Honorifico QRS</option>

                                                    @if (str_contains($ticket->Cursos->nombre,'medicina estetica'))
                                                        <option value="6">CN - Tira de materias aparatologia</option>
                                                    @endif
                                                    @if (str_contains($ticket->Cursos->nombre, 'Alisados'))
                                                        <option value="7">CN - Tira de materias alasiados progresivos</option>
                                                    @endif
                                                    @if (str_contains($ticket->Cursos->nombre, 'Cosmetología Facial y Corporal'))
                                                        <option value="8">CN - Tira de materias cosmetologia facial y corporal</option>
                                                    @endif
                                                    @if (str_contains($ticket->Cursos->nombre, 'Cosmiatria'))
                                                        <option value="9">CN - Tira de materias cosmiatria estetica avanzada</option>
                                                    @endif
                                                    @if (str_contains($ticket->Cursos->nombre, 'Auxiliar'))
                                                        <option value="10">CN - Tira de materias auxiliar en cuidados de atencion medica</option>
                                                    @endif
                                                    @if (str_contains($ticket->Cursos->nombre, 'Mesoterapia'))
                                                        <option value="11">CN - Tira de materias masoterapia</option>
                                                    @endif
                                                    @if (str_contains($ticket->Cursos->nombre, 'Cosmetología'))
                                                        <option value="12">CN - Tira de materias Cosmetologia</option>
                                                    @endif

                                            </select>
                                        </div>
                                    </div>
                                    @php
                                        // Datos de ejemplo
                                        $nombreCurso = $ticket->Cursos->nombre;
                                        $idUsuario = $order->User->id;
                                        $numeroAleatorio = rand(100, 999); // Generar un número aleatorio de tres dígitos

                                        // Dividir el nombre del curso en palabras
                                        $palabras = preg_split('/\s+/', $nombreCurso);

                                        // Inicializar una variable para las iniciales del curso
                                        $inicialesCurso = '';

                                        // Recorrer las palabras del nombre del curso y obtener iniciales
                                        foreach ($palabras as $palabra) {
                                            $palabra = preg_replace("/[^a-zA-Z]+/", "", $palabra); // Eliminar caracteres no alfabéticos
                                            $inicialesCurso .= strtoupper(substr($palabra, 0, 1));
                                        }

                                        // Combinar todos los elementos en el código del folio
                                        $folio = $inicialesCurso . $idUsuario . '-' . $ticket->id_curso;

                                    @endphp

                                    @if ($ticket->Cursos->stps == '1')
                                    <div class="form-group col-6 gc_cn" style="display: none">
                                        <label for="name">Folio *</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
                                            </span>
                                            <input id="folio" name="folio" type="text" class="form-control" value="{{ $folio }}" >
                                        </div>
                                    </div>

                                    @endif

                                    @if ($ticket->Cursos->imnas == '1' && $ticket->Cursos->titulo_hono == NULL)

                                    <div class="gc_cn" style="">

                                        <div class="row">

                                            <div class="form-group col-12 gc_cn">
                                                <p>Los campos de (Nombre (s) y Apellidos) <br>son solo obligatorios para generar la credencial  </p>
                                                <p>Link de la pag para remover los fondos de las fotografias <strong><a style="text-decoration:revert " href="https://www.remove.bg/es/upload" target="_blank" >remove.bg/es/upload</a></strong></p>
                                            </div>

                                            <div class="form-group col-6 gc_cn">
                                                <label for="name">Nombre (s)</label>
                                                <input id="nombres" name="nombres" type="text" class="form-control"  >
                                            </div>

                                            <div class="form-group col-6 gc_cn">
                                                <label for="name">Apellido Paterno</label>
                                                <input id="apellido_apeterno" name="apellido_apeterno" type="text" class="form-control"  >
                                            </div>

                                            <div class="form-group col-6 gc_cn">
                                                <label for="name">Apellido Materno</label>
                                                <input id="apellido_materno" name="apellido_materno" type="text" class="form-control"  >
                                            </div>

                                            <div class="form-group col-6 gc_cn">
                                                <label for="name">Folio *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
                                                    </span>
                                                    <input id="folio" name="folio" type="text" class="form-control" value="{{ $folio }}" >
                                                </div>
                                            </div>

                                            <div class="form-group col-6 gc_cn">
                                                <label for="name">Nacionalidad *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img class="img_profile_label" src="{{asset('assets/user/icons/flag.png')}}" alt="" width="30px">
                                                    </span>
                                                    <input id="nacionalidad" name="nacionalidad" type="text" class="form-control" value="Mexicana" >
                                                </div>
                                            </div>

                                            @if ($order->User->Documentos)
                                                @if ($order->User->Documentos->firma !== null)
                                                <div class="form-group col-6 gc_cn">
                                                    <label for="name">Firma Personal *</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img class="img_profile_label" src="{{asset('assets/user/icons/firma-digital.png')}}" alt="" width="30px">
                                                        </span>
                                                        <input id="firma" name="firma" type="file" class="form-control">
                                                    </div>
                                                    @if (pathinfo($order->User->Documentos->firma, PATHINFO_EXTENSION) == 'pdf')
                                                        <a class="text-center text-white btn btn-sm mt-2" href="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->firma) }}" download="{{ $order->User->Documentos->firma }}" style="background: #836262; border-radius: 19px;">
                                                            Descargar Documento
                                                        </a>
                                                    @else
                                                        <div class="input-group">
                                                            <img id="blah" src="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->firma) }}" alt="Imagen" style="width: 100px;height: 100px;">
                                                        </div>
                                                    @endif

                                                </div>

                                                @else
                                                <div class="form-group col-6 gc_cn">
                                                    <label for="name">Firma Personal *</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img class="img_profile_label" src="{{asset('assets/user/icons/firma-digital.png')}}" alt="" width="30px">
                                                        </span>
                                                        <input id="firma" name="firma" type="file" class="form-control">
                                                    </div>
                                                    @if (pathinfo($order->User->Documentos->firma, PATHINFO_EXTENSION) == 'pdf')
                                                        <a class="text-center text-white btn btn-sm mt-2" href="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->firma) }}" download="{{ $order->User->Documentos->firma }}" style="background: #836262; border-radius: 19px;">
                                                            Descargar Documento
                                                        </a>
                                                    @else
                                                        <div class="input-group">
                                                            <img id="blah" src="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->firma) }}" alt="Imagen" style="width: 100px;height: 100px;">
                                                        </div>
                                                    @endif

                                                </div>
                                                @endif
                                            @endif

                                            @if ($order->User->Documentos)
                                                @if ($order->User->Documentos->foto_tam_infantil !== null)

                                                    <div class="form-group col-6 gc_cn">
                                                        <label for="name">Fotografia * .</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img class="img_profile_label" src="{{asset('assets/user/icons/perfil.png')}}" alt="" width="30px">
                                                            </span>
                                                            <input id="img_infantil" name="img_infantil" type="file" class="form-control"  >
                                                        </div>
                                                        @if (pathinfo($order->User->Documentos->foto_tam_infantil, PATHINFO_EXTENSION) == 'pdf')
                                                            <a class="text-center text-white btn btn-sm mt-2" href="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->foto_tam_infantil) }}" download="{{ $order->User->Documentos->foto_tam_infantil }}" style="background: #836262; border-radius: 19px;">
                                                                Descargar Documento
                                                            </a>
                                                        @else
                                                            <img id="blah" src="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->foto_tam_infantil) }}" alt="Imagen" style="width: 100px;height: 100px;">
                                                        @endif
                                                    </div>

                                                    <div class="form-group col-6 gc_cn">
                                                        <label for="name">Fotografia 2*</label> <br>


                                                        @if ($order->User->Documentos && $order->User->Documentos->foto_infantil_blanco)
                                                            @if (pathinfo($order->User->Documentos->foto_infantil_blanco, PATHINFO_EXTENSION) == 'pdf')
                                                                <a class="text-center text-white btn btn-sm mt-2" href="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->foto_infantil_blanco) }}" download="{{ $order->User->Documentos->foto_infantil_blanco }}" style="background: #836262; border-radius: 19px;">
                                                                    Descargar Documento
                                                                </a>
                                                            @else
                                                                <img id="blah" src="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->foto_infantil_blanco) }}" alt="Imagen" style="width: 100px;height: 100px;">
                                                            @endif
                                                        @else
                                                            <p>No se ha subido ninguna fotografía.</p>
                                                        @endif
                                                    </div>


                                                @endif
                                                @else
                                                <div class="form-group col-6 gc_cn">
                                                    <label for="name">Fotografia * ..</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img class="img_profile_label" src="{{asset('assets/user/icons/perfil.png')}}" alt="" width="30px">
                                                        </span>
                                                        <input id="img_infantil" name="img_infantil" type="file" class="form-control"  >
                                                    </div>
                                                </div>

                                                <div class="form-group col-6 gc_cn">
                                                    <label for="name">Fotografia 2*</label>

                                                    @if ($order->User->Documentos && $order->User->Documentos->foto_infantil_blanco)
                                                        @if (pathinfo($order->User->Documentos->foto_infantil_blanco, PATHINFO_EXTENSION) == 'pdf')
                                                            <a class="text-center text-white btn btn-sm mt-2" href="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->foto_infantil_blanco) }}" download="{{ $order->User->Documentos->foto_infantil_blanco }}" style="background: #836262; border-radius: 19px;">
                                                                Descargar Documento
                                                            </a>
                                                        @else
                                                            <img id="blah" src="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->foto_infantil_blanco) }}" alt="Imagen" style="width: 100px;height: 100px;">
                                                        @endif
                                                    @else
                                                        <p>No se ha subido ninguna fotografía.</p>
                                                    @endif
                                                </div>

                                            @endif

                                            <div class="form-group col-6 gc_cn">
                                                <label for="name">Curp/generar</label>
                                                <select class="form-select" name="curp_option" id="curp_option">
                                                    <option value="Curp">CURP</option>
                                                    <option value="Generar curp">Generar CURP</option>
                                                </select>
                                            </div>

                                            @if ($order->User->Documentos)
                                                @if ($order->User->Documentos->curp !== null)

                                                <div class="form-group col-12 curp_content">
                                                    <label for="name">CURP(s)*:</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img class="img_profile_label" src="{{asset('assets/user/icons/abc-block.png')}}" alt="" width="30px">
                                                        </span>
                                                        <input id="curp" name="curp" type="text" class="form-control" value="{{ $order->User->curp_escrito }}" >
                                                    </div>
                                                    @if (pathinfo($order->User->Documentos->curp, PATHINFO_EXTENSION) == 'pdf')
                                                        <iframe class="mt-2" src="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->curp)}}" style="width: 100%; height: 350px;"></iframe>
                                                        <p class="text-center">
                                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->curp) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver archivo</a>
                                                        </p>
                                                    @elseif (pathinfo($order->User->Documentos->curp, PATHINFO_EXTENSION) == 'png' || pathinfo($order->User->Documentos->curp, PATHINFO_EXTENSION) == 'jpg' || pathinfo($order->User->Documentos->curp, PATHINFO_EXTENSION) == 'jpeg')
                                                    <p class="text-center mt-2">
                                                        <img id="blah" src="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->curp) }}" alt="Imagen" style="width: 250px;height: 100%;"/><br>
                                                        <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->curp) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver Imagen</a>
                                                    </p>
                                                    @endif
                                                </div>
                                                @endif
                                            @endif

                                            <div class="gc_content" style="display: none">
                                                <div class="row">
                                                    <div class="form-group col-6 gc_content" >
                                                        <label for="name">Nombre(s)*:</label>
                                                        <input id="nombre_curp" name="nombre_curp" type="text" class="form-control"  >
                                                    </div>

                                                    <div class="form-group col-6 gc_content" >
                                                        <label for="name">Primer apellido*:</label>
                                                        <input id="primer_apellido" name="primer_apellido" type="text" class="form-control"  >
                                                    </div>

                                                    <div class="form-group col-6 gc_content" >
                                                        <label for="name">Segundo apellido:</label>
                                                        <input id="segundo_apellido" name="segundo_apellido" type="text" class="form-control"  >
                                                    </div>

                                                    <div class="form-group col-6 gc_content" >
                                                        <label for="name">Fecha de nacimiento*:</label>
                                                        <input id="nacimiento" name="nacimiento" type="text" class="form-control"  >
                                                    </div>

                                                    <div class="form-group col-6 gc_content" >
                                                        <label for="name">Sexo*:</label>
                                                        <input id="sexo" name="sexo" type="date" class="form-control"  >
                                                    </div>

                                                    <div class="form-group col-6 gc_content" >
                                                        <label for="name">Estado*:</label>
                                                        <select class="form-select" name="estado" id="estado">
                                                            @foreach ($estados as $estado)
                                                                <option value="{{ $estado }}">{{ $estado }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                    @endif

                                    @if ($ticket->Cursos->imnas == '1' && $ticket->Cursos->titulo_hono == '1')
                                    <div class="gc_cn" style="">

                                        @php
                                            // Datos de ejemplo
                                            $nombreCurso = $ticket->Cursos->nombre;
                                            $idUsuario = $order->User->id;
                                            $numeroAleatorio = rand(100, 999); // Generar un número aleatorio de tres dígitos

                                            // Dividir el nombre del curso en palabras
                                            $palabras = preg_split('/\s+/', $nombreCurso);

                                            // Inicializar una variable para las iniciales del curso
                                            $inicialesCurso = '';

                                            // Recorrer las palabras del nombre del curso y obtener iniciales
                                            foreach ($palabras as $palabra) {
                                                $palabra = preg_replace("/[^a-zA-Z]+/", "", $palabra); // Eliminar caracteres no alfabéticos
                                                $inicialesCurso .= strtoupper(substr($palabra, 0, 1));
                                            }

                                            // Combinar todos los elementos en el código del folio
                                            $folio = $inicialesCurso . $idUsuario . '-' . $numeroAleatorio;

                                        @endphp

                                        <div class="row">

                                            <div class="form-group col-12 gc_cn">
                                                <p>Los campos de (Nombre (s) y Apellidos) <br>son solo obligatorios para generar la credencial  </p>
                                                <p>Link de la pag para remover los fondos de las fotografias <strong><a style="text-decoration:revert " href="https://www.remove.bg/es/upload" target="_blank" >remove.bg/es/upload</a></strong></p>
                                            </div>

                                            <div class="form-group col-6 gc_cn">
                                                <label for="name">Nombre (s)</label>
                                                <input id="nombres" name="nombres" type="text" class="form-control"  >
                                            </div>

                                            <div class="form-group col-6 gc_cn">
                                                <label for="name">Apellido Paterno</label>
                                                <input id="apellido_apeterno" name="apellido_apeterno" type="text" class="form-control"  >
                                            </div>

                                            <div class="form-group col-6 gc_cn">
                                                <label for="name">Apellido Materno</label>
                                                <input id="apellido_materno" name="apellido_materno" type="text" class="form-control"  >
                                            </div>

                                            <div class="form-group col-6 gc_cn">
                                                <label for="name">Folio *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
                                                    </span>
                                                    <input id="folio" name="folio" type="text" class="form-control" value="{{ $folio }}" >
                                                </div>
                                            </div>

                                            <div class="form-group col-6 gc_cn">
                                                <label for="name">Nacionalidad *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img class="img_profile_label" src="{{asset('assets/user/icons/flag.png')}}" alt="" width="30px">
                                                    </span>
                                                    <input id="nacionalidad" name="nacionalidad" type="text" class="form-control" value="Mexicana" >
                                                </div>
                                            </div>

                                            @if ($order->User->Documentos)
                                                @if ($order->User->Documentos->firma !== null)
                                                <div class="form-group col-6 gc_cn">
                                                    <label for="name">Firma Personal *</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img class="img_profile_label" src="{{asset('assets/user/icons/firma-digital.png')}}" alt="" width="30px">
                                                        </span>
                                                        <input id="firma" name="firma" type="file" class="form-control">
                                                    </div>
                                                    @if (pathinfo($order->User->Documentos->firma, PATHINFO_EXTENSION) == 'pdf')
                                                        <a class="text-center text-white btn btn-sm mt-2" href="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->firma) }}" download="{{ $order->User->Documentos->firma }}" style="background: #836262; border-radius: 19px;">
                                                            Descargar Documento
                                                        </a>
                                                    @else
                                                        <div class="input-group">
                                                            <img id="blah" src="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->firma) }}" alt="Imagen" style="width: 100px;height: 100px;">
                                                        </div>
                                                    @endif

                                                </div>

                                                @else
                                                <div class="form-group col-6 gc_cn">
                                                    <label for="name">Firma Personal *</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img class="img_profile_label" src="{{asset('assets/user/icons/firma-digital.png')}}" alt="" width="30px">
                                                        </span>
                                                        <input id="firma" name="firma" type="file" class="form-control">
                                                    </div>
                                                    @if (pathinfo($order->User->Documentos->firma, PATHINFO_EXTENSION) == 'pdf')
                                                        <a class="text-center text-white btn btn-sm mt-2" href="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->firma) }}" download="{{ $order->User->Documentos->firma }}" style="background: #836262; border-radius: 19px;">
                                                            Descargar Documento
                                                        </a>
                                                    @else
                                                        <div class="input-group">
                                                            <img id="blah" src="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->firma) }}" alt="Imagen" style="width: 100px;height: 100px;">
                                                        </div>
                                                    @endif

                                                </div>
                                                @endif
                                            @endif

                                            @if ($order->User->Documentos)
                                                @if ($order->User->Documentos->foto_tam_infantil !== null)

                                                    <div class="form-group col-6 gc_cn">
                                                        <label for="name">Fotografia * ...</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img class="img_profile_label" src="{{asset('assets/user/icons/perfil.png')}}" alt="" width="30px">
                                                            </span>
                                                            <input id="img_infantil" name="img_infantil" type="file" class="form-control"  >
                                                        </div>
                                                        @if (pathinfo($order->User->Documentos->foto_tam_infantil, PATHINFO_EXTENSION) == 'pdf')
                                                            <a class="text-center text-white btn btn-sm mt-2" href="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->foto_tam_infantil) }}" download="{{ $order->User->Documentos->foto_tam_infantil }}" style="background: #836262; border-radius: 19px;">
                                                                Descargar Documento
                                                            </a>
                                                        @else
                                                            <img id="blah" src="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->foto_tam_infantil) }}" alt="Imagen" style="width: 100px;height: 100px;">
                                                        @endif
                                                </div>

                                                @endif
                                            @endif

                                            <div class="form-group col-6 gc_cn">
                                                <label for="name">Curp/generar</label>
                                                <select class="form-select" name="curp_option" id="curp_option">
                                                    <option value="Curp">CURP</option>
                                                    <option value="Generar curp">Generar CURP</option>
                                                </select>
                                            </div>

                                            @if ($order->User->Documentos)
                                                @if ($order->User->Documentos->curp !== null)

                                                <div class="form-group col-12 curp_content">
                                                    <label for="name">CURP(s)*:</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img class="img_profile_label" src="{{asset('assets/user/icons/abc-block.png')}}" alt="" width="30px">
                                                        </span>
                                                        <input id="curp" name="curp" type="text" class="form-control"  >
                                                    </div>
                                                    @if (pathinfo($order->User->Documentos->curp, PATHINFO_EXTENSION) == 'pdf')
                                                        <iframe class="mt-2" src="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->curp)}}" style="width: 100%; height: 350px;"></iframe>
                                                        <p class="text-center">
                                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->curp) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver archivo</a>
                                                        </p>
                                                    @elseif (pathinfo($order->User->Documentos->curp, PATHINFO_EXTENSION) == 'png' || pathinfo($order->User->Documentos->curp, PATHINFO_EXTENSION) == 'jpg' || pathinfo($order->User->Documentos->curp, PATHINFO_EXTENSION) == 'jpeg')
                                                    <p class="text-center mt-2">
                                                        <img id="blah" src="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->curp) }}" alt="Imagen" style="width: 250px;height: 100%;"/><br>
                                                        <a class="text-center text-dark btn btn-sm" href="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->curp) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver Imagen</a>
                                                    </p>
                                                    @endif
                                                </div>
                                                @endif
                                            @endif

                                            <div class="gc_content" style="display: none">
                                                <div class="row">
                                                    <div class="form-group col-6 gc_content" >
                                                        <label for="name">Nombre(s)*:</label>
                                                        <input id="nombre_curp" name="nombre_curp" type="text" class="form-control"  >
                                                    </div>

                                                    <div class="form-group col-6 gc_content" >
                                                        <label for="name">Primer apellido*:</label>
                                                        <input id="primer_apellido" name="primer_apellido" type="text" class="form-control"  >
                                                    </div>

                                                    <div class="form-group col-6 gc_content" >
                                                        <label for="name">Segundo apellido:</label>
                                                        <input id="segundo_apellido" name="segundo_apellido" type="text" class="form-control"  >
                                                    </div>

                                                    <div class="form-group col-6 gc_content" >
                                                        <label for="name">Fecha de nacimiento*:</label>
                                                        <input id="nacimiento" name="nacimiento" type="text" class="form-control"  >
                                                    </div>

                                                    <div class="form-group col-6 gc_content" >
                                                        <label for="name">Sexo*:</label>
                                                        <input id="sexo" name="sexo" type="date" class="form-control"  >
                                                    </div>

                                                    <div class="form-group col-6 gc_content" >
                                                        <label for="name">Estado*:</label>
                                                        <select class="form-select" name="estado" id="estado">
                                                            @foreach ($estados as $estado)
                                                                <option value="{{ $estado }}">{{ $estado }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    @endif

                                    <div class="row">
                                        <div class="form-group col-3 gc_cn">
                                            <label for="name">Tamaño Letra Especialidad TH</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
                                                </span>
                                                <input id="tam_letra_especi" name="tam_letra_especi" type="number" class="form-control" value="40" >
                                            </div>
                                        </div>

                                        <div class="form-group col-3 gc_cn">
                                            <label for="name">Tamaño Letra nombre TH</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
                                                </span>
                                                <input id="tam_letra_nombre" name="tam_letra_nombre" type="number" class="form-control" value="45" >
                                            </div>
                                        </div>

                                        <div class="form-group col-3 gc_cn">
                                            <label for="name">Letra Folio TH</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
                                                </span>
                                                <input id="tam_letra_folio" name="tam_letra_folio" type="number" class="form-control" value="15" >
                                            </div>
                                        </div>

                                        <div class="form-group col-3 gc_cn">
                                            <label for="name">Letra Especialidad Cedula</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
                                                </span>
                                                <input id="tam_letra_espec_cedu" name="tam_letra_espec_cedu" type="number" class="form-control" value="17" >
                                            </div>
                                        </div>

                                        <div class="form-group col-3 gc_cn">
                                            <label for="name">Letra Folio Cedula</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
                                                </span>
                                                <input id="tam_letra_foli_cedu" name="tam_letra_foli_cedu" type="number" class="form-control" value="19" >
                                            </div>
                                        </div>

                                        <div class="form-group col-3 gc_cn">
                                            <label for="name">Letra Folio Trasero Cedula</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
                                                </span>
                                                <input id="tam_letra_foli_cedu_tras" name="tam_letra_foli_cedu_tras" type="number" class="form-control" value="25" >
                                            </div>
                                        </div>

                                        <div class="form-group col-3 gc_cn">
                                            <label for="name">Letra listas materias</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
                                                </span>
                                                <input id="tam_letra_tira_afi" name="tam_letra_tira_afi" type="number" class="form-control" value="26" >
                                            </div>
                                        </div>

                                        <div class="form-group col-3 gc_cn">
                                            <label for="name">Letra credencial especialidad</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
                                                </span>
                                                <input id="tam_letra_esp_cred" name="tam_letra_esp_cred" type="number" class="form-control" value="8" >
                                            </div>
                                        </div>

                                        <div class="form-group col-6">
                                            <label for="name">Capitalizar Nombre *</label>
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img class="img_profile_label" src="{{asset('assets/user/icons/certificate.png')}}" alt="" width="30px">
                                                </span>
                                                <select name="capitalizar" id="capitalizar" class="form-select" >
                                                    <option value="No">Seleciona una opcion</option>
                                                    <option value="Si">Si</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-12">
                                        <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff"> <i class="fa fa-send" title="Ver Orden"></i>Enviar</button>
                                    </div>

                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <div class="tab-pane fade" id="nav-registro-imnas{{$order->User->id }}" role="tabpanel" aria-labelledby="nav-registro-imnas-tab" tabindex="0" style="min-height: auto!important;">
                <div class="modal-body row">
                    <div class="col-6">
                        <p><b>Documento</b></p>
                        <p>1. Cedula</p>
                        <hr style="border-top: 1px solid red">
                        <p>2. Titulo Honorifico</p>
                        <hr style="border-top: 1px solid red">
                        <p>3. Diploma</p>
                        <hr style="border-top: 1px solid red">
                        <p>4. Credencial</p>
                        <hr style="border-top: 1px solid red">
                        <p>5. Tira de materias</p>
                    </div>
                    <div class="col-3">
                        <p><b>Entrega</b></p>
                        <p>
                            @if ($order->estatus_cedula == '1')
                                <img src="{{ asset('assets/user/utilidades/voto.png') }}" alt="" width="30px">
                            @else
                                <img src="{{ asset('assets/user/utilidades/prohibicion.png') }}" alt="" width="30px">
                            @endif
                        </p>
                        <hr style="border-top: 1px solid red">
                        <p>
                            @if ($order->estatus_titulo == '1')
                                <img src="{{ asset('assets/user/utilidades/voto.png') }}" alt="" width="30px">
                            @else
                                <img src="{{ asset('assets/user/utilidades/prohibicion.png') }}" alt="" width="30px">
                            @endif
                        </p>
                        <hr style="border-top: 1px solid red">
                        <p>
                            @if ($order->estatus_diploma == '1')
                                <img src="{{ asset('assets/user/utilidades/voto.png') }}" alt="" width="30px">
                            @else
                                <img src="{{ asset('assets/user/utilidades/prohibicion.png') }}" alt="" width="30px">
                            @endif
                        </p>
                        <hr style="border-top: 1px solid red">
                        <p>
                            @if ($order->estatus_credencial == '1')
                                <img src="{{ asset('assets/user/utilidades/voto.png') }}" alt="" width="30px">
                            @else
                                <img src="{{ asset('assets/user/utilidades/prohibicion.png') }}" alt="" width="30px">
                            @endif
                        </p>
                        <hr style="border-top: 1px solid red">
                        <p>
                            @if ($order->estatus_tira == '1')
                                <img src="{{ asset('assets/user/utilidades/voto.png') }}" alt="" width="30px">
                            @else
                                <img src="{{ asset('assets/user/utilidades/prohibicion.png') }}" alt="" width="30px">
                            @endif
                        </p>

                    </div>
                    <div class="col-3">
                        <form method="POST" action="{{ route('cambiar.estatus_doc', $order->id) }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                                <p><b>¿Realizado?</b></p>
                                    <p>
                                        @if ($order->estatus_cedula == '1')
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="estatus_cedula" name="estatus_cedula" checked>
                                            </div>
                                        @else
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="estatus_cedula" name="estatus_cedula">
                                            </div>
                                        @endif
                                    </p>
                                    <hr style="border-top: 1px solid red">
                                    <p>
                                        @if ($order->estatus_titulo == '1')
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="estatus_titulo_imnas" name="estatus_titulo_imnas" checked>
                                            </div>
                                        @else
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="estatus_titulo_imnas" name="estatus_titulo_imnas">
                                            </div>
                                        @endif
                                    </p>
                                    <hr style="border-top: 1px solid red">
                                    <p>
                                        @if ($order->estatus_diploma == '1')
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="estatus_diploma" name="estatus_diploma" checked>
                                            </div>
                                        @else
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="estatus_diploma" name="estatus_diploma">
                                            </div>
                                        @endif
                                    </p>
                                    <hr style="border-top: 1px solid red">
                                    <p>
                                        @if ($order->estatus_credencial == '1')
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="estatus_credencial" name="estatus_credencial" checked>
                                            </div>
                                        @else
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="estatus_credencial" name="estatus_credencial">
                                            </div>
                                        @endif
                                    </p>
                                    <hr style="border-top: 1px solid red">
                                    <p>
                                        @if ($order->estatus_tira == '1')
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="estatus_tira" name="estatus_tira" checked>
                                            </div>
                                        @else
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="1" id="estatus_tira" name="estatus_tira">
                                            </div>
                                        @endif
                                    </p>

                            <div class="col-12">
                                <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff" title="Guardar Estatus">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

