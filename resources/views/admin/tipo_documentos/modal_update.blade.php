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
                            <label for="name">fondo_cp</label>
                            <input type="file" name="fondo_cp"  class="form-control">
                            <img  src="{{ asset('tipos_documentos/'.$item->fondo_cp) }}" alt="Imagen" style="width:300px;">
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
