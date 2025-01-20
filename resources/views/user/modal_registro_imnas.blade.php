<!-- Modal -->
<div class="modal fade" id="modalUser{{ $registro_imnas->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header" style="background: #F5ECE4;">
          <h5 class="modal-title" id="exampleModalLabel">{{ $registro_imnas->nombre }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="background: {{$configuracion->color_boton_close}}; color: #ffff">
                <span aria-hidden="true">X</span>
            </button>
        </div>
            <div class="modal-body row">
                <div class="mb-4 col-6">
                    <label for="basic-url" class="form-label" style="font-weight: 700;">Nombre del curso</label>
                    <div class="input-group">
                        {{ $registro_imnas->nom_curso }}
                    </div>
                </div>

                <div class="mb-4 col-6">
                    <label for="basic-url" class="form-label" style="font-weight: 700;">Fecha del curso</label>
                    <div class="input-group">
                        {{ $registro_imnas->fecha_curso }}
                    </div>
                </div>

                <div class="mb-4 col-6">
                    <label for="basic-url" class="form-label" style="font-weight: 700;">Nombre</label>
                    <div class="input-group">
                        {{ $registro_imnas->nombre }}
                    </div>
                </div>

                <div class="mb-4 col-6">
                    <label for="basic-url" class="form-label" style="font-weight: 700;">Comentario</label>
                    <div class="input-group">
                        {{ $registro_imnas->comentario_cliente }}
                    </div>
                </div>

                <div class="mb-4 col-6">
                    <label for="basic-url" class="form-label" style="font-weight: 700;">CURP escrito</label>
                    <div class="input-group">
                        {{ $registro_imnas->curp_escrito }}
                    </div>
                </div>

                <div class="mb-4 col-6">
                    <label for="basic-url" class="form-label" style="font-weight: 700;">Tipo Diseño</label>
                    <div class="input-group">
                        <p style="color: {{ $registro_imnas->diseno_doc === 'Clasico' || $registro_imnas->diseno_doc === NULL ? '#836262' : '#66c0cc' }}">
                            {{ $registro_imnas->diseno_doc ?? 'Clasico' }}
                        </p>
                    </div>
                </div>

                <div class="mb-4 col-4">
                    <label for="basic-url" class="form-label" style="font-weight: 700;">INE</label>
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

                <div class="mb-4 col-4">
                    <label for="basic-url" class="form-label" style="font-weight: 700;">CURP</label>
                    @if (pathinfo($registro_imnas->curp, PATHINFO_EXTENSION) == 'pdf')
                        <a class="text-center text-white btn btn-sm mt-2" href="{{asset('documentos_registro/'. $registro_imnas->User->telefono . '/' .$registro_imnas->curp) }}" download="{{ $registro_imnas->curp }}" style="background: #836262; border-radius: 19px;">
                            Descargar Documento
                        </a>
                    @else
                        <div class="input-group">
                            <img id="blah" src="{{asset('documentos_registro/'. $registro_imnas->User->telefono . '/' .$registro_imnas->curp) }}" alt="Imagen" style="width: 100px;height: 100px;">
                        </div>
                    @endif
                </div>

                <div class="mb-4 col-4">
                    <label for="basic-url" class="form-label" style="font-weight: 700;">Foto</label>
                    @if (pathinfo($registro_imnas->foto_cuadrada, PATHINFO_EXTENSION) == 'pdf')
                        <a class="text-center text-white btn btn-sm mt-2" href="{{asset('documentos_registro/'. $registro_imnas->User->telefono . '/' .$registro_imnas->foto_cuadrada) }}" download="{{ $registro_imnas->foto_cuadrada }}" style="background: #836262; border-radius: 19px;">
                            Descargar Documento
                        </a>
                    @else
                        <div class="input-group">
                            <img id="blah" src="{{asset('documentos_registro/'. $registro_imnas->User->telefono . '/' .$registro_imnas->foto_cuadrada) }}" alt="Imagen" style="width: 100px;height: 100px;">
                        </div>
                    @endif
                </div>

                <div class="mb-4 col-2">
                    <label for="basic-url" class="form-label" style="font-weight: 700;">Cedula</label>
                    <div class="input-group">
                        @if ($registro_imnas->estatus_cedula == NULL)
                             <p style="color: #864d4d">Faltante por hacer</p>
                        @else
                            <p style="color: #5b814d">Realizado</p>
                        @endif
                    </div>
                </div>

                <div class="mb-4 col-6 col-md-3 col-3">
                    <label for="basic-url" class="form-label" style="font-weight: 700;">Titulo Honorifico</label>
                    <div class="input-group">
                        @if ($registro_imnas->estatus_titulo == NULL)
                             <p style="color: #864d4d">Faltante por hacer</p>
                        @else
                            <p style="color: #5b814d">Realizado</p>
                        @endif
                    </div>
                </div>

                <div class="mb-4 col-6 col-md-3 col-3">
                    <label for="basic-url" class="form-label" style="font-weight: 700;">Diploma</label>
                    <div class="input-group">
                        @if ($registro_imnas->estatus_diploma == NULL)
                             <p style="color: #864d4d">Faltante por hacer</p>
                        @else
                            <p style="color: #5b814d">Realizado</p>
                        @endif
                    </div>
                </div>

                <div class="mb-4 col-6 col-md-3 col-3">
                    <label for="basic-url" class="form-label" style="font-weight: 700;">Credencial</label>
                    <div class="input-group">
                        @if ($registro_imnas->estatus_credencial == NULL)
                             <p style="color: #864d4d">Faltante por hacer</p>
                        @else
                            <p style="color: #5b814d">Realizado</p>
                        @endif
                    </div>
                </div>

                <div class="mb-4 col-6 col-md-3 col-3">
                    <label for="basic-url" class="form-label" style="font-weight: 700;">Tira de materias</label>
                    <div class="input-group">
                        @if ($registro_imnas->estatus_tira == NULL)
                             <p style="color: #864d4d">Faltante por hacer</p>
                        @else
                            <p style="color: #5b814d">Realizado</p>
                        @endif
                    </div>
                </div>
            </div>
      </div>
    </div>
  </div>
