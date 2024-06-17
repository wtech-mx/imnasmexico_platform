<!-- Modal -->
<div class="modal fade" id="manual_update_{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="manual_update_{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manual_update_{{ $item->id }}">Crear Documento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form method="POST" action="{{ route('documentos.update', $item->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body row">

                    <div class="form-group col-12">
                        <label for="name">Nombre</label>
                        <input id="nombre" name="nombre" type="text" class="form-control" required value="{{ $item->nombre }}">
                    </div>

                    <div class="form-group col-12">
                        <label for="name">Tipo</label>
                        <select name="tipo" id="tipo" class="form-select">
                            <option value="{{ $item->tipo }}">{{ $item->tipo }}</option>
                            <option value="Cedula de indetidad">CN - Cedula de identidad papel</option>
                            <option value="Credencial">CN - Credencial plastico</option>
                            <option value="Diploma">CN - Diploma</option>
                            <option value="Titulo Honorifico con QR">CN - Titulo Honorifico con QR</option>
                            <option value="Titulo Honorifico con QR">CN - Titulo Honorifico CFC</option>
                            <option value="Tira de materias">CN - Tira de materias</option>
                            <option value="Diploma_STPS">Diploma - STPS</option>
                            <option value="Titulo Honorifico Nuevo">Titulo Honorifico Nuevo</option>
                        </select>
                    </div>

                    @if($item->tipo == 'Cedula de indetidad')
                        <div class="form-group col-6">
                            <label for="name">Logo Cedula</label>
                            <input type="file" name="logo_cp" id="logo_cp" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->logo_cp) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Logo otra instirucion</label>
                            <input type="file" name="logo_otra_institucion_cp"  class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->logo_otra_institucion_cp) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">leyenda1_cp</label>
                            <input type="text" name="leyenda1_cp"  class="form-control" value="{{ $item->leyenda1_cp }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">fecha_expedicion_cp</label>
                            <input type="text" name="fecha_expedicion_cp"  class="form-control" value="{{ $item->fecha_expedicion_cp }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">leyenda2_cp</label>
                            <input type="text" name="leyenda2_cp"  class="form-control" value="{{ $item->leyenda2_cp }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">firma1_cp</label>
                            <input type="file" name="firma1_cp" id="firma1_cp" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->firma1_cp) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">firma2_cp</label>
                            <input type="file" name="firma2_cp" id="firma2_cp" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->firma2_cp) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">img_izq_cp</label>
                            <input type="file" name="img_izq_cp" id="img_izq_cp" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->img_izq_cp) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">img_der_cp</label>
                            <input type="file" name="img_der_cp" id="img_der_cp" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->img_der_cp) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">tipo_vigencia_cp</label>
                            <input type="text" name="tipo_vigencia_cp"  class="form-control" value="{{ $item->tipo_vigencia_cp }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">tipo_vigencia_abrev_cp</label>
                            <input type="text" name="tipo_vigencia_abrev_cp"  class="form-control" value="{{ $item->tipo_vigencia_abrev_cp }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">aviso_privacidad_cp</label>
                            <textarea class="form-control" name="aviso_privacidad_cp" id="" cols="30" rows="10">{{ $item->aviso_privacidad_cp }}</textarea>
                        </div>

                        <div class="form-group col-6">
                            <label for="name">leyenda_auth_qr_cp</label>
                            <input type="text" name="leyenda_auth_qr_cp"  class="form-control" value="{{ $item->leyenda_auth_qr_cp }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">QR</label>
                            <input type="file" name="qr_cp"  class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->qr_cp) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">fondo_cp</label>
                            <input type="file" name="fondo_cp"  class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->fondo_cp) }}" alt="Imagen" style="width:300px;">
                        </div>

                    @endif

                    @if($item->tipo == 'Diploma')
                        <div class="form-group col-6">
                            <label for="name">Logo Registro</label>
                            <input type="file" name="logo_registro_dip" id="logo_registro_dip" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->logo_registro_dip) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Logo otra instirucion</label>
                            <input type="file" name="logo_otra_institucion_dip"  class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->logo_otra_institucion_dip) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Logo IMNAS</label>
                            <input type="file" name="logo_imnas_dip"  class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->logo_imnas_dip) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Titulo</label>
                            <input type="text" name="titulo_dip"  class="form-control" value="{{ $item->titulo_dip }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Subtitulo</label>
                            <input type="text" name="subtitulo_dip"  class="form-control" value="{{ $item->subtitulo_dip }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda 1</label>
                            <input type="text" name="leyenda1_dip"  class="form-control" value="{{ $item->leyenda1_dip }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Otorga</label>
                            <input type="text" name="otorga_dip"  class="form-control" value="{{ $item->otorga_dip }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Nombramiento</label>
                            <input type="text" name="nombramiento_dip"  class="form-control" value="{{ $item->nombramiento_dip }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda 2</label>
                            <input type="text" name="leyenda2_dip"  class="form-control" value="{{ $item->leyenda2_dip }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Horas</label>
                            <input type="text" name="horas_dip"  class="form-control" value="{{ $item->horas_dip }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Tipo Vigencia</label>
                            <input type="text" name="tipo_vigencia_dip"  class="form-control" value="{{ $item->tipo_vigencia_dip }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Tipo Vigencia Abreviado</label>
                            <input type="text" name="tipo_vigencia_abrev_dip"  class="form-control" value="{{ $item->tipo_vigencia_abrev_dip }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">firma1_dip</label>
                            <input type="file" name="firma1_dip" id="firma1_dip" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->firma1_dip) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">firma2_dip</label>
                            <input type="file" name="firma2_dip" id="firma2_dip" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->firma2_dip) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda Footer</label>
                            <input type="text" name="leyenda_footer1_dip"  class="form-control" value="{{ $item->leyenda_footer1_dip }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Titulo hoja2</label>
                            <input type="text" name="titulo_hoja2_dip"  class="form-control" value="{{ $item->titulo_hoja2_dip }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Subtitulo hoja2</label>
                            <input type="text" name="subtitulo_hoja2_dip"  class="form-control" value="{{ $item->subtitulo_hoja2_dip }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Aviso priv hoja2</label>
                            <input type="text" name="aviso_priv_hoja2_dip"  class="form-control" value="{{ $item->aviso_priv_hoja2_dip }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda 3 hoja 2</label>
                            <input type="text" name="leyenda3_hoja2_dip"  class="form-control" value="{{ $item->leyenda3_hoja2_dip }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Sello constancia hoja2</label>
                            <input type="file" name="sello_constancia_hoja2_dip" id="sello_constancia_hoja2_dip" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->sello_constancia_hoja2_dip) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Sello reristro hoja2</label>
                            <input type="file" name="sello_reristro_hoja2_dip" id="sello_reristro_hoja2_dip" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->sello_reristro_hoja2_dip) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Tira imagenes hoja2</label>
                            <input type="file" name="tira_imagenes_hoja2_dip" id="tira_imagenes_hoja2_dip" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->tira_imagenes_hoja2_dip) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda footer 1</label>
                            <input type="text" name="leyenda_footer_uno_dip"  class="form-control" value="{{ $item->leyenda_footer_uno_dip }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda footer 2</label>
                            <input type="text" name="leyenda_footer_dos_dip"  class="form-control" value="{{ $item->leyenda_footer_dos_dip }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">fondo</label>
                            <input type="file" name="fondo_dip"  class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->fondo_dip) }}" alt="Imagen" style="width:300px;">
                        </div>

                    @endif

                    @if($item->tipo == 'Credencial')
                        <div class="form-group col-6">
                            <label for="name">Logo Registro</label>
                            <input type="file" name="logo_registro_credencial" id="logo_registro_credencial" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->logo_registro_credencial) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Logo otra instirucion</label>
                            <input type="file" name="logo_otra_institucion_credencial"  class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->logo_otra_institucion_credencial) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Titulo</label>
                            <input type="text" name="titulo1_credencial"  class="form-control" value="{{ $item->titulo1_credencial }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Folio</label>
                            <input type="text" name="folio_credencial"  class="form-control" value="{{ $item->folio_credencial }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Vigencia</label>
                            <input type="date" name="vigencia_credencial"  class="form-control" value="{{ $item->vigencia_credencial }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">tipo_credencial</label>
                            <input type="text" name="tipo_credencial"  class="form-control" value="{{ $item->tipo_credencial }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">nacionalidad</label>
                            <input type="text" name="nacionalidad_credencial"  class="form-control" value="{{ $item->nacionalidad_credencial }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">QR</label>
                            <input type="file" name="qr_credencial" id="qr_credencial" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->qr_credencial) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda qr</label>
                            <input type="text" name="leyenda_qr_credencial"  class="form-control" value="{{ $item->leyenda_qr_credencial }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda 1</label>
                            <input type="text" name="leyenda1_hoja_credencial"  class="form-control" value="{{ $item->leyenda1_hoja_credencial }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda 2</label>
                            <input type="text" name="leyenda2_hoja_credencial"  class="form-control" value="{{ $item->leyenda2_hoja_credencial }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda 3</label>
                            <input type="text" name="leyenda3_hoja_credencial"  class="form-control" value="{{ $item->leyenda3_hoja_credencial }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda 4</label>
                            <input type="text" name="leyenda4_hoja_credencial"  class="form-control" value="{{ $item->leyenda4_hoja_credencial }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">firma</label>
                            <input type="file" name="firma_credencial" id="firma_credencial" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->firma_credencial) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">fondo</label>
                            <input type="file" name="fonda_credencial"  class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->fonda_credencial) }}" alt="Imagen" style="width:300px;">
                        </div>
                    @endif

                    @if($item->tipo == 'Titulo Honorifico con QR')
                        <div class="form-group col-6">
                            <label for="name">Logo Registro</label>
                            <input type="file" name="logo_registro_titulo" id="logo_registro_titulo" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->logo_registro_titulo) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Logo otra instirucion</label>
                            <input type="file" name="logo_otra_institucion_titulo"  class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->logo_otra_institucion_titulo) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Titulo</label>
                            <input type="text" name="titulo_titulo"  class="form-control" value="{{ $item->titulo_titulo }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Subtitulo</label>
                            <input type="text" name="subtitulo_titulo"  class="form-control" value="{{ $item->subtitulo_titulo }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Sub subtitulo</label>
                            <input type="text" name="subsubtitulo_titulo"  class="form-control" value="{{ $item->subsubtitulo_titulo }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda 1</label>
                            <input type="text" name="leyenda1_titulo"  class="form-control" value="{{ $item->leyenda1_titulo }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Firma 1</label>
                            <input type="file" name="firma1_titulo" id="firma1_titulo" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->firma1_titulo) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Firma 2</label>
                            <input type="file" name="firma2_titulo" id="firma2_titulo" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->firma2_titulo) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Firma 3</label>
                            <input type="file" name="firma3_titulo" id="firma3_titulo" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->firma3_titulo) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">QR</label>
                            <input type="file" name="qr_credencial_titulo" id="qr_credencial_titulo" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->qr_credencial_titulo) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda qr</label>
                            <input type="text" name="leyenda_qr_titulo"  class="form-control" value="{{ $item->leyenda_qr_titulo }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Sello</label>
                            <input type="file" name="sello_realimg_" id="sello_realimg_" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->sello_realimg_) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Tira imagenes hoja 2</label>
                            <input type="file" name="tira_imagenes_hoja2_titulo" id="tira_imagenes_hoja2_titulo" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->tira_imagenes_hoja2_titulo) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">tipo vigencia abrev</label>
                            <input type="text" name="tipo_vigencia_abrev_titulo"  class="form-control" value="{{ $item->tipo_vigencia_abrev_titulo }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda 1 hoja 2</label>
                            <input type="text" name="leyenda1_hoja2_titulo"  class="form-control" value="{{ $item->leyenda1_hoja2_titulo }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda 2 hoja 2</label>
                            <input type="text" name="leyenda2_hoja2_titulo"  class="form-control" value="{{ $item->leyenda2_hoja2_titulo }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda 3 hoja 2</label>
                            <input type="text" name="leyenda3_hoja2_titulo"  class="form-control" value="{{ $item->leyenda3_hoja2_titulo }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda 4 hoja 2</label>
                            <input type="text" name="leyenda4_hoja2_titulo"  class="form-control" value="{{ $item->leyenda4_hoja2_titulo }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda 5 hoja 2</label>
                            <input type="text" name="leyenda5_hoja2_titulo"  class="form-control" value="{{ $item->leyenda5_hoja2_titulo }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda 6 hoja 2</label>
                            <input type="text" name="leyenda6_hoja2_titulo"  class="form-control" value="{{ $item->leyenda6_hoja2_titulo }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Firma hoja 2</label>
                            <input type="file" name="firma1_hoja2_titulo"  class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->firma1_hoja2_titulo) }}" alt="Imagen" style="width:300px;">
                        </div>
                    @endif

                    @if($item->tipo == 'Tira_materias_aparatologia' || $item->tipo == 'Tira_materias_alasiados' || $item->tipo == 'Tira_materias_cosmetologia_fc' || $item->tipo == 'Tira_materias_cosmeatria_ea' || $item->tipo == 'Tira_materias_auxiliar' || $item->tipo == 'Tira_materias_masoterapia' || $item->tipo == 'Tira_materias_cosmetologia' || $item->tipo == 'Tira_materias_drenaje_linfatico')

                        @if($item->tipo == 'Tira_materias_aparatologia')
                            <input type="hidden" name="Tira_materias_aparatologia"  class="form-control" value="1">
                        @elseif($item->tipo == 'Tira_materias_alasiados')
                            <input type="hidden" name="Tira_materias_alasiados"  class="form-control" value="1">
                        @elseif($item->tipo == 'Tira_materias_cosmetologia_fc')
                            <input type="hidden" name="Tira_materias_cosmetologia_fc"  class="form-control" value="1">
                        @elseif($item->tipo == 'Tira_materias_cosmeatria_ea')
                            <input type="hidden" name="Tira_materias_cosmeatria_ea"  class="form-control" value="1">
                        @elseif($item->tipo == 'Tira_materias_auxiliar')
                            <input type="hidden" name="Tira_materias_auxiliar"  class="form-control" value="1">
                        @elseif($item->tipo == 'Tira_materias_masoterapia')
                            <input type="hidden" name="Tira_materias_masoterapia"  class="form-control" value="1">
                        @elseif($item->tipo == 'Tira_materias_cosmetologia')
                            <input type="hidden" name="Tira_materias_cosmetologia"  class="form-control" value="1">
                        @elseif($item->tipo == 'Tira_materias_drenaje_linfatico')
                            <input type="hidden" name="Tira_materias_drenaje_linfatico"  class="form-control" value="1">
                        @endif
                        <div class="form-group col-6">
                            <label for="name">Logo</label>
                            <input type="file" name="logo_tm" id="logo_tm" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->logo_tm) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Logo otra instirucion</label>
                            <input type="file" name="logo_otra_institucion_tm"  class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->logo_otra_institucion_tm) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Titulo</label>
                            <input type="text" name="titulo1_tm"  class="form-control" value="{{ $item->titulo1_tm }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda 1</label>
                            <input type="text" name="leyenda1_tm"  class="form-control" value="{{ $item->leyenda1_tm }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda 2</label>
                            <input type="text" name="leyenda2_tm"  class="form-control" value="{{ $item->leyenda2_tm }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda 3</label>
                            <input type="text" name="leyenda3_tm"  class="form-control" value="{{ $item->leyenda3_tm }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda 4</label>
                            <input type="text" name="leyenda4_tm"  class="form-control" value="{{ $item->leyenda4_tm }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda 5</label>
                            <input type="text" name="leyenda5_tm"  class="form-control" value="{{ $item->leyenda5_tm }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">optativos_tm</label>
                            <input type="text" name="optativos_tm"  class="form-control" value="{{ $item->optativos_tm }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">totales_tm</label>
                            <input type="text" name="totales_tm"  class="form-control" value="{{ $item->totales_tm }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">materias_aprov_tm</label>
                            <input type="text" name="materias_aprov_tm"  class="form-control" value="{{ $item->materias_aprov_tm }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">promedio_tm</label>
                            <input type="text" name="promedio_tm"  class="form-control" value="{{ $item->promedio_tm }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Fecha expedicion</label>
                            <input type="date" name="fecha_expedicion"  class="form-control" value="{{ $item->fecha_expedicion }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda footer hoja1</label>
                            <input type="text" name="leyenda_footer_hoja1_tm"  class="form-control" value="{{ $item->leyenda_footer_hoja1_tm }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda 1 hoja2</label>
                            <input type="text" name="leyenda1_hoja2_tm"  class="form-control" value="{{ $item->leyenda1_hoja2_tm }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda 2 hoja2</label>
                            <input type="text" name="leyenda2_hoja2_tm"  class="form-control" value="{{ $item->leyenda2_hoja2_tm }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda 3 hoja2</label>
                            <input type="text" name="leyenda3_hoja2_tm"  class="form-control" value="{{ $item->leyenda3_hoja2_tm }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda 4 hoja2</label>
                            <input type="text" name="leyenda4_hoja2_tm"  class="form-control" value="{{ $item->leyenda4_hoja2_tm }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda 5 hoja2</label>
                            <input type="text" name="leyenda5_hoja2_tm"  class="form-control" value="{{ $item->leyenda5_hoja2_tm }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda 6 hoja2</label>
                            <input type="text" name="leyenda6_hoja2_tm"  class="form-control" value="{{ $item->leyenda6_hoja2_tm }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">QR</label>
                            <input type="file" name="qr_credencial_tm" id="qr_credencial_tm" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->qr_credencial_tm) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda QR</label>
                            <input type="file" name="leyenda_qr_credencial_tm" id="leyenda_qr_credencial_tm" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->leyenda_qr_credencial_tm) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">tipo vigencia abrev</label>
                            <input type="text" name="tipo_vigencia_abrev_tm"  class="form-control" value="{{ $item->tipo_vigencia_abrev_tm }}">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Firma 1 hoja 2</label>
                            <input type="file" name="firma1_hoja2_tm" id="firma1_hoja2_tm" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->firma1_hoja2_tm) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Firma 2 hoja 2</label>
                            <input type="file" name="firma2_hoja2_tm" id="firma2_hoja2_tm" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->firma2_hoja2_tm) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Firma 3 hoja 2</label>
                            <input type="file" name="firma3_hoja2_tm" id="firma3_hoja2_tm" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->firma3_hoja2_tm) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Img Izq</label>
                            <input type="file" name="img_izq_tm" id="img_izq_tm" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->img_izq_tm) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Img Der</label>
                            <input type="file" name="img_der_tm" id="img_der_tm" class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->img_der_tm) }}" alt="Imagen" style="width:300px;">
                        </div>

                        <div class="form-group col-6">
                            <label for="name">Leyenda footer hoja 2</label>
                            <input type="text" name="leyenda_footer_hoja2_tm"  class="form-control" value="{{ $item->leyenda_footer_hoja2_tm }}">
                        </div>
                    @endif

                    <div class="form-group col-6">
                        <label for="name">Imagen de portada</label>
                        <input type="file" name="img_portada" id="img_portada" class="form-control">
                        <img id="blah" src="{{ asset('tipos_documentos/'.$item->img_portada) }}" alt="Imagen" style="width:300px;">
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Imagen de Reverso</label>
                        <input type="file" name="img_reverso" id="img_reverso" class="form-control">
                        <img id="blah" src="{{ asset('tipos_documentos/'.$item->img_reverso) }}" alt="Imagen" style="width:300px;">
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
