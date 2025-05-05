@extends('layouts.app_cam')

@section('template_title')
    Centro evaluador
@endsection

@section('css_custom')
    <link href="{{asset('assets/cam/estilos/custom.css')}}" rel="stylesheet" />
@endsection

@section('content')

<section class="cam_bg_videos" style="background-color: #6EC1E4; ">

    <div class="row">

        <div class="col-12 mb-5 mt-5">
            <h1 class="text-center tittle_border_cam">Cargar Documentos Generales <br>

                @if($usuario->user_cam == '4')
                    Centro Evaluador
                @else
                    Evaluador independiente
                @endif

                <br>
                <a class="text-center btn btn-lg btn-outline-light " href="{{ route('cam.index', auth()->user()->code) }}">Regresar al inicio</a>

            </h1>


        </div>

        <form method="POST" action="{{ route('expediente.check', $expediente->Nota->id) }}" enctype="multipart/form-data" role="form">
            @csrf
            <input type="hidden" name="_method" value="PATCH">
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-8">
                        <h4 class="mb-0">Documentos</h4>
                    </div>
                    <div class="col-4">
                        <button type="submit" class="btn" style="background: #225266; color: #ffff;">Guardar</button>
                    </div>
                </div>
            </div>
            <div class="card-body p-3">
                <div class="row">

                    <h6 for="contrato_general">Contrato general</h6>
                    <div class="col-6 mb-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets\cam\contrato_g.png') }}" alt="" width="35px">
                            </span>
                            <input id="contrato_general" name="contrato_general" type="file" class="form-control" >
                        </div>
                    </div>
                    <div class="col-6 mb-3">
                        @if ($documentos->contrato_general != NULL)
                            @if (pathinfo($documentos->contrato_general, PATHINFO_EXTENSION) == 'pdf')
                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->contrato_general)}}" style="width: 60%; height: 60px;"></iframe>
                                <p class="text-center ">
                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->contrato_general) }}" target="_blank" style="background: #836262; color: #ffff!important
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


                    @if($usuario->user_cam == '4')

                    @else

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

                    @endif


                    <h6 for="carta_compromiso">Carta compromiso</h6>
                    <div class="col-6 mb-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets\cam\carta.png') }}" alt="" width="35px">
                            </span>
                            <input id="carta_compromiso" name="carta_compromiso" type="file" class="form-control" >
                        </div>
                    </div>
                    <div class="col-6 mb-3">
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

                    <h6 for="ine">INE</h6>
                    <div class="col-6 mb-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets\cam\ine.png') }}" alt="" width="35px">
                            </span>
                            <input id="ine" name="ine" type="file" class="form-control" >
                        </div>
                    </div>
                    <div class="col-6 mb-3">
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

                    <h6 for="curp">CURP</h6>
                    <div class="col-6 mb-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets\user\icons\letter.png') }}" alt="" width="35px">
                            </span>
                            <input id="curp" name="curp" type="file" class="form-control" >
                        </div>
                    </div>
                    <div class="col-6 mb-3">
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

                    <h6 for="foto">Foto </h6>
                    <div class="col-6 mb-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets\user\icons\picture.png') }}" alt="" width="35px">
                            </span>
                            <input id="foto" name="foto" type="file" class="form-control" >
                        </div>
                    </div>
                    <div class="col-6 mb-3">
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

                    <h6 for="acuerdo_confidencialidad">Comprobante Domicilio </h6>
                    <div class="col-6 mb-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets\cam\comprobante.png') }}" alt="" width="35px">
                            </span>
                            <input id="comprobante_domicilio" name="comprobante_domicilio" type="file" class="form-control" >
                        </div>
                    </div>
                    <div class="col-6 mb-3">
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

                    @if($usuario->user_cam == '4')
                        <h6 for="logo">Logo centro evaluador</h6>

                    @else
                        <h6 for="logo">Evaluador independiente</h6>

                    @endif

                    <div class="col-6 mb-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets\user\logotipos/sin-logo.jpg') }}" alt="" width="35px">
                            </span>
                            <input id="logo" name="logo" type="file" class="form-control" value="">
                        </div>
                    </div>
                    <div class="col-6 mb-3">
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

                    <h6 for="carta_responsabilidad">Carta responsabilidad logo</h6>
                    <div class="col-6 mb-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets\cam\carta_res.png') }}" alt="" width="35px">
                            </span>
                            <input id="carta_responsabilidad" name="carta_responsabilidad" type="file" class="form-control" >
                        </div>
                    </div>
                    <div class="col-6 mb-3">
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

                    <h6 for="acta_nacimiento">Acta nacimiento</h6>
                    <div class="col-6 mb-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets\cam\acta.png') }}" alt="" width="35px">
                            </span>
                            <input id="acta_nacimiento" name="acta_nacimiento" type="file" class="form-control" >
                        </div>
                    </div>
                    <div class="col-6 mb-3">
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

                    <h6 for="curriculum">Curriculum </h6>
                    <div class="col-6 mb-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets\cam\cv.png') }}" alt="" width="35px">
                            </span>
                            <input id="curriculum" name="curriculum" type="file" class="form-control" >
                        </div>
                    </div>
                    <div class="col-6 mb-3">
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

                    <h6 for="acuerdo_confidencialidad">Acuerdo confidencialidad </h6>
                    <div class="col-6 mb-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets\cam\folder.png') }}" alt="" width="35px">
                            </span>
                            <input id="acuerdo_confidencialidad" name="acuerdo_confidencialidad" type="file" class="form-control" >
                        </div>
                    </div>
                    <div class="col-6 mb-3">
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

                <h6 for="acuerdo_confidencialidad">Contrato individual </h6>
                <div class="col-6">
                    <div class="input-group mb-2">
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


                @if($usuario->user_cam == '4')
                    <h6 class="" for="rfc">RFC</h6>
                    <div class="col-6 mb-3">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">
                                <img src="{{ asset('assets\user\icons\qr.png') }}" alt="" width="35px">
                            </span>
                            <input id="rfc" name="rfc" type="file" class="form-control" >
                        </div>
                    </div>
                    <div class="col-6">
                        @if ($documentos->rfc != NULL)
                            @if (pathinfo($documentos->rfc, PATHINFO_EXTENSION) == 'pdf')
                                <iframe class="mt-2" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->rfc)}}" style="width: 60%; height: 60px;"></iframe>
                                <p class="text-center ">
                                    <a class="btn btn-sm text-dark" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->rfc) }}" target="_blank" style="background: #836262; color: #ffff!important
                                    ">Ver archivo</a>
                                </p>
                            @else
                                <p class="text-center mt-2">
                                    <img id="blah" src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->rfc) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->rfc) }}" target="_blank" style="background: #836262; color: #ffff!important
                                    ">Ver Imagen</a>
                                </p>
                            @endif
                        @endif
                    </div>
                @else

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

                @endif



            </div>
        </div>
        </form>

    </div>

</section>

@endsection
