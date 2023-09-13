<div class="container-fluid py-4">
    <div class="row mt-3">

        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100">
                 <form method="POST" action="{{ route('expediente.check', $expediente->Nota->id) }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-8">
                                    <h6 class="mb-0">Documentos</h6>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-sm" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-6">
                                    <label for="logo">Logo </label>
                                    <input id="logo" name="logo" type="file" class="form-control" value="">
                                        @if ($documentos->logo != NULL)
                                            @if (pathinfo($documentos->logo, PATHINFO_EXTENSION) == 'pdf')
                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->logo)}}" style="width: 60%; height: 60px;"></iframe>
                                                <p class="text-center ">
                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->logo) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                </p>
                                            @else
                                                <p class="text-center mt-2">
                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->logo) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->logo) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                </p>
                                            @endif
                                        @endif
                                </div>

                                <div class="col-6">
                                    <label for="acuerdo_confidencialidad">Acuerdo confidencialidad </label>
                                    <input id="acuerdo_confidencialidad" name="acuerdo_confidencialidad" type="file" class="form-control" >
                                        @if ($documentos->acuerdo_confidencialidad != NULL)
                                            @if (pathinfo($documentos->acuerdo_confidencialidad, PATHINFO_EXTENSION) == 'pdf')
                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->acuerdo_confidencialidad)}}" style="width: 60%; height: 60px;"></iframe>
                                                <p class="text-center ">
                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->acuerdo_confidencialidad) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                </p>
                                            @else
                                                <p class="text-center mt-2">
                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->acuerdo_confidencialidad) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->acuerdo_confidencialidad) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                </p>
                                            @endif
                                        @endif
                                </div>

                                <div class="col-6">
                                    <label for="comprobante_domicilio">Comprobante domicilio </label>
                                    <input id="comprobante_domicilio" name="comprobante_domicilio" type="file" class="form-control" >
                                        @if ($documentos->comprobante_domicilio != NULL)
                                            @if (pathinfo($documentos->comprobante_domicilio, PATHINFO_EXTENSION) == 'pdf')
                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->comprobante_domicilio)}}" style="width: 60%; height: 60px;"></iframe>
                                                <p class="text-center ">
                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->comprobante_domicilio) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                </p>
                                            @else
                                                <p class="text-center mt-2">
                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->comprobante_domicilio) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->comprobante_domicilio) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                </p>
                                            @endif
                                        @endif
                                </div>

                                <div class="col-6">
                                    <label for="contrato_individual">Contrato individual</label>
                                    <input id="contrato_individual" name="contrato_individual" type="file" class="form-control" >
                                        @if ($documentos->contrato_individual != NULL)
                                            @if (pathinfo($documentos->contrato_individual, PATHINFO_EXTENSION) == 'pdf')
                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->contrato_individual)}}" style="width: 60%; height: 60px;"></iframe>
                                                <p class="text-center ">
                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->contrato_individual) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                </p>
                                            @else
                                                <p class="text-center mt-2">
                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->contrato_individual) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->contrato_individual) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                </p>
                                            @endif
                                        @endif
                                </div>

                                <div class="col-6">
                                    <label for="curriculum">Curriculum </label>
                                    <input id="curriculum" name="curriculum" type="file" class="form-control" >
                                        @if ($documentos->curriculum != NULL)
                                            @if (pathinfo($documentos->curriculum, PATHINFO_EXTENSION) == 'pdf')
                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->curriculum)}}" style="width: 60%; height: 60px;"></iframe>
                                                <p class="text-center ">
                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->curriculum) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                </p>
                                            @else
                                                <p class="text-center mt-2">
                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->curriculum) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->curriculum) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                </p>
                                            @endif
                                        @endif
                                </div>

                                <div class="col-6">
                                    <label for="ine">INE</label>
                                    <input id="ine" name="ine" type="file" class="form-control" >
                                        @if ($documentos->ine != NULL)
                                            @if (pathinfo($documentos->ine, PATHINFO_EXTENSION) == 'pdf')
                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->ine)}}" style="width: 60%; height: 60px;"></iframe>
                                                <p class="text-center ">
                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->ine) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                </p>
                                            @else
                                                <p class="text-center mt-2">
                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->ine) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->ine) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                </p>
                                            @endif
                                        @endif
                                </div>

                                <div class="col-6">
                                    <label for="curp">Curp </label>
                                    <input id="curp" name="curp" type="file" class="form-control" >
                                        @if ($documentos->curp != NULL)
                                            @if (pathinfo($documentos->curp, PATHINFO_EXTENSION) == 'pdf')
                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->curp)}}" style="width: 60%; height: 60px;"></iframe>
                                                <p class="text-center ">
                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->curp) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                </p>
                                            @else
                                                <p class="text-center mt-2">
                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->curp) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->curp) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                </p>
                                            @endif
                                        @endif
                                </div>

                                <div class="col-6">
                                    <label for="acta_nacimiento">Acta nacimiento</label>
                                    <input id="acta_nacimiento" name="acta_nacimiento" type="file" class="form-control" >
                                        @if ($documentos->acta_nacimiento != NULL)
                                            @if (pathinfo($documentos->acta_nacimiento, PATHINFO_EXTENSION) == 'pdf')
                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->acta_nacimiento)}}" style="width: 60%; height: 60px;"></iframe>
                                                <p class="text-center ">
                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->acta_nacimiento) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                </p>
                                            @else
                                                <p class="text-center mt-2">
                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->acta_nacimiento) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->acta_nacimiento) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                </p>
                                            @endif
                                        @endif
                                </div>

                                <div class="col-6">
                                    <label for="foto">foto </label>
                                    <input id="foto" name="foto" type="file" class="form-control" >
                                        @if ($documentos->foto != NULL)
                                            @if (pathinfo($documentos->foto, PATHINFO_EXTENSION) == 'pdf')
                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->foto)}}" style="width: 60%; height: 60px;"></iframe>
                                                <p class="text-center ">
                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->foto) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                </p>
                                            @else
                                                <p class="text-center mt-2">
                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->foto) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->foto) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                </p>
                                            @endif
                                        @endif
                                </div>

                                <div class="col-6">
                                    <label for="contrato_general">Contrato general</label>
                                    <input id="contrato_general" name="contrato_general" type="file" class="form-control" >
                                        @if ($documentos->contrato_general != NULL)
                                            @if (pathinfo($documentos->contrato_general, PATHINFO_EXTENSION) == 'pdf')
                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->contrato_general)}}" style="width: 60%; height: 60px;"></iframe>
                                                <p class="text-center ">
                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->contrato_general) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                </p>
                                            @else
                                                <p class="text-center mt-2">
                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->ine) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->ine) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                </p>
                                            @endif
                                        @endif
                                </div>

                                <div class="col-6">
                                    <label for="solicitud_acreditacion">Solicitud acreditacion </label>
                                    <input id="solicitud_acreditacion" name="solicitud_acreditacion" type="file" class="form-control" >
                                        @if ($documentos->solicitud_acreditacion != NULL)
                                            @if (pathinfo($documentos->solicitud_acreditacion, PATHINFO_EXTENSION) == 'pdf')
                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->solicitud_acreditacion)}}" style="width: 60%; height: 60px;"></iframe>
                                                <p class="text-center ">
                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->solicitud_acreditacion) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                </p>
                                            @else
                                                <p class="text-center mt-2">
                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->solicitud_acreditacion) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->solicitud_acreditacion) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                </p>
                                            @endif
                                        @endif
                                </div>

                                <div class="col-6">
                                    <label for="carta_compromiso">Carta compromiso</label>
                                    <input id="carta_compromiso" name="carta_compromiso" type="file" class="form-control" >
                                        @if ($documentos->carta_compromiso != NULL)
                                            @if (pathinfo($documentos->carta_compromiso, PATHINFO_EXTENSION) == 'pdf')
                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->carta_compromiso)}}" style="width: 60%; height: 60px;"></iframe>
                                                <p class="text-center ">
                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->carta_compromiso) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                </p>
                                            @else
                                                <p class="text-center mt-2">
                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->carta_compromiso) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->carta_compromiso) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                </p>
                                            @endif
                                        @endif
                                </div>

                                <div class="col-6">
                                    <label for="carta_responsabilidad">Carta responsabilidad </label>
                                    <input id="carta_responsabilidad" name="carta_responsabilidad" type="file" class="form-control" >
                                        @if ($documentos->carta_responsabilidad != NULL)
                                            @if (pathinfo($documentos->carta_responsabilidad, PATHINFO_EXTENSION) == 'pdf')
                                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->carta_responsabilidad)}}" style="width: 60%; height: 60px;"></iframe>
                                                <p class="text-center ">
                                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->carta_responsabilidad) }}" target="_blank" style="background: #836262; color: #ffff">Ver archivo</a>
                                                </p>
                                            @else
                                                <p class="text-center mt-2">
                                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->carta_responsabilidad) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->carta_responsabilidad) }}" target="_blank" style="background: #836262; color: #ffff">Ver Imagen</a>
                                                </p>
                                            @endif
                                        @endif
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
        </div>

        <div class="col-12 col-md-6 col-xl-4 mt-md-0 mt-4">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Carpetas</h6>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-4">
                            <button class="btn btn-sm" id="btnArchivos1" onclick="mostrarArchivos('1')">
                                <img src="{{asset('assets/user/icons/manual.png')}}" class="img-fluid" style="width: 40%;">
                                <label for="">1. Manuales Digitales CONOCER</label>
                            </button>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('2')">
                                <img src="{{asset('assets/user/icons/information.png')}}" class="img-fluid" style="width: 40%;">
                                <label for="">2. Reglamento Y Manuales De Procedimientos IMNAS</label>
                            </button>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('estandares', {{ $expediente->Nota->id }}); mostrarCarpetasCompradas({{ $expediente->Nota->id }})">
                                <img src="{{asset('assets/user/icons/documentos.png')}}" class="img-fluid" style="width: 40%;">
                                <label for="">3. Formatos Estándares</label>
                            </button>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('3')">
                                <img src="{{asset('assets/user/icons/illustrator.png')}}" class="img-fluid" style="width: 40%;">
                                <label for="">4. Logo Conocer Evaluador Independiente</label>
                            </button>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('certificado', {{ $expediente->Nota->id }})">
                                <img src="{{asset('assets/user/icons/certificacion.webp')}}" class="img-fluid" style="width: 40%;">
                                <label for="">5. Certificados Conocer</label>
                            </button>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('cedula', {{ $expediente->Nota->id }})">
                                <img src="{{asset('assets/user/icons/cedula.png')}}" class="img-fluid" style="width: 40%;">
                                <label for="">6. Cedulas De Acreditación</label>
                            </button>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('nombramiento', {{ $expediente->Nota->id }})">
                                <img src="{{asset('assets/user/icons/certificate.png')}}" class="img-fluid" style="width: 40%;">
                                <label for="">7. Nombramiento</label>
                            </button>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-sm" id="btnArchivos3" onclick="mostrarArchivos('4')">
                                <img src="{{asset('assets/user/icons/book.png')}}" class="img-fluid" style="width: 40%;">
                                <label for="">8. Formatos Resolucion De Quejas</label>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-4 mt-xl-0 mt-4">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h6 class="mb-0">Documentos</h6>
                            <div class="col-md-4 text-end">
                                <a href="javascript:;">
                                <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Agregar"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div id="contenedorSubirArchivos" style="display: none;">
                        <form method="POST" action="{{ route('crear.nomb') }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input id="foto[]" name="foto[]" type="file" class="form-control" multiple>
                            <input id="id_nota" name="id_nota" type="number" value="{{ $expediente->Nota->id }}" style="display: none">
                            <input id="id_cliente" name="id_cliente" type="number" value="{{ $expediente->Nota->id_cliente }}" style="display: none">
                            <button type="submit" class="btn btn-sm" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                        </form>
                    </div>
                    <div id="contenedorArchivos" ></div>

                    <div id="contenedorCarpetas"></div>
                </div>
            </div>
        </div>
    </div>
</div>
