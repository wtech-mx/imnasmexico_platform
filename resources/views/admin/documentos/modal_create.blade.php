<!-- Modal -->
<div class="modal fade" id="create_manual" tabindex="-1" role="dialog" aria-labelledby="create_manual" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="create_manual">Generar documento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>

                <div class="modal-body row">

                        <div class="d-flex justify-content-center">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="usuario-tab" data-bs-toggle="tab" data-bs-target="#usuario" type="button" role="tab" aria-controls="usuario" aria-selected="true">Con usuario</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                <button class="nav-link" id="sin_usuario-tab" data-bs-toggle="tab" data-bs-target="#sin_usuario" type="button" role="tab" aria-controls="sin_usuario" aria-selected="false">Sin usario</button>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="usuario" role="tabpanel" aria-labelledby="usuario-tab">
                               <div class="row">
                                    <label for="name">Alumno</label>
                                    <select name="id_usuario" id="usuarioSelect" class="form-select">
                                        @foreach ($alumnos as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>

                                    <label for="name">Cursos</label>
                                    <select id="ordenesSelect" disabled>
                                        <option value="">Selecciona una orden</option>
                                        <!-- Opciones de órdenes aquí -->
                                    </select>
                               </div>
                            </div>

                            <div class="tab-pane fade" id="sin_usuario" role="tabpanel" aria-labelledby="sin_usuario-tab">
                                <form method="POST" action="{{ route('generar.documento') }}" enctype="multipart/form-data" role="form">
                                    @csrf
                                    <div class="row">

                                            <div class="form-group col-12 mt-3">
                                                <label for="name">Nombre Completo *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img class="img_profile_label" src="{{asset('assets/user/icons/mujer.png')}}" alt="" width="30px">
                                                    </span>
                                                    <input id="nombre" name="nombre" type="text" class="form-control" required >
                                                </div>
                                            </div>

                                            <div class="form-group col-6 ">
                                                <label for="name">Curso *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img class="img_profile_label" src="{{asset('assets/user/icons/aprender-en-linea.webp')}}" alt="" width="30px">
                                                    </span>
                                                    <select name="curso" id="curso" class="form-select">
                                                        @foreach ($cursosArray as $nombre)
                                                        <option value="{{ $nombre }}">{{ $nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-6 ">
                                                <label for="name">Fecha del Curso *</label>
                                                <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <img class="img_profile_label" src="{{asset('assets/user/icons/fecha-limite.webp')}}" alt="" width="30px">
                                                    </span>
                                                    <input id="fecha" name="fecha" type="date" class="form-control" required >
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
                                                            <input id="folio" name="folio" type="text" class="form-control"  >
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-6 gc_cn">
                                                        <label for="name">Firma Personal *</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img class="img_profile_label" src="{{asset('assets/user/icons/firma-digital.png')}}" alt="" width="30px">
                                                            </span>
                                                            <input id="firma" name="firma" type="file" class="form-control"  >
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-6 gc_cn">
                                                        <label for="name">Fotografia *</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img class="img_profile_label" src="{{asset('assets/user/icons/perfil.png')}}" alt="" width="30px">
                                                            </span>
                                                            <input id="img_infantil" name="img_infantil" type="file" class="form-control"  >
                                                        </div>
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
                                                        <input id="curp" name="curp" type="text" class="form-control"  >
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
                </div>



        </div>
    </div>
</div>
