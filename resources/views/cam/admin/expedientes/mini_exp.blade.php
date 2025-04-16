@extends('layouts.app_admin')

@section('template_title')
Expediente
@endsection

@section('content')

<div class="container-fluid ">

    <div class="row mt-3">
        <div class="col-12">
          <div class="card overflow-scroll">
            <div class="card-body d-flex">
              <div class="col-lg-1 col-md-2 col-sm-3 col-4 text-center">
                <a data-bs-toggle="modal" data-bs-target="#exampleModal" class="avatar avatar-lg border-1 rounded-circle bg-gradient-info">
                  <i class="fas fa-plus text-white"></i>
                </a>
                <p class="mb-0 text-sm" style="margin-top:6px;">Agregar</p>
              </div>
              @include('cam.admin.expedientes.modal_nuevo_expediente')
                @foreach ($minis_exps as $minis_exp)
                    <div class="col-lg-1 col-md-2 col-sm-3 col-4 text-center">
                        <a href="{{ route('edit.mini_exp', $minis_exp->id) }}" class="avatar avatar-lg rounded-circle border border-info">
                            @if ($documentos->acta == NULL)
                                <img src="{{asset('assets/user/logotipos/sin-logo.jpg')}}" alt="Image placeholder" class="p-1">
                            @else
                                <img src="{{asset('cam/doc/'. $documentos->Nota->Cliente->telefono . '/' .$documentos->logo)}}" alt="Image placeholder" class="p-1">
                            @endif
                        </a>
                        <p class="mb-0 text-sm">{{$minis_exp->nombre}}</p>
                    </div>
                @endforeach
            </div>
          </div>
        </div>
      </div>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <div class="container-fluid ">
                    <div class="row mt-3">

                        <div class="col-12 ">
                            <div class="card h-100">
                                <div class="card-body p-3 pt-1 mt-2">
                                    <div class="bg-gray-100 border-radius-lg">
                                        <a href="{{ route('expediente.edit_centro', $mini_exp->id_nota) }}" class="btn btn-sm mt-2" style="background: #161616; color: #ffff;">Regresar</a>
                                    </div>

                                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nombre:</strong> &nbsp; {{$mini_exp->nombre}} {{$mini_exp->apellido}}</li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Celular:</strong> &nbsp; {{$mini_exp->celular}}</li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Telefono:</strong> &nbsp; {{$mini_exp->telefono}}</li>
                                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Correo:</strong> &nbsp; {{$mini_exp->email}}</li>
                                    <hr class="horizontal dark">
                                    <div class="row">
                                        <h4>Claves módulo de evaluación</h4>
                                        <div class="col-3">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Usuario</p>
                                            <input id="usuario" name="usuario" class="form-control" type="text" placeholder="usuario" value="{{ $mini_exp->usuario }}">
                                        </div>
                                        <div class="col-3">
                                            <p class="text-sm mb-0 text-uppercase font-weight-bold">Contraseña</p>
                                            <input id="password" name="password" class="form-control" type="text" placeholder="contraseña" value="{{ $mini_exp->password }}">
                                        </div>
                                        <div class="col-3">
                                            <br>
                                            <button type="submit" class="btn btn-sm" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                                        </div>

                                        <hr class="horizontal dark">
                                        <h4>Agregar Estandar</h4>

                                        <form method="POST" action="{{ route('crear_estandar.mini_exp') }}" enctype="multipart/form-data" role="form">
                                            @csrf
                                            <div class="row">
                                                <input id="id_nota" name="id_nota" type="number" value="{{ $mini_exp->id_nota }}" style="display: none">
                                                <input id="id" name="id" type="number" value="{{ $mini_exp->id }}" style="display: none">
                                                <div class="col-4">
                                                    <h6 for="">Seleccione estandar *</h6>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets\user\icons\certificate.png') }}" alt="" width="35px">
                                                        </span>
                                                        <select name="id_estandar" class="form-select d-inline-block js-example-basic-multiple" style="width: 70%!important;" required>
                                                            @foreach ($estandares_cam_user as $estandar_cam)
                                                                {{-- <option value="{{$estandar_cam->id_estandar}}">{{$estandar_cam->Estandar->estandar}}</option> --}}
                                                                <option value="{{ $estandar_cam->id }}" {{ in_array($estandar_cam->id, old('estandares', [])) ? 'selected' : '' }}>
                                                                    {{$estandar_cam->nombre}}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-4">
                                                    <h6 for="contrato_general">Fecha evaluación </h6>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets\user\icons\letter.png') }}" alt="" width="35px">
                                                        </span>
                                                        <input id="fecha_evaluar" name="fecha_evaluar" class="form-control" type="date">
                                                    </div>
                                                </div>

                                                <div class="col-2">
                                                    <label for="name">Estatus </label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text" id="basic-addon1">
                                                            <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                                                        </span>
                                                        <select name="estatus" id="estatus" class="form-select d-inline-block">
                                                            <option value="Programado">Programado</option>
                                                            <option value="Evaluado">Evaluado</option>
                                                            <option value="En proceso">En proceso</option>
                                                            <option value="Entregado">Entregado</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-2">
                                                    <br>
                                                    <div class="bg-gray-100 border-radius-lg">
                                                        <button type="submit" class="btn btn-sm mt-2" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>

                                        <hr class="horizontal dark">
                                        <h5>Estandares</h5>
                                        @foreach ($estandares_cam_mini as $estandar_cam_mini)
                                            <form method="POST" action="{{ route('crear_estandar.mini_exp', $estandar_cam_mini->id) }}" enctype="multipart/form-data" role="form">
                                                @csrf
                                                <input type="hidden" name="_method" value="PATCH">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <h6 for="">Estandar</h6>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets\user\icons\certificate.png') }}" alt="" width="35px">
                                                            </span>
                                                            <select name="id_estandar" class="form-select d-inline-block js-example-basic-multiple" style="width: 70%!important;" required>
                                                                <option value="{{$estandar_cam_mini->id_estandar}}">{{$estandar_cam_mini->Estandar->estandar}}</option>
                                                                @foreach ($estandares_cam_user as $estandar_cam)
                                                                    <option value="{{$estandar_cam->id_estandar}}">{{$estandar_cam->Estandar->estandar}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-4">
                                                        <h6 for="contrato_general">Fecha de evaluación</h6>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets\user\icons\letter.png') }}" alt="" width="35px">
                                                            </span>
                                                            <input id="fecha" name="fecha" class="form-control" type="date" value="{{$estandar_cam_mini->fecha_evaluar}}" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-2">
                                                        <label for="name">Estatus</label>
                                                        <div class="input-group mb-3">
                                                            <span class="input-group-text" id="basic-addon1">
                                                                <img src="{{ asset('assets/cam/nombre.png') }}" alt="" width="35px">
                                                            </span>
                                                            <select name="estatus" id="estatus" class="form-select d-inline-block" required>
                                                                <option value="{{$estandar_cam_mini->estatus}}">{{$estandar_cam_mini->estatus}}</option>
                                                                <option value="Programado">Programado</option>
                                                                <option value="Evaluado">Evaluado</option>
                                                                <option value="En proceso">En proceso</option>
                                                                <option value="Entregado">Entregado</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-2">
                                                        <br>
                                                        <div class="bg-gray-100 border-radius-lg">
                                                            <button type="submit" class="btn btn-sm mt-2" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        @endforeach

                                    </div>

                                    <hr class="horizontal dark">
                                    <h4>Documentos</h4>

                                    <form method="POST" action="{{ route('update.mini_exp', $mini_exp->id) }}" enctype="multipart/form-data" role="form">
                                        @csrf
                                        <input type="hidden" name="_method" value="PATCH">
                                            <div class="bg-gray-100 border-radius-lg">
                                                <button type="submit" class="btn btn-sm mt-2" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                                            </div>

                                            <div class="row">
                                                <div class="col-6 mt-3">
                                                    <h6 for="acta">Acta de Naciemiento </h6>
                                                    <input id="acta" name="acta" type="file" class="form-control" value="">
                                                        @if ($mini_exp->acta != NULL)
                                                            @if (pathinfo($mini_exp->acta, PATHINFO_EXTENSION) == 'pdf')
                                                                <iframe class="mt-2" src="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp->acta)}}" style="width: 60%; height: 60px;"></iframe>
                                                                <p class="text-center ">
                                                                    <a class="btn btn-sm text-dark" href="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp->acta) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                                                </p>
                                                            @else
                                                                <p class="text-center mt-2">
                                                                    <img id="blah" src="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp->acta) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp->acta) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                                                </p>
                                                            @endif
                                                    @endif
                                                </div>

                                                <div class="col-6 mt-3">
                                                    <h6 for="curp">CURP</h6>
                                                    <input id="curp" name="curp" type="file" class="form-control" value="">
                                                        @if ($mini_exp->curp != NULL)
                                                            @if (pathinfo($mini_exp->curp, PATHINFO_EXTENSION) == 'pdf')
                                                                <iframe class="mt-2" src="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp->curp)}}" style="width: 60%; height: 60px;"></iframe>
                                                                <p class="text-center ">
                                                                    <a class="btn btn-sm text-dark" href="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp->curp) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                                                </p>
                                                            @else
                                                                <p class="text-center mt-2">
                                                                    <img id="blah" src="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp->curp) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp->curp) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                                                </p>
                                                            @endif
                                                    @endif
                                                </div>

                                                <div class="col-6 mt-3">
                                                    <h6 for="ine">INE</h6>
                                                    <input id="ine" name="ine" type="file" class="form-control" value="">
                                                        @if ($mini_exp->ine != NULL)
                                                            @if (pathinfo($mini_exp->ine, PATHINFO_EXTENSION) == 'pdf')
                                                                <iframe class="mt-2" src="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp->ine)}}" style="width: 60%; height: 60px;"></iframe>
                                                                <p class="text-center ">
                                                                    <a class="btn btn-sm text-dark" href="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp->ine) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                                                </p>
                                                            @else
                                                                <p class="text-center mt-2">
                                                                    <img id="blah" src="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp->ine) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp->ine) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                                                </p>
                                                            @endif
                                                    @endif
                                                </div>

                                                <div class="col-6 mt-3">
                                                    <h6 for="comprobante">Comprobante de domicilio</h6>
                                                    <input id="comprobante" name="comprobante" type="file" class="form-control" value="">
                                                        @if ($mini_exp->comprobante != NULL)
                                                            @if (pathinfo($mini_exp->comprobante, PATHINFO_EXTENSION) == 'pdf')
                                                                <iframe class="mt-2" src="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp->comprobante)}}" style="width: 60%; height: 60px;"></iframe>
                                                                <p class="text-center ">
                                                                    <a class="btn btn-sm text-dark" href="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp->comprobante) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                                                </p>
                                                            @else
                                                                <p class="text-center mt-2">
                                                                    <img id="blah" src="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp->comprobante) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp->comprobante) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                                                </p>
                                                            @endif
                                                    @endif
                                                </div>

                                                <div class="col-6 mt-3">
                                                    <h6 for="comprobante">Contrato individual</h6>
                                                    <input id="contrato_individual" name="contrato_individual" type="file" class="form-control" value="">
                                                        @if ($mini_exp->contrato_individual != NULL)
                                                            @if (pathinfo($mini_exp->contrato_individual, PATHINFO_EXTENSION) == 'pdf')
                                                                <iframe class="mt-2" src="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp->contrato_individual)}}" style="width: 60%; height: 60px;"></iframe>
                                                                <p class="text-center ">
                                                                    <a class="btn btn-sm text-dark" href="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp->contrato_individual) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                                                </p>
                                                            @else
                                                                <p class="text-center mt-2">
                                                                    <img id="blah" src="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp->contrato_individual) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp->contrato_individual) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                                                </p>
                                                            @endif
                                                    @endif
                                                </div>

                                                <div class="col-6 mt-3">
                                                    <h6 for="comprobante">Confidencialidad</h6>
                                                    <input id="confidencialidad" name="confidencialidad" type="file" class="form-control" value="">
                                                        @if ($mini_exp->confidencialidad != NULL)
                                                            @if (pathinfo($mini_exp->confidencialidad, PATHINFO_EXTENSION) == 'pdf')
                                                                <iframe class="mt-2" src="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp->confidencialidad)}}" style="width: 60%; height: 60px;"></iframe>
                                                                <p class="text-center ">
                                                                    <a class="btn btn-sm text-dark" href="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp->confidencialidad) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                                                </p>
                                                            @else
                                                                <p class="text-center mt-2">
                                                                    <img id="blah" src="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp->confidencialidad) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp->confidencialidad) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                                                </p>
                                                            @endif
                                                    @endif
                                                </div>

                                                <hr class="horizontal dark my-3">

                                                <h6 class="mt-3">Diplomas extras</h6>
                                                <div class="col-6">
                                                    <input id="diplomas" name="diplomas[]" type="file" class="form-control" value="" multiple>
                                                </div>

                                                <div class="col-6 mt-3">
                                                </div>

                                                @foreach ($mini_exp_diplomas as $mini_exp_diploma)
                                                    <div class="col-3 mt-3">
                                                        @if ($mini_exp_diploma->diplomas != NULL)
                                                            @if (pathinfo($mini_exp_diploma->diplomas, PATHINFO_EXTENSION) == 'pdf')
                                                                <iframe class="mt-2" src="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp_diploma->diplomas)}}" style="width: 60%; height: 60px;"></iframe>
                                                                <p class="text-center ">
                                                                    <a class="btn btn-sm text-dark" href="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp_diploma->diplomas) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                                                </p>
                                                            @else
                                                                <p class="text-center mt-2">
                                                                    <img id="blah" src="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp_diploma->diplomas) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp_diploma->diplomas) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                                                </p>
                                                            @endif
                                                        @endif
                                                    </div>
                                                @endforeach

                                                <h6 class="mt-3">Nombramientos</h6>

                                                <div class="col-6">
                                                    <input id="nombramientos" name="nombramientos[]" type="file" class="form-control" value="" multiple>
                                                </div>

                                                <div class="col-6 mt-3">
                                                </div>

                                                @foreach ($minis_exp_nom as $mini_exp_nom)
                                                    <div class="col-3 mt-3">
                                                        @if ($mini_exp_nom->nombre != NULL)
                                                            @if (pathinfo($mini_exp_nom->nombre, PATHINFO_EXTENSION) == 'pdf')
                                                                <iframe class="mt-2" src="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp_nom->nombre)}}" style="width: 60%; height: 60px;"></iframe>
                                                                <p class="text-center ">
                                                                    <a class="btn btn-sm text-dark" href="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp_nom->nombre) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                                                </p>
                                                            @else
                                                                <p class="text-center mt-2">
                                                                    <img id="blah" src="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp_nom->nombre) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp_nom->nombre) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                                                </p>
                                                            @endif
                                                        @endif
                                                    </div>
                                                @endforeach

                                                <h6 class="mt-3">Certificados CONOCER</h6>

                                                <div class="col-6">
                                                    <input id="certificados" name="certificados[]" type="file" class="form-control" value="" multiple>
                                                </div>

                                                <div class="col-6 mt-3">
                                                </div>

                                                @foreach ($minis_exp_cer as $mini_exp_nom)
                                                    <div class="col-3 mt-3">
                                                        @if ($mini_exp_nom->nombre != NULL)
                                                            @if (pathinfo($mini_exp_nom->nombre, PATHINFO_EXTENSION) == 'pdf')
                                                                <iframe class="mt-2" src="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp_nom->nombre)}}" style="width: 60%; height: 60px;"></iframe>
                                                                <p class="text-center ">
                                                                    <a class="btn btn-sm text-dark" href="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp_nom->nombre) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                                                </p>
                                                            @else
                                                                <p class="text-center mt-2">
                                                                    <img id="blah" src="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp_nom->nombre) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$mini_exp_nom->nombre) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
                                                                </p>
                                                            @endif
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>


                                    </form>
                                </div>

                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>


    </div>

@endsection

@section('datatable')

@endsection
