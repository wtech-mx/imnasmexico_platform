<!-- Modal -->
<div class="modal fade" id="modal_documentos_{{ $order->User->id }}" tabindex="-1" aria-labelledby="modal_documentosLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modal_documentosLabel">Generar Diploma y/o Certificacion</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body row">

                <div class="col-12">
                    @if ($ticket->Cursos->stps == '1')
                    <h5 class="text-center">Diploma STPS</h5>
                    @endif
                    <p class="text-center">
                        El Diploma esta listo para ser enviado el correo que si tiene guardado es:
                        <strong>{{ $order->User->email }}</strong>
                    </p>
                </div>

            <div class="col-12">
                <form method="POST" action="{{ route('generar_enviar.documento') }}" enctype="multipart/form-data" role="form">
                    @csrf
                    <input type="hidden" name="email" id="email" value="{{ $order->User->email }}">

                    <div class="row">
                            <input id="id_curso" name="id_curso" type="text" class="form-control" value="{{ $ticket->Cursos->id }}" style="display: none" >
                            <input id="id_ticket" name="id_ticket" type="text" class="form-control" value="{{ $ticket->id }}" style="display: none" >
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
                                        @if ($ticket->Cursos->stps == '1')
                                            <option value="1">Diploma STPS General</option>
                                        @endif
                                        @if ($ticket->Cursos->imnas == '1' && $ticket->Cursos->titulo_hono == NULL)
                                            <option value="2">RN-Cedula de identidad de papel General</option>
                                            <option value="3">RN - Titulo Honorifico Generico QRS</option>
                                            <option value="4">RN - Diploma Imnas</option>
                                            <option value="5">RN - Credencial General</option>
                                            <option value="13">Titulo Honorifico Online Qr Logo</option>

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
                                        @endif
                                        @if ($ticket->Cursos->imnas == '1' && $ticket->Cursos->titulo_hono == '1')
                                            <option value="13">Titulo Honorifico Online Qr Logo</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="gc_cn" style="display: none">
                                <div class="row">

                                    <div class="form-group col-12 gc_cn">
                                        <p>Los campos de (Nombre (s) y Apellidos) <br>son solo obligatorios para generar la credencial</p>
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
                                            <input id="folio" name="folio" type="text" class="form-control" value="CEA00152" >
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
                                        <label for="name">Firma Personal *</label>
                                        @if ($order->User->Documentos)
                                            @if ($order->User->Documentos->firma !== null)
                                                <div class="input-group">
                                                    <img id="blah" src="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->firma) }}" alt="Imagen" style="width: 60px;height: 60%;">
                                                </div>
                                            @endif
                                        @else
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img class="img_profile_label" src="{{asset('assets/user/icons/firma-digital.png')}}" alt="" width="30px">
                                                </span>
                                                <input id="firma" name="firma" type="file" class="form-control">
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group col-6 gc_cn">
                                        <label for="name">Fotografia *</label>
                                        @if ($order->User->Documentos)
                                            @if ($order->User->Documentos->foto_tam_infantil !== null)
                                                <div class="input-group">
                                                    <img id="blah" src="{{asset('documentos/'. $order->User->telefono . '/' .$order->User->Documentos->foto_tam_infantil) }}" alt="Imagen" style="width: 60px;height: 60%;">
                                                </div>
                                            @endif
                                        @else
                                            <div class="input-group">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img class="img_profile_label" src="{{asset('assets/user/icons/perfil.png')}}" alt="" width="30px">
                                                </span>
                                                <input id="foto_tam_infantil" name="foto_tam_infantil" type="file" class="form-control"  >
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group col-6 gc_cn">
                                        <label for="name">Curp/generar</label>
                                        <select class="form-select" name="curp_option" id="curp_option">
                                            <option value="Curp">CURP</option>
                                            <option value="Generar curp">Generar CURP</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-12 curp_content">
                                        <label for="name">CURP(s)*:</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="basic-addon1">
                                                <img class="img_profile_label" src="{{asset('assets/user/icons/abc-block.png')}}" alt="" width="30px">
                                            </span>
                                            <input id="curp" name="curp" type="text" class="form-control"  >
                                        </div>
                                    </div>

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

                            <div class="col-12">
                                <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff"> <i class="fa fa-send" title="Ver Orden"></i>Enviar</button>
                            </div>

                    </div>
                </form>
            </div>

        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
