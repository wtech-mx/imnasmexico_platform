<!-- Modal -->
<div class="modal fade" id="manual_update_{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="manual_update_{{ $item->id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manual_update_{{ $item->id }}">Crear Manual</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                    <span aria-hidden="true">X</span>
                </button>
            </div>
            <form method="POST" action="{{ route('manual.update', $item->id) }}" enctype="multipart/form-data" role="form">
                @csrf
                <input type="hidden" name="_method" value="PATCH">
                <div class="modal-body row">
                    <div class="form-group col-12">
                        <label for="name">Modulo</label>
                        <input id="modulo" name="modulo" type="text" class="form-control" required value="{{ $item->modulo }}">
                    </div>

                    <div class="form-group col-12">
                        <label for="name">Nombre</label>
                        <input id="nombre" name="nombre" type="text" class="form-control" required value="{{ $item->nombre }}">
                    </div>

                    <div class="form-group col-12">
                        <label for="name">Descripcion</label>
                        <textarea name="descripcion" id="descripcion" cols="30" rows="3" class="form-control">{{ $item->descripcion }}</textarea>
                    </div>

                    <div class="form-group col-12">
                        <label for="name">Imagen de portada</label>
                        <input type="file" name="imagen_portada" id="imagen_portada" class="form-control">
                        <img id="blah" src="{{ asset('manual/'.$item->imagen_portada) }}" alt="Imagen" style="width:300px;">
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Paso 1</label>
                        <input id="step3_name" name="step1_name" type="number" class="form-control" value="{{ $item->step3_name }}">
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Foto del paso 1</label>
                        <input type="file" name="foto1" id="foto1" class="form-control">
                        <img id="blah" src="{{ asset('manual/'.$item->foto1) }}" alt="Imagen" style="width:300px;">
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Paso 2</label>
                        <input id="step3_name" name="step2_name" type="number" class="form-control" value="{{ $item->step3_name }}">
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Foto del paso 2</label>
                        <input type="file" name="foto2" id="foto2" class="form-control">
                        <img id="blah" src="{{ asset('manual/'.$item->foto2) }}" alt="Imagen" style="width:300px;">
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Paso 3</label>
                        <input id="step3_name" name="step3_name" type="number" class="form-control" value="{{ $item->step3_name }}">
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Foto del paso 3</label>
                        <input type="file" name="foto3" id="foto3" class="form-control">
                        <img id="blah" src="{{ asset('manual/'.$item->foto3) }}" alt="Imagen" style="width:300px;">
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Paso 4</label>
                        <input id="step4_name" name="step4_name" type="number" class="form-control" value="{{ $item->step4_name }}">
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Foto del paso 4</label>
                        <input type="file" name="foto4" id="foto4" class="form-control">
                        <img id="blah" src="{{ asset('manual/'.$item->foto4) }}" alt="Imagen" style="width:300px;">
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Paso 5</label>
                        <input id="step5_name" name="step5_name" type="number" class="form-control" value="{{ $item->step5_name }}">
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Foto del paso 5</label>
                        <input type="file" name="foto5" id="foto5" class="form-control">
                        <img id="blah" src="{{ asset('manual/'.$item->foto5) }}" alt="Imagen" style="width:300px;">
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Paso 6</label>
                        <input id="step6_name" name="step6_name" type="number" class="form-control" value="{{ $item->step6_name }}">
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Foto del paso 6</label>
                        <input type="file" name="foto6" id="foto6" class="form-control">
                        <img id="blah" src="{{ asset('manual/'.$item->foto6) }}" alt="Imagen" style="width:300px;">
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Paso 7</label>
                        <input id="step7_name" name="step7_name" type="number" class="form-control" value="{{ $item->step7_name }}">
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Foto del paso 7</label>
                        <input type="file" name="foto7" id="foto7" class="form-control">
                        <img id="blah" src="{{ asset('manual/'.$item->foto7) }}" alt="Imagen" style="width:300px;">
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Paso 8</label>
                        <input id="step8_name" name="step8_name" type="number" class="form-control" value="{{ $item->step8_name }}">
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Foto del paso 8</label>
                        <input type="file" name="foto8" id="foto8" class="form-control">
                        <img id="blah" src="{{ asset('manual/'.$item->foto8) }}" alt="Imagen" style="width:300px;">
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Paso 9</label>
                        <input id="step9_name" name="step9_name" type="number" class="form-control" value="{{ $item->step9_name }}">
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Foto del paso 9</label>
                        <input type="file" name="foto9" id="foto9" class="form-control">
                        <img id="blah" src="{{ asset('manual/'.$item->foto9) }}" alt="Imagen" style="width:300px;">
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Paso 10</label>
                        <input id="step10_name" name="step10_name" type="number" class="form-control" value="{{ $item->step10_name }}">
                    </div>

                    <div class="form-group col-6">
                        <label for="name">Foto del paso 10</label>
                        <input type="file" name="foto10" id="foto10" class="form-control">
                        <img id="blah" src="{{ asset('manual/'.$item->foto10) }}" alt="Imagen" style="width:300px;">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
