<!-- Modal -->
<div class="modal fade" id="modal_estatus{{$cliente->id}}" tabindex="-1" aria-labelledby="modal_estatusLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h1 class="modal-title fs-5" id="modal_estatusLabel">Estatus</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <form role="form" action="{{ route('estatus_update.certificaion', $cliente->id) }}" method="post">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
            <div class="modal-body">

                    <div class="row">

                            <div id="contenedor_firma" class="col-6 mx-auto my-auto">
                                @if ($cliente->Documentos->firma)
                                    <p class="text-center ">
                                        <strong>Firma :</strong>
                                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->firma) }}" alt="Imagen" style="width: 100%;height: auto;"/><br>
                                    </p>
                                @endif
                            </div>

                            <div id="contenedor_ine" class="col-6 mx-auto my-auto">
                                <p>
                                    <strong>INE :</strong>
                                </p>
                                @if (pathinfo($cliente->Documentos->ine, PATHINFO_EXTENSION) == 'pdf')
                                    <p class="text-center ">
                                        <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->ine)}}" style="width: 60%; height: auto"></iframe>
                                    </p>
                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->ine) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                    @elseif (pathinfo($cliente->Documentos->ine, PATHINFO_EXTENSION) == 'doc')
                                    <p class="text-center ">
                                        <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto"/>
                                    </p>
                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->ine) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                    @elseif (pathinfo($cliente->Documentos->ine, PATHINFO_EXTENSION) == 'docx')
                                    <p class="text-center ">
                                        <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto"/>
                                    </p>
                                            <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->ine) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                    @else
                                        <p class="text-center mt-2">
                                            <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->ine) }}" alt="Imagen" style="width: 80%;height: auto;"/><br>
                                            <a class="text-center text-dark btn btn-sm mt-3" href="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->ine) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver INE</a>

                                        </p>
                                    @endif
                            </div>

                            <div id="contenedor_curp" class="col-6 mx-auto my-auto">

                                <p>
                                    <strong>curp :</strong>
                                </p>

                                @if (pathinfo($cliente->Documentos->curp, PATHINFO_EXTENSION) == 'pdf')
                                <p class="text-center ">
                                    <iframe class="mt-2" src="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->curp)}}" style="width: 60%; height: auto;"></iframe>
                                </p>
                                        <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->curp) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                @elseif (pathinfo($cliente->Documentos->curp, PATHINFO_EXTENSION) == 'doc')
                                <p class="text-center ">
                                    <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto;"/>
                                </p>
                                <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->curp) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                @elseif (pathinfo($cliente->Documentos->curp, PATHINFO_EXTENSION) == 'docx')
                                <p class="text-center ">
                                    <img id="blah" src="{{asset('assets/user/icons/docx.png') }}" alt="Imagen" style="width: 60px; height: auto;"/>
                                </p>
                                <a class="btn btn-sm text-dark" href="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->curp) }}" target="_blank" style="background: #836262; color: #ffff!important">Descargar</a>
                                @else
                                    <p class="text-center mt-2">
                                        <img id="blah" src="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->curp) }}" alt="Imagen" style="width: 80%;height: auto;"/><br>
                                        <a class="text-center text-dark btn btn-sm mb-5 mt-3" href="{{asset('documentos/'. $cliente->telefono . '/' .$cliente->Documentos->curp) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver CURP</a>

                                    </p>
                                @endif
                            </div>

                        @if ($cliente->estatus_constancia == 'Fecha tentativa seleccionada' || $cliente->estatus_constancia == 'Fecha aprobada')
                                <div class="col-12"></div>
                                <div class="mb-4 col-6">
                                    <label for="basic-url" class="form-label" style="font-weight: 700;">fecha tentativa *</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" disabled value="{{$cliente->fecha_tentativa}}">
                                    </div>
                                </div>

                                <div class="mb-4 col-6">
                                    <label for="basic-url" class="form-label" style="font-weight: 700;">fecha certificaion *</label>
                                    <div class="input-group">
                                        <input type="date" class="form-control" name="fecha_certificaion">
                                    </div>
                                </div>
                                <h3>fecha certificaion: {{$cliente->fecha_certificaion}}</h3>
                            @else
                                <div class="mb-4 col-12">
                                    <label for="basic-url" class="form-label" style="font-weight: 700;">Estatus *</label>
                                    <div class="input-group">
                                        <select name="estatus_constancia" id="estatus_constancia" class="form-select">
                                            <option value="revision de datos">Formualario Realizado</option>
                                            <option value="Enviar Correo">Enviar Correo de acceso</option>
                                            <option value="Seleccion de fecha tentativa">Seleccion de fecha tentativa</option>
                                            <option value="Aprovacion de fecha">Aprovacion de fecha</option>
                                        </select>
                                    </div>
                                </div>
                        @endif

                    </div>

            </div>

            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
