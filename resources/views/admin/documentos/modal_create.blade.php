<div id="rightPanel" class="right-panel">
    <div class="panel-content">

    <div class="row">
        <div class="col-4">
            <div class="btn btn-warning mt-5 ml-5" onclick="closeRightPanel()" style="margin-left: 2rem">Cerrar</div>
        </div>
        <div class="col-4"></div>
        <div class="col-4"></div>
    </div>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Con Usuario</button>
        </li>

        <li class="nav-item" role="presentation">
          <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Sin Uusario</button>
        </li>
      </ul>

      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
            <div class="row">

                {{-- <form method="POST" class="row" action="{{ route('generar.documento') }}" enctype="multipart/form-data" role="form">
                    @csrf

                        <!-- Campos ocultos para enviar datos adicionales -->
                    <input type="hidden" id="curp_hidden" name="curp">
                    <input type="hidden" id="foto_tam_titulo_hidden" name="foto_tam_titulo">
                    <input type="hidden" id="foto_tam_infantil_hidden" name="foto_tam_infantil">
                    <input type="hidden" id="firma_hidden" name="firma">

                    <div class="col-12">
                        <label for="id_client">Seleccionar Alumno:</label>
                        <select class="form-control cliente" name="id_client" id="id_client">
                            <option selected value="">Buscar Alumno</option>
                            @foreach($clientes as $client)
                                <option value="{{ $client->id }}">{{ $client->name }} / {{ $client->telefono }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-12 mt-3 mb-3">
                        <label for="id_curso">Seleccionar Curso:</label>
                        <select class="form-control cliente" name="id_curso" id="id_curso">
                            <option selected value="">Buscar Curso</option>
                        </select>
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

                    <div class="form-group col-6">
                        <label for="name" class="label_custom_primary_product mb-2">Con Sello STP</label>

                        <div class="input-group d-flex justify-content-around mt-3">
                                <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sello" id="radioSiSelloDoc" value="Si" checked>
                                <label class="form-check-label" for="">Si</label>
                                </div>

                                <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sello" id="radioNoSelloDoc" value="No">
                                <label class="form-check-label" for="">No</label>
                                </div>
                        </div>
                    </div>

                    <div class="form-group col-6 ">
                        <label for="name">Fecha del Curso *</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/fecha-limite.webp')}}" alt="" width="30px">
                            </span>
                            <input id="fecha_curso" name="fecha_curso" type="date" class="form-control" required >
                        </div>
                    </div>

                    <div class="form-group col-6 ">
                        <label for="name">Duracion del curso en horas: </label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/fecha-limite.webp')}}" alt="" width="30px">
                            </span>
                            <input id="duracion_hrs_curso" name="duracion_hrs_curso" type="number" class="form-control" value="48" >
                        </div>
                    </div>

                    <div class="col-6 mt-3 mb-3">
                        <label for="curp_image">CURP:</label> <br>
                        <img id="curp_image" src="" alt="Imagen del curp" style="display:none; width: 250px; height: 100%;" />
                        <iframe id="curp_iframe" src="" style="display:none; width: 100%; height: 350px;"></iframe>
                        <p class="text-center">
                            <a id="curp_link" class="btn btn-sm text-dark" href="" target="_blank" style="display:none; background: {{$configuracion->color_boton_close}}; color: #ffff;"></a>
                        </p>
                    </div>

                    <div class="col-6 mt-3 mb-3">
                        <label for="foto_tam_titulo_image">foto tam titulo:</label> <br>
                        <img id="foto_tam_titulo_image" src="" alt="curp Image" style="display: none; width: 200px; height: auto;">
                    </div>

                    <div class="col-6 mt-3 mb-3">
                        <label for="foto_tam_infantil_image">Foto tam infantil:</label> <br>
                        <img id="foto_tam_infantil_image" src="" alt="INE Image" style="display: none; width: 200px; height: auto;">
                    </div>

                    <div class="col-6 mt-3 mb-3">
                        <label for="firma_image">Firma:</label> <br>
                        <img id="firma_image" src="" alt="INE Image" style="display: none; width: 200px; height: auto;">
                    </div>
                    <div class="form-group col-12">
                        <label for="name" class="label_custom_primary_product mb-2">¿Te gusto el Resultado?</label>
                        <p>Si te gusto el resultado guardalo para la lista de clase y se ponga en estatus de generado (color Verde)</p>

                        <div class="input-group d-flex justify-content-around mt-3">
                                <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sello" id="radioSiSResultadook" value="Si" >
                                <label class="form-check-label" for="">Si</label>
                                </div>

                                <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sello" id="radioNoSResultadook" value="No" checked>
                                <label class="form-check-label" for="">No</label>
                                </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                    </div>

                </form> --}}

            </div>
        </div>

        <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <form method="POST" action="{{ route('generar.documento') }}" enctype="multipart/form-data" role="form">
                @csrf
                <div class="row">

                        <div class="form-group col-12 mt-3">
                            <label for="name">Nombre Completo *</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <img class="img_profile_label" src="{{asset('assets/user/icons/mujer.png')}}" alt="" width="30px">
                                </span>
                                <input id="nombre" name="nombre" oninput="splitFullName()" type="text" class="form-control" required >
                            </div>
                        </div>

                        <div class="form-group col-6 ">
                            <label for="name">Curso *</label>
                            <div class="input-group">
                                <select name="curso" id="curso" class="form-select curso" onchange="generarFolio()">
                                    <option value="">Selecionar opcion</option>
                                    @foreach ($cursosArray as $nombre)
                                    <option value="{{ $nombre }}">{{ $nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="name" class="label_custom_primary_product mb-2">Escribir Manualmente</label>

                            <div class="input-group d-flex justify-content-around mt-3">
                                    <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radioSiMayo" value="Si">
                                    <label class="form-check-label" for="">Si</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="radioNoMayo" value="No" checked>
                                    <label class="form-check-label" for="">No</label>
                                    </div>
                            </div>
                        </div>

                        <div class="form-group col-12" id="precioMayoristaContainer" style="display: none;">
                            <label for="name" class="label_custom_primary_product mb-2">Nombre del curso:</label>
                            <div class="input-group ">
                                <span class="input-group-text span_custom_tab" >
                                    <img class="img_profile_label" src="{{asset('assets/user/icons/aprender-en-linea.webp')}}" alt="" width="30px">
                                </span>
                                <input id="curso_name" name="curso_name" type="text"  class="form-control input_custom_tab">
                            </div>
                        </div>

                        <div class="form-group col-6">
                            <label for="name" class="label_custom_primary_product mb-2">Con Sello STP</label>

                            <div class="input-group d-flex justify-content-around mt-3">
                                    <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sello" id="radioSiSello" value="Si" checked>
                                    <label class="form-check-label" for="">Si</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sello" id="radioNoSello" value="No">
                                    <label class="form-check-label" for="">No</label>
                                    </div>
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

                        <div class="form-group col-6 ">
                            <label for="name">Duracion del curso en horas: </label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <img class="img_profile_label" src="{{asset('assets/user/icons/fecha-limite.webp')}}" alt="" width="30px">
                                </span>
                                <input id="duracion_hrs" name="duracion_hrs" type="number" class="form-control" value="48" >
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
                                    <p>Los campos de (Nombre (s) y Apellidos) <br>son solo <strong>obligatorios</strong> para generar la <strong>credencial</strong></p>
                                    <p>Link de la pag para remover los fondos de las fotografias <strong><a style="text-decoration:revert " href="https://www.remove.bg/es/upload" target="_blank" >remove.bg/es/upload</a></strong></p>
                                </div>

                                <div class="form-group col-6 gc_cn">
                                    <label for="name">Nombre (s)</label>
                                    <input id="nombres" name="nombres" type="text" class="form-control"  >
                                </div>

                                <div class="form-group col-6 gc_cn">
                                    <label for="name">Apellido Paterno</label>
                                    <input id="apellido_paterno" name="apellido_apeterno" type="text" class="form-control"  >
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
                                        <input id="folio" name="folio" type="text" class="form-control">
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
                                <div class="col-6"></div>

                                <div class="form-group col-6 gc_cn">
                                    <label for="name">Firma Personal *</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img class="img_profile_label" src="{{asset('assets/user/icons/firma-digital.png')}}" alt="" width="30px">
                                        </span>
                                        <input id="firma" name="firma" type="file" class="form-control" onchange="mostrarImagenFirma(this)" >
                                    </div>
                                </div>

                                <div class="col-6 mb-2">
                                    <img id="imagen_seleccionada_firma" style="display: none; max-width: 200px; max-height: 200px;">
                                </div>

                                <div class="form-group col-6 gc_cn">
                                    <label for="name">Fotografia *</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img class="img_profile_label" src="{{asset('assets/user/icons/perfil.png')}}" alt="" width="30px">
                                        </span>
                                        <input id="img_infantil" name="img_infantil" type="file" class="form-control"  onchange="mostrarImagen(this)">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <img id="imagen_seleccionada" style="display: none; max-width: 200px; max-height: 200px;">
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
