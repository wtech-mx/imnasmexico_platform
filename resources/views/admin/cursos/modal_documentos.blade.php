<!-- Modal -->
<div class="modal fade" id="modal_documentos" tabindex="-1" aria-labelledby="modal_documentosLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modal_documentosLabel">Generar Diploma y/o Certificacion</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body row">
            @if ($ticket->Cursos->stps == '1')
                <div class="col-12">
                    <h5 class="text-center">Diploma STPS</h5>
                    <p class="text-center">
                        El Diploma esta listo para ser enviado el correo que si tiene guardado es:
                        <strong>{{ $order->User->email }}</strong>
                    </p>
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-sm btn-success">
                            <i class="fa fa-send"></i> Enviar por correo
                        </a>
                    </div>
                </div>
            @endif
            <div class="col-12">
                <form method="POST" action="{{ route('generar.documento') }}" enctype="multipart/form-data" role="form">
                    @csrf
                    <div class="row">

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
                                        @foreach ($tipo_documentos as $item)
                                        <option value="{{ $item->id }}">{{ $item->nombre }}</option>
                                        @endforeach
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
                                <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
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