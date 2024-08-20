<!-- Modal -->
<div class="modal fade" id="modal_imnas_documentos_{{ $registro_imnas->id }}" tabindex="-1" aria-labelledby="modal_documentosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modal_documentosLabel">Generar Diploma y/o Certificacion</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <nav class="mt-3">
            <div class="d-flex justify-content-center">
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-emitir-imnas-tab" data-bs-toggle="tab" data-bs-target="#nav-emitir-imnas{{$registro_imnas->id }}" type="button" role="tab" aria-controls="nav-emitir-imnas{{$registro_imnas->id }}" aria-selected="true">
                        Emision
                    </button>

                    <button class="nav-link" id="nav-registro-imnas-tab" data-bs-toggle="tab" data-bs-target="#nav-registro-imnas{{$registro_imnas->id }}" type="button" role="tab" aria-controls="nav-registro-imnas{{$registro_imnas->id }}" aria-selected="false">
                        Estatus
                    </button>
                </div>
            </div>
        </nav>

        <div class="tab-content" id="nav-tabContent" style="">
            <div class="tab-pane fade show active" id="nav-emitir-imnas{{$registro_imnas->id }}" role="tabpanel" aria-labelledby="nav-emitir-imnas-tab" tabindex="0" style="min-height: auto!important;">
                <div class="modal-body row">

                    <div class="col-12">
                        <form method="POST" action="{{ route('generar_registro.documento') }}" enctype="multipart/form-data" role="form">
                            @csrf

                            <input type="hidden" name="email" id="email" value="{{ $registro_imnas->User->email }}">
                            <input type="hidden" name="id_registro" id="id_registro" value="{{ $registro_imnas->id }}">

                            <div class="row">
                                    <input id="id_order" name="id_order" type="text" class="form-control" value="{{ $registro_imnas->id_order }}" style="display: none">
                                    <input id="id_usuario" name="id_usuario" type="text" class="form-control" value="{{ $registro_imnas->id_usuario }}" style="display: none" >

                                    <div class="form-group col-12 mt-3">
                                        <label for="name">Nombre Completo *</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img class="img_profile_label" src="{{asset('assets/user/icons/mujer.png')}}" alt="" width="30px">
                                            </span>
                                            <input id="nombre" name="nombre" type="text" class="form-control" value="{{ $registro_imnas->nombre }}" >
                                        </div>
                                    </div>

                                    <div class="form-group col-12 ">
                                        <label for="name">Curso *</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img class="img_profile_label" src="{{asset('assets/user/icons/aprender-en-linea.webp')}}" alt="" width="30px">
                                            </span>
                                            <input id="curso" name="curso" type="text" class="form-control" value="{{ $registro_imnas->nom_curso }}" >
                                        </div>
                                    </div>

                                    <div class="form-group col-6 ">
                                        <label for="name">Fecha del Curso *</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img class="img_profile_label" src="{{asset('assets/user/icons/fecha-limite.webp')}}" alt="" width="30px">
                                            </span>
                                            <input id="fecha" name="fecha" type="text" class="form-control" value="{{ $registro_imnas->fecha_curso }}" readonly >
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
                                                    <option value="18">CN - Tira materias Afiliados</option>
                                                    <option value="6">CN - Tira de materias aparatologia</option>
                                                    <option value="7">CN - Tira de materias alasiados progresivos</option>
                                                    <option value="8">CN - Tira de materias cosmetologia facial y corporal</option>
                                                    <option value="9">CN - Tira de materias cosmiatria estetica avanzada</option>
                                                    <option value="10">CN - Tira de materias auxiliar en cuidados de atencion medica</option>
                                                    <option value="11">CN - Tira de materias masoterapia</option>
                                                    <option value="12">CN - Tira de materias Cosmetologia</option>
                                            </select>
                                        </div>
                                    </div>
                                    @php
                                        // Datos de ejemplo
                                        $nombreCurso = $registro_imnas->nom_curso;
                                        $nombreCliente = $registro_imnas->nombre;
                                        $idUsuario = $cliente->id;
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


                                        // Dividir el nombre del cliente en palabras
                                        $palabras = preg_split('/\s+/', $nombreCliente);

                                        // Inicializar una variable para las iniciales del cliente
                                        $inicialesCliente = '';

                                        // Recorrer las palabras del nombre del cliente y obtener iniciales
                                        foreach ($palabras as $palabra) {
                                            $palabra = preg_replace("/[^a-zA-Z]+/", "", $palabra); // Eliminar caracteres no alfabéticos
                                            $inicialesCliente .= strtoupper(substr($palabra, 0, 1));
                                        }

                                        // Combinar todos los elementos en el código del folio
                                        $folio = $inicialesCurso . $inicialesCliente .'-' . $registro_imnas->id_order;

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

                                            <div class="form-group col-6 gc_cn">
                                                <label for="name">INE *</label>
                                                @if (pathinfo($registro_imnas->ine, PATHINFO_EXTENSION) == 'pdf')
                                                    <a class="text-center text-white btn btn-sm mt-2" href="{{asset('documentos_registro/'. $registro_imnas->User->telefono . '/' .$registro_imnas->ine) }}" download="{{ $registro_imnas->ine }}" style="background: #836262; border-radius: 19px;">
                                                        Descargar Documento
                                                    </a>
                                                @else
                                                    <div class="input-group">
                                                        <img id="blah" src="{{asset('documentos_registro/'. $registro_imnas->User->telefono . '/' .$registro_imnas->ine) }}" alt="Imagen" style="width: 100px;height: 100px;">
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="form-group col-6 gc_cn">
                                                <label for="name">Firma Personal *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img class="img_profile_label" src="{{asset('assets/user/icons/firma-digital.png')}}" alt="" width="30px">
                                                    </span>
                                                    <input id="firma" name="firma" type="file" class="form-control">
                                                </div>
                                                @if (pathinfo($registro_imnas->firma, PATHINFO_EXTENSION) == 'pdf')
                                                    <a class="text-center text-white btn btn-sm mt-2" href="{{asset('documentos_registro/'. $registro_imnas->User->telefono . '/' .$registro_imnas->firma) }}" download="{{ $registro_imnas->firma }}" style="background: #836262; border-radius: 19px;">
                                                        Descargar Documento
                                                    </a>
                                                @else
                                                    <div class="input-group">
                                                        <img id="blah" src="{{asset('documentos_registro/'. $registro_imnas->User->telefono . '/' .$registro_imnas->firma) }}" alt="Imagen" style="width: 100px;height: 100px;">
                                                    </div>
                                                @endif
                                            </div>


                                            <div class="form-group col-6 gc_cn">
                                                <label for="name">Fotografia *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img class="img_profile_label" src="{{asset('assets/user/icons/perfil.png')}}" alt="" width="30px">
                                                    </span>
                                                    <input id="img_infantil" name="img_infantil" type="file" class="form-control"  >
                                                </div>
                                                @if (pathinfo($registro_imnas->foto_cuadrada, PATHINFO_EXTENSION) == 'pdf')
                                                    <a class="text-center text-white btn btn-sm mt-2" href="{{asset('documentos_registro/'. $registro_imnas->User->telefono . '/' .$registro_imnas->foto_cuadrada) }}" download="{{ $registro_imnas->foto_cuadrada }}" style="background: #836262; border-radius: 19px;">
                                                        Descargar Documento
                                                    </a>
                                                @else
                                                    <img id="blah" src="{{asset('documentos_registro/'. $registro_imnas->User->telefono . '/' .$registro_imnas->foto_cuadrada) }}" alt="Imagen" style="width: 100px;height: 100px;">
                                                @endif
                                            </div>

                                            <div class="form-group col-6 gc_cn">
                                                <label for="name">Logo *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img class="img_profile_label" src="{{asset('assets/user/icons/perfil.png')}}" alt="" width="30px">
                                                    </span>
                                                    <input id="logo" name="logo" type="file" class="form-control"  >
                                                </div>
                                                @if (pathinfo($registro_imnas->User->logo, PATHINFO_EXTENSION) == 'pdf')
                                                    <a class="text-center text-white btn btn-sm mt-2" href="{{asset('documentos/'. $registro_imnas->User->telefono . '/' .$registro_imnas->User->logo) }}" download="{{ $registro_imnas->User->logo }}" style="background: #836262; border-radius: 19px;">
                                                        Descargar Documento
                                                    </a>
                                                @else
                                                    <img id="blah" src="{{asset('documentos/'. $registro_imnas->User->telefono . '/' .$registro_imnas->User->logo) }}" alt="Imagen" style="width: 100px;height: 100px;">
                                                @endif
                                            </div>

                                            <div class="form-group col-6 gc_cn">
                                                <label for="name">Firma de la director@*</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img class="img_profile_label" src="{{asset('assets/user/icons/perfil.png')}}" alt="" width="30px">
                                                    </span>
                                                    <input id="firma_director" name="firma_director" type="file" class="form-control"  >
                                                </div>
                                                @if ($registro_imnas->User->RegistroImnasEscuela)
                                                    @if (pathinfo($registro_imnas->User->RegistroImnasEscuela->firma, PATHINFO_EXTENSION) == 'pdf')
                                                        <a class="text-center text-white btn btn-sm mt-2" href="{{asset('documentos/'. $registro_imnas->User->telefono . '/' .$registro_imnas->User->RegistroImnasEscuela->firma) }}" download="{{ $registro_imnas->User->RegistroImnasEscuela->firma }}" style="background: #836262; border-radius: 19px;">
                                                            Descargar Documento
                                                        </a>
                                                    @else
                                                        <img id="blah" src="{{asset('documentos/'. $registro_imnas->User->telefono . '/' .$registro_imnas->User->RegistroImnasEscuela->firma) }}" alt="Imagen" style="width: 200px;height: 150px;">
                                                    @endif
                                                @else
                                                    <p>No hay documentos disponibles para este usuario.</p>
                                                @endif
                                            </div>

                                            <div class="form-group col-6 curp_content">
                                                <label for="name">CURP *:</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img class="img_profile_label" src="{{asset('assets/user/icons/abc-block.png')}}" alt="" width="30px">
                                                    </span>
                                                    <input id="curp" name="curp" type="text" class="form-control"  >
                                                </div>
                                                @if (pathinfo($registro_imnas->curp, PATHINFO_EXTENSION) == 'pdf')
                                                    <iframe class="mt-2" src="{{asset('documentos_registro/'. $registro_imnas->User->telefono . '/' .$registro_imnas->curp)}}" style="width: 100%; height: 350px;"></iframe>
                                                    <p class="text-center">
                                                        <a class="btn btn-sm text-dark" href="{{asset('documentos_registro/'. $registro_imnas->User->telefono . '/' .$registro_imnas->curp) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver archivo</a>
                                                    </p>
                                                @elseif (pathinfo($registro_imnas->curp, PATHINFO_EXTENSION) == 'png' || pathinfo($registro_imnas->curp, PATHINFO_EXTENSION) == 'jpg' || pathinfo($registro_imnas->curp, PATHINFO_EXTENSION) == 'jpeg')
                                                    <p class="text-center mt-2">
                                                        <img id="blah" src="{{asset('documentos_registro/'. $registro_imnas->User->telefono . '/' .$registro_imnas->curp) }}" alt="Imagen" style="width: 250px;height: 100%;"/><br>
                                                        <a class="text-center text-dark btn btn-sm" href="{{asset('documentos_registro/'. $registro_imnas->User->telefono . '/' .$registro_imnas->curp) }}" target="_blank" style="background: {{$configuracion->color_boton_close}}; color: #ffff">Ver Imagen</a>
                                                    </p>
                                                @endif

                                            </div>

                                    </div>


                                    <div class="col-12">
                                        <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff"> <i class="fa fa-send" title="Ver Orden"></i>Crear</button>
                                    </div>

                            </div>
                        </form>
                    </div>

                </div>
            </div>

            <div class="tab-pane fade" id="nav-registro-imnas{{$registro_imnas->id }}" role="tabpanel" aria-labelledby="nav-registro-imnas-tab" tabindex="0" style="min-height: auto!important;">
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
                            @if ($registro_imnas->estatus_cedula == '1')
                                <img src="{{ asset('assets/user/utilidades/voto.png') }}" alt="" width="30px">
                            @else
                                <img src="{{ asset('assets/user/utilidades/prohibicion.png') }}" alt="" width="30px">
                            @endif
                        </p>
                        <hr style="border-top: 1px solid red">
                        <p>
                            @if ($registro_imnas->estatus_titulo == '1')
                                <img src="{{ asset('assets/user/utilidades/voto.png') }}" alt="" width="30px">
                            @else
                                <img src="{{ asset('assets/user/utilidades/prohibicion.png') }}" alt="" width="30px">
                            @endif
                        </p>
                        <hr style="border-top: 1px solid red">
                        <p>
                            @if ($registro_imnas->estatus_diploma == '1')
                                <img src="{{ asset('assets/user/utilidades/voto.png') }}" alt="" width="30px">
                            @else
                                <img src="{{ asset('assets/user/utilidades/prohibicion.png') }}" alt="" width="30px">
                            @endif
                        </p>
                        <hr style="border-top: 1px solid red">
                        <p>
                            @if ($registro_imnas->estatus_credencial == '1')
                                <img src="{{ asset('assets/user/utilidades/voto.png') }}" alt="" width="30px">
                            @else
                                <img src="{{ asset('assets/user/utilidades/prohibicion.png') }}" alt="" width="30px">
                            @endif
                        </p>
                        <hr style="border-top: 1px solid red">
                        <p>
                            @if ($registro_imnas->estatus_tira == '1')
                                <img src="{{ asset('assets/user/utilidades/voto.png') }}" alt="" width="30px">
                            @else
                                <img src="{{ asset('assets/user/utilidades/prohibicion.png') }}" alt="" width="30px">
                            @endif
                        </p>

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

