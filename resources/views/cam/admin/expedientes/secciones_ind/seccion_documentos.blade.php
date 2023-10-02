    <div class="row mt-3">

        <div class="col-12 col-md-6 ">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                        <h4 class="mb-0">Carpetas</h4>
                </div>
                <div class="card-body p-2">
                    <div class="row">
                        <div class="col-4">
                            <button class="btn btn-sm" id="btnArchivos1" onclick="mostrarArchivos('1')">
                                <img src="{{asset('assets/user/icons/manual.png')}}" class="img-fluid" style="width: 40%;">
                                <p class="text-sm"> <br>1. Manuales Digitales CONOCER</p>
                            </button>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('2')">
                                <img src="{{asset('assets/user/icons/information.png')}}" class="img-fluid" style="width: 40%;">
                                <p class="text-sm">2. Reglamento Y Manuales De Procedimientos IMNAS</p>
                            </button>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('estandares', {{ $expediente->Nota->id }}); mostrarCarpetasCompradas({{ $expediente->Nota->id }})">
                                <img src="{{asset('assets/user/icons/documentos.png')}}" class="img-fluid" style="width: 40%;">
                                <p class="text-sm"> <br>3. Formatos Estándares</p>
                            </button>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('3')">
                                <img src="{{asset('assets/user/logotipos/sepconocer.png')}}" class="img-fluid" style="width: 65%;">
                                <p class="text-sm"><br>4. Logo Conocer Evaluador Independiente</p>
                            </button>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('certificado', {{ $expediente->Nota->id }})">
                                <img src="{{asset('assets/user/icons/certificacion.webp')}}" class="img-fluid" style="width: 40%;">
                                <p class="text-sm"><br>5. Certificados Conocer</p>
                            </button>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-sm" id="btnArchivos2" onclick="mostrarArchivos('cedula', {{ $expediente->Nota->id }})">
                                <img src="{{asset('assets/user/icons/cedula.png')}}" class="img-fluid" style="width: 40%;">
                                <p class="text-sm"><br>6. Cedulas De Acreditación</p>
                            </button>
                        </div>
                        <div class="col-4">
                            <button class="btn btn-sm" id="btnArchivos3" onclick="mostrarArchivos('4')">
                                <img src="{{asset('assets/user/icons/book.png')}}" class="img-fluid" style="width: 40%;">
                                <p class="text-sm"><br>7. Formatos Resolucion De Quejas</p>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 ">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-8 d-flex align-items-center">
                            <h4 class="mb-0">Documentos en carpetas</h4>
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
                            <input type="hidden" id="categoria" name="categoria" value="certificados">
                            <input id="foto[]" name="foto[]" type="file" class="form-control" multiple>
                            <input id="id_nota" name="id_nota" type="number" value="{{ $expediente->Nota->id }}" style="display: none">
                            <input id="id_cliente" name="id_cliente" type="number" value="{{ $expediente->Nota->id_cliente }}" style="display: none">
                            <button type="submit" class="btn btn-sm mt-2" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                        </form>
                    </div>
                    <div id="contenedorSubirArchivosCedula" style="display: none;">
                        <form method="POST" action="{{ route('crear.nomb') }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" id="categoria" name="categoria" value="cedula">
                            <input id="foto[]" name="foto[]" type="file" class="form-control" multiple>
                            <input id="id_nota" name="id_nota" type="number" value="{{ $expediente->Nota->id }}" style="display: none">
                            <input id="id_cliente" name="id_cliente" type="number" value="{{ $expediente->Nota->id_cliente }}" style="display: none">
                            <button type="submit" class="btn btn-sm mt-2" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                        </form>
                    </div>
                    <div id="contenedorArchivos" ></div>

                    <div id="contenedorCarpetas"></div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-12 mt-3 ">
            <div class="card h-100">
                 <form method="POST" action="{{ route('expediente.check', $expediente->Nota->id) }}" enctype="multipart/form-data" role="form">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="card-header pb-0 p-3">
                            <div class="row">
                                <div class="col-8">
                                    <h4 class="mb-0">Documentos</h4>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-sm" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-3">
                            <div class="row">

                                <h6 class="" for="contrato_general">Contrato general</h6>
                                <div class="col-6">
                                    <div class="input-group mb-4">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets\cam\contrato_g.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="contrato_general" name="contrato_general" type="file" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-6">
                                    @if ($documentos->contrato_general != NULL)
                                        @if (pathinfo($documentos->contrato_general, PATHINFO_EXTENSION) == 'pdf')
                                            <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->contrato_general)}}" style="width: 60%; height: 60px;"></iframe>
                                            <p class="text-center ">
                                                <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->contrato_general) }}" target="_blank" style="background: #836262; color: #ffff!important
                                                ">Ver archivo</a>
                                            </p>
                                        @else
                                            <p class="text-center mt-2">
                                                <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->contrato_general) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->contrato_general) }}" target="_blank" style="background: #836262; color: #ffff!important
                                                ">Ver Imagen</a>
                                            </p>
                                        @endif
                                    @endif
                                </div>

                                <h6 class="" for="solicitud_acreditacion">Solicitud acreditacion </h6>
                                <div class="col-6">
                                    <div class="input-group mb-4">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets\cam\solicitud.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="solicitud_acreditacion" name="solicitud_acreditacion" type="file" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-6">
                                    @if ($documentos->solicitud_acreditacion != NULL)
                                        @if (pathinfo($documentos->solicitud_acreditacion, PATHINFO_EXTENSION) == 'pdf')
                                            <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->solicitud_acreditacion)}}" style="width: 60%; height: 60px;"></iframe>
                                            <p class="text-center ">
                                                <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->solicitud_acreditacion) }}" target="_blank" style="background: #836262; color: #ffff!important
                                                ">Ver archivo</a>
                                            </p>
                                        @else
                                            <p class="text-center mt-2">
                                                <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->solicitud_acreditacion) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->solicitud_acreditacion) }}" target="_blank" style="background: #836262; color: #ffff!important
                                                ">Ver Imagen</a>
                                            </p>
                                        @endif
                                    @endif
                                </div>

                                <h6 class="" for="carta_compromiso">Carta compromiso</h6>
                                <div class="col-6">
                                    <div class="input-group mb-4">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets\cam\carta.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="carta_compromiso" name="carta_compromiso" type="file" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-6">
                                    @if ($documentos->carta_compromiso != NULL)
                                        @if (pathinfo($documentos->carta_compromiso, PATHINFO_EXTENSION) == 'pdf')
                                            <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->carta_compromiso)}}" style="width: 60%; height: 60px;"></iframe>
                                            <p class="text-center ">
                                                <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->carta_compromiso) }}" target="_blank" style="background: #836262; color: #ffff!important
                                                ">Ver archivo</a>
                                            </p>
                                        @else
                                            <p class="text-center mt-2">
                                                <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->carta_compromiso) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->carta_compromiso) }}" target="_blank" style="background: #836262; color: #ffff!important
                                                ">Ver Imagen</a>
                                            </p>
                                        @endif
                                    @endif
                                </div>

                                <h6 class="" for="ine">INE</h6>
                                <div class="col-6">
                                    <div class="input-group mb-4">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets\cam\ine.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="ine" name="ine" type="file" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-6">
                                    @if ($documentos->ine != NULL)
                                        @if (pathinfo($documentos->ine, PATHINFO_EXTENSION) == 'pdf')
                                            <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->ine)}}" style="width: 60%; height: 60px;"></iframe>
                                            <p class="text-center ">
                                                <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->ine) }}" target="_blank" style="background: #836262; color: #ffff!important
                                                ">Ver archivo</a>
                                            </p>
                                        @else
                                            <p class="text-center mt-2">
                                                <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->ine) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->ine) }}" target="_blank" style="background: #836262; color: #ffff!important
                                                ">Ver Imagen</a>
                                            </p>
                                        @endif
                                    @endif
                                </div>

                                <h6 class="" for="curp">CURP</h6>
                                <div class="col-6">
                                    <div class="input-group mb-4">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets\user\icons\letter.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="curp" name="curp" type="file" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-6">
                                    @if ($documentos->curp != NULL)
                                        @if (pathinfo($documentos->curp, PATHINFO_EXTENSION) == 'pdf')
                                            <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->curp)}}" style="width: 60%; height: 60px;"></iframe>
                                            <p class="text-center ">
                                                <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->curp) }}" target="_blank" style="background: #836262; color: #ffff!important
                                                ">Ver archivo</a>
                                            </p>
                                        @else
                                            <p class="text-center mt-2">
                                                <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->curp) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->curp) }}" target="_blank" style="background: #836262; color: #ffff!important
                                                ">Ver Imagen</a>
                                            </p>
                                        @endif
                                    @endif
                                </div>

                                <h6 class="" for="foto">Foto </h6>
                                <div class="col-6">
                                    <div class="input-group mb-4">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets\user\icons\picture.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="foto" name="foto" type="file" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-6">
                                    @if ($documentos->foto != NULL)
                                        @if (pathinfo($documentos->foto, PATHINFO_EXTENSION) == 'pdf')
                                            <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->foto)}}" style="width: 60%; height: 60px;"></iframe>
                                            <p class="text-center ">
                                                <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->foto) }}" target="_blank" style="background: #836262; color: #ffff!important
                                                ">Ver archivo</a>
                                            </p>
                                        @else
                                            <p class="text-center mt-2">
                                                <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->foto) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->foto) }}" target="_blank" style="background: #836262; color: #ffff!important
                                                ">Ver Imagen</a>
                                            </p>
                                        @endif
                                    @endif
                                </div>

                                <h6 class="" for="acuerdo_confidencialidad">Comprobante Domicilio </h6>
                                <div class="col-6">
                                    <div class="input-group mb-4">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets\cam\comprobante.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="comprobante_domicilio" name="comprobante_domicilio" type="file" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-6">
                                    @if ($documentos->comprobante_domicilio != NULL)
                                        @if (pathinfo($documentos->comprobante_domicilio, PATHINFO_EXTENSION) == 'pdf')
                                            <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->comprobante_domicilio)}}" style="width: 60%; height: 60px;"></iframe>
                                            <p class="text-center ">
                                                <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->comprobante_domicilio) }}" target="_blank" style="background: #836262; color: #ffff!important
                                                ">Ver archivo</a>
                                            </p>
                                        @else
                                            <p class="text-center mt-2">
                                                <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->comprobante_domicilio) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->comprobante_domicilio) }}" target="_blank" style="background: #836262; color: #ffff!important
                                                ">Ver Imagen</a>
                                            </p>
                                        @endif
                                    @endif
                                </div>

                                <h6 class="" for="logo">Logo evaluador independiente</h6>
                                <div class="col-6">
                                    <div class="input-group mb-4">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets\user\logotipos/sin-logo.jpg') }}" alt="" width="35px">
                                        </span>
                                        <input id="logo" name="logo" type="file" class="form-control" value="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    @if ($documentos->logo != NULL)
                                        @if (pathinfo($documentos->logo, PATHINFO_EXTENSION) == 'pdf')
                                            <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->logo)}}" style="width: 60%; height: 60px;"></iframe>
                                            <p class="text-center ">
                                                <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->logo) }}" target="_blank" style="background: #836262; color: #ffff!important
                                                ">Ver archivo</a>
                                            </p>
                                        @else
                                            <p class="text-center mt-2">
                                                <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->logo) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->logo) }}" target="_blank" style="background: #836262; color: #ffff!important
                                                ">Ver Imagen</a>
                                            </p>
                                        @endif
                                    @endif
                                </div>

                                <h6 class="" for="carta_responsabilidad">Carta responsabilidad logo</h6>
                                <div class="col-6">
                                    <div class="input-group mb-4">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets\cam\carta_res.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="carta_responsabilidad" name="carta_responsabilidad" type="file" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-6">
                                    @if ($documentos->carta_responsabilidad != NULL)
                                        @if (pathinfo($documentos->carta_responsabilidad, PATHINFO_EXTENSION) == 'pdf')
                                            <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->carta_responsabilidad)}}" style="width: 60%; height: 60px;"></iframe>
                                            <p class="text-center ">
                                                <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->carta_responsabilidad) }}" target="_blank" style="background: #836262; color: #ffff!important
                                                ">Ver archivo</a>
                                            </p>
                                        @else
                                            <p class="text-center mt-2">
                                                <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->carta_responsabilidad) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->carta_responsabilidad) }}" target="_blank" style="background: #836262; color: #ffff!important
                                                ">Ver Imagen</a>
                                            </p>
                                        @endif
                                    @endif
                                </div>

                                <h6 class="" for="acta_nacimiento">Acta nacimiento</h6>
                                <div class="col-6">
                                    <div class="input-group mb-4">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets\cam\acta.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="acta_nacimiento" name="acta_nacimiento" type="file" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-6">
                                    @if ($documentos->acta_nacimiento != NULL)
                                        @if (pathinfo($documentos->acta_nacimiento, PATHINFO_EXTENSION) == 'pdf')
                                            <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->acta_nacimiento)}}" style="width: 60%; height: 60px;"></iframe>
                                            <p class="text-center ">
                                                <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->acta_nacimiento) }}" target="_blank" style="background: #836262; color: #ffff!important
                                                ">Ver archivo</a>
                                            </p>
                                        @else
                                            <p class="text-center mt-2">
                                                <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->acta_nacimiento) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->acta_nacimiento) }}" target="_blank" style="background: #836262; color: #ffff!important
                                                ">Ver Imagen</a>
                                            </p>
                                        @endif
                                    @endif
                                </div>

                                <h6 class="" for="curriculum">Curriculum </h6>
                                <div class="col-6">
                                    <div class="input-group mb-4">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets\cam\cv.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="curriculum" name="curriculum" type="file" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-6">
                                    @if ($documentos->curriculum != NULL)
                                        @if (pathinfo($documentos->curriculum, PATHINFO_EXTENSION) == 'pdf')
                                            <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->curriculum)}}" style="width: 60%; height: 60px;"></iframe>
                                            <p class="text-center ">
                                                <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->curriculum) }}" target="_blank" style="background: #836262; color: #ffff!important
                                                ">Ver archivo</a>
                                            </p>
                                        @else
                                            <p class="text-center mt-2">
                                                <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->curriculum) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->curriculum) }}" target="_blank" style="background: #836262; color: #ffff!important
                                                ">Ver Imagen</a>
                                            </p>
                                        @endif
                                    @endif
                                </div>

                                <h6 class="" for="acuerdo_confidencialidad">Acuerdo confidencialidad </h6>
                                <div class="col-6">
                                    <div class="input-group mb-4">
                                        <span class="input-group-text" id="basic-addon1">
                                            <img src="{{ asset('assets\cam\folder.png') }}" alt="" width="35px">
                                        </span>
                                        <input id="acuerdo_confidencialidad" name="acuerdo_confidencialidad" type="file" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-6">
                                    @if ($documentos->acuerdo_confidencialidad != NULL)
                                    @if (pathinfo($documentos->acuerdo_confidencialidad, PATHINFO_EXTENSION) == 'pdf')
                                        <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->acuerdo_confidencialidad)}}" style="width: 60%; height: 60px;"></iframe>
                                        <p class="text-center ">
                                            <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->acuerdo_confidencialidad) }}" target="_blank" style="background: #836262; color: #ffff!important
                                            ">Ver archivo</a>
                                        </p>
                                    @else
                                        <p class="text-center mt-2">
                                            <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->acuerdo_confidencialidad) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                            <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->acuerdo_confidencialidad) }}" target="_blank" style="background: #836262; color: #ffff!important
                                            ">Ver Imagen</a>
                                        </p>
                                    @endif
                                @endif
                            </div>

                            <h6 class="" for="acuerdo_confidencialidad">Contrato individual </h6>
                            <div class="col-6">
                                <div class="input-group mb-4">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets\cam\contrato.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="contrato_individual" name="contrato_individual" type="file" class="form-control" >
                                </div>
                            </div>
                            <div class="col-6">
                                @if ($documentos->contrato_individual != NULL)
                                    @if (pathinfo($documentos->contrato_individual, PATHINFO_EXTENSION) == 'pdf')
                                        <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->contrato_individual)}}" style="width: 60%; height: 60px;"></iframe>
                                        <p class="text-center ">
                                            <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->contrato_individual) }}" target="_blank" style="background: #836262; color: #ffff!important
                                            ">Ver archivo</a>
                                        </p>
                                    @else
                                        <p class="text-center mt-2">
                                            <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->contrato_individual) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                            <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->contrato_individual) }}" target="_blank" style="background: #836262; color: #ffff!important
                                            ">Ver Imagen</a>
                                        </p>
                                    @endif
                                @endif
                            </div>


                            <h6 class="" for="acuerdo_confidencialidad">Nombramiento</h6>
                            <div class="col-6">
                                <div class="input-group mb-4">
                                    <span class="input-group-text" id="basic-addon1">
                                        <img src="{{ asset('assets\user\icons\stamp.png') }}" alt="" width="35px">
                                    </span>
                                    <input id="nombramiento" name="nombramiento" type="file" class="form-control" >
                                </div>
                            </div>
                            <div class="col-6">
                                @if ($documentos->nombramiento != NULL)
                                    @if (pathinfo($documentos->nombramiento, PATHINFO_EXTENSION) == 'pdf')
                                        <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->nombramiento)}}" style="width: 60%; height: 60px;"></iframe>
                                        <p class="text-center ">
                                            <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->nombramiento) }}" target="_blank" style="background: #836262; color: #ffff!important
                                            ">Ver archivo</a>
                                        </p>
                                    @else
                                        <p class="text-center mt-2">
                                            <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->nombramiento) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                            <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->nombramiento) }}" target="_blank" style="background: #836262; color: #ffff!important
                                            ">Ver Imagen</a>
                                        </p>
                                    @endif
                                @endif
                            </div>

                            <div class="col-6">
                                <button type="submit" class="btn btn-sm" style="background: #6EC1E4; color: #ffff;">Guardar</button>

                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
