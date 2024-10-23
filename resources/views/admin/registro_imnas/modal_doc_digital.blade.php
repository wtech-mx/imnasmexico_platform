<!-- Modal -->
<div class="modal fade" id="DocDigital_{{ $registro_imnas->id }}" tabindex="-1" aria-labelledby="DocDigitalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="DocDigitalLabel">{{ $registro_imnas->nombre }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
            <form method="POST" action="{{ route('update.docDigital', $registro_imnas->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">

                <div class="row">
                    <div class="form-group col-3 gc_cn">
                        <label for="name">Tamaño Letra Especialidad TH</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
                            </span>
                            <input id="tam_letra_especialidad_th" name="tam_letra_especialidad_th" type="number" class="form-control" placeholder="40" value="{{ $registro_imnas->tam_letra_especialidad_th }}" >
                        </div>
                    </div>

                    <div class="form-group col-3 gc_cn">
                        <label for="name">Tamaño Letra nombre TH</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
                            </span>
                            <input id="tam_letra_nombre_th" name="tam_letra_nombre_th" type="number" class="form-control" placeholder="45" value="{{ $registro_imnas->tam_letra_nombre_th }}" >
                        </div>
                    </div>

                    <div class="form-group col-3 gc_cn">
                        <label for="name">Letra Folio TH</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
                            </span>
                            <input id="tam_letra_folio_th" name="tam_letra_folio_th" type="number" class="form-control" placeholder="15" value="{{ $registro_imnas->tam_letra_folio_th }}" >
                        </div>
                    </div>

                    <div class="form-group col-3 gc_cn">
                        <label for="name">Letra Especialidad Cedula</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
                            </span>
                            <input id="tam_letra_especialidad_cedula" name="tam_letra_especialidad_cedula" type="number" class="form-control" placeholder="17" value="{{ $registro_imnas->tam_letra_especialidad_cedula }}" >
                        </div>
                    </div>

                    <div class="form-group col-3 gc_cn">
                        <label for="name">Letra Folio Cedula</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
                            </span>
                            <input id="tam_letra_folio_cedula" name="tam_letra_folio_cedula" type="number" class="form-control" placeholder="19" value="{{ $registro_imnas->tam_letra_folio_cedula }}" >
                        </div>
                    </div>

                    <div class="form-group col-3 gc_cn">
                        <label for="name">Letra Folio Trasero Cedula</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
                            </span>
                            <input id="tam_letra_folioTrasero_cedula" name="tam_letra_folioTrasero_cedula" type="number" class="form-control" placeholder="25" value="{{ $registro_imnas->tam_letra_folioTrasero_cedula }}" >
                        </div>
                    </div>

                    <div class="form-group col-3 gc_cn">
                        <label for="name">Letra listas materias</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
                            </span>
                            <input id="tam_letra_lista_tira_materias" name="tam_letra_lista_tira_materias" type="number" class="form-control" placeholder="26" value="{{ $registro_imnas->tam_letra_lista_tira_materias }}" >
                        </div>
                    </div>

                    <div class="form-group col-3 gc_cn">
                        <label for="name">Letra credencial especialidad</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
                            </span>
                            <input id="tam_letra_credencial_especialidad" name="tam_letra_credencial_especialidad" type="number" class="form-control" placeholder="8" value="{{ $registro_imnas->tam_letra_credencial_especialidad }}" >
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Capitalizar Nombre *</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/certificate.png')}}" alt="" width="30px">
                            </span>
                            <select name="capitalizar_nombre" id="capitalizar_nombre" class="form-select" required >
                                <option value="{{ $registro_imnas->capitalizar_nombre }}">{{ $registro_imnas->capitalizar_nombre }}</option>
                                <option value="Si">Si</option>
                                <option value="No">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Director o Direcotora</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/certificate.png')}}" alt="" width="30px" >
                            </span>
                            <select name="texto_director" id="texto_director" class="form-select" required>
                                <option value="{{ $registro_imnas->texto_director }}">{{ $registro_imnas->texto_director }}</option>
                                <option value="Firma del Director">Firma del Director</option>
                                <option value="Firma de la Directora">Firma la Directora</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-6">
                        <label for="name">¿Quieres poner la firma del Director?</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/certificate.png')}}" alt="" width="30px" >
                            </span>
                            <select name="firma_director" id="firma_director" class="form-select" required>
                                <option value="{{ $registro_imnas->firma_director }}">{{ $registro_imnas->firma_director }}</option>
                                <option value="si">Si</option>
                                <option value="no">No</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group col-6 gc_cn">
                        <label for="name">Promedio</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/cuaderno.webp')}}" alt="" width="30px">
                            </span>
                            <input  name="promedio" type="text" class="form-control" placeholder="9.5" value="{{ $registro_imnas->promedio }}" >
                        </div>
                    </div>

                    <div class="form-group col-6 ">
                        <label for="name">Fecha del Curso *</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/fecha-limite.webp')}}" alt="" width="30px">
                            </span>
                            <input id="fecha" name="fecha" type="date" class="form-control" value="{{ $registro_imnas->fecha_curso }}"  >
                        </div>
                    </div>

                    <div class="form-group col-12 gc_cn">
                        <label for="name">CURP</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <img class="img_profile_label" src="{{asset('assets/user/icons/abc-block.png')}}" alt="" width="30px">
                            </span>
                            <input id="curp" name="curp" type="text" class="form-control" value="{{ $registro_imnas->curp_escrito }}" >
                        </div>
                    </div>

                    <div class="form-group col-12 my-auto">
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>

                </div>
            </form>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          {{-- <a href="https://plataforma.imnasmexico.com/buscador/folio?folio='.{{ $registro_imnas->folio }}" class="btn btn-dark">Ver Documetno Digital</a> --}}
         <a target="_blank" href="{{ route('folio.buscador', 'folio='.$registro_imnas->folio) }}" class="btn btn-dark">Ver Doc Digital</a>

        </div>
      </div>
    </div>
  </div>
