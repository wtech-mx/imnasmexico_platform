@extends('layouts.app_admin')

@section('template_title')
Expediente
@endsection

@section('content')

<div class="container-fluid ">

    <form method="POST" action="{{ route('update_exp_user', $expediente->Nota->Cliente->id) }}" enctype="multipart/form-data" role="form">
        @csrf
        <input type="hidden" name="_method" value="PATCH">
            <div class="row mt-n2 mb-3">
                <div class="col-lg-8 col-12">
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            @if ($expediente->Nota->Cliente->estatus_exp == '0' || $expediente->Nota->Cliente->estatus_exp == NULL)
                                <div class="card card-background card-background-mask-danger h-100">
                            @else
                                <div class="card card-background card-background-mask-success h-100">
                            @endif
                                <div class="full-background" style="background-image: url({{asset('assets/user/instalaciones/salon.jpg')}})"></div>
                                <div class="card-body pt-4 text-center">
                                    <h3 class="text-white mb-0">{{ $expediente->Nota->Cliente->num_user }}</h3>
                                    <h4 class="text-white">${{ $expediente->Nota->Cliente->costo_emi }}.00 mxn</h4>
                                    <span class="badge d-block bg-gradient-dark mb-2">{{ $expediente->Nota->Cliente->curp }}</span>
                                    @if ($expediente->Nota->Cliente->estatus_exp == '0' || $expediente->Nota->Cliente->estatus_exp == NULL)
                                        <h5 class="text-white mb-0">EN PROCESO. </h5>
                                    @else
                                        <h5 class="text-white mb-0">COMPLETO Y LISTO PARA LA OPERACIÓN. SE COMPARTÍO AL EVALUADOR INDEPENDIENTE TODOS LOS ARCHIVOS NECESARIOS PARA LA OPERACIÓN </h5>
                                    @endif
                                    {{-- <a href="javascript:;" class="btn btn-outline-white btn-sm px-5 mb-0">View more</a> --}}
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12 mt-4 mt-lg-0">
                            <div class="card">
                                <div class="card-body p-3">
                                <div class="d-flex">
                                    <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">No SEP</p>
                                    <input id="num_user" name="num_user" class="form-control" type="text" placeholder="numero usuario" value="{{ $expediente->Nota->Cliente->num_user }}">
                                    </div>
                                    <div class="icon icon-shape bg-gradient-dark text-center rounded-circle ms-auto">
                                    <i class="fa fa-id-card-o text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <div class="card mt-4">
                                <div class="card-body p-3">
                                <div class="d-flex">
                                    <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">User</p>
                                    <input id="usuario_eva" name="usuario_eva" class="form-control" type="text" value="{{ $expediente->Nota->Cliente->usuario_eva }}">
                                    </div>
                                    <div class="icon icon-shape bg-gradient-dark text-center rounded-circle ms-auto">
                                    <i class="fa fa-user text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-12 mt-4 mt-lg-0">
                            <div class="card">
                                <div class="card-body p-3">
                                <div class="d-flex">
                                    <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Costo emisión</p>
                                    <input id="costo_emi" name="costo_emi" class="form-control" type="text" value="{{ $expediente->Nota->Cliente->costo_emi }}">
                                    </div>
                                    <div class="icon icon-shape bg-gradient-dark text-center rounded-circle ms-auto">
                                    <i class="fa fa-money text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <div class="card mt-4">
                                <div class="card-body p-3">
                                <div class="d-flex">
                                    <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Contraseña</p>
                                    <input id="contrasena_eva" name="contrasena_eva" class="form-control" type="text" value="{{ $expediente->Nota->Cliente->contrasena_eva }}">
                                    </div>
                                    <div class="icon icon-shape bg-gradient-dark text-center rounded-circle ms-auto">
                                    <i class="fa fa-key text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-12">
                    <div class="card">

                        <div class="card-body p-3 pt-1 mt-2">
                            <h6>Inicio y fin de operaciones.</h6>
                                @php
                                    $fecha = $expediente->Nota->created_at;
                                    // Convertir a una marca de tiempo Unix
                                    $timestamp = strtotime($fecha);
                                    // Obtener la fecha con un año adicional
                                    $nueva_fecha_timestamp = strtotime('+1 year', $timestamp);
                                    // Formatear la fecha original
                                    $fecha_formateada = strftime('%e de %B del %Y', $timestamp);
                                    // Formatear la fecha con un año adicional
                                    $nueva_fecha_formateada = strftime('%e de %B del %Y', $nueva_fecha_timestamp);
                                    // Formatear la hora
                                    $hora_formateada = date('h:i A', $timestamp);
                                    // Combinar fecha y hora
                                    $fecha_hora_formateada = $fecha_formateada;
                                    // Combinar nueva fecha y hora (con un año adicional)
                                    $fecha_hora_fin = $nueva_fecha_formateada;
                                @endphp
                            <p class="text-sm">{{ $fecha_hora_formateada}}</p>
                            <p class="text-sm">{{ $fecha_hora_fin}}</p>

                            <span class="me-2 text-sm font-weight-bold text-capitalize">Progreso Videos</span>
                                @php
                                    $progress = 0;
                                    if ($video->check1 == NULL) {
                                        $progress = 0;
                                    }elseif ($video->check2 == NULL) {
                                        $progress = 10;
                                    }elseif ($video->check3 == NULL) {
                                        $progress = 20;
                                    }elseif ($video->check4 == NULL) {
                                        $progress = 30;
                                    }elseif ($video->check5 == NULL) {
                                        $progress = 40;
                                    }elseif ($video->check6 == NULL) {
                                        $progress = 50;
                                    }elseif ($video->check7 == NULL) {
                                        $progress = 60;
                                    }elseif ($video->check8 == NULL) {
                                        $progress = 70;
                                    }elseif ($video->check9 == NULL) {
                                        $progress = 80;
                                    }elseif ($video->check10 == NULL) {
                                        $progress = 90;
                                    }else {
                                        $progress = 100;
                                    }
                                @endphp
                                <span class="ms-auto text-sm font-weight-bold">{{ $progress }}%</span>
                            <div>
                                <div class="progress progress-md">
                                <div class="progress-bar bg-gradient-info" role="progressbar" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $progress }}%;"></div>
                                </div>
                            </div>

                            <div class="d-flex bg-gray-100 border-radius-lg p-3">
                                <button type="submit" class="btn btn-sm mt-2" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>

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
                                        <h5>Claves SII</h5>
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
                                    </div>
                                    <hr class="horizontal dark">
                                    <h5>Documentos</h5>

                                    <form method="POST" action="{{ route('update.mini_exp', $mini_exp->id) }}" enctype="multipart/form-data" role="form">
                                        @csrf
                                        <input type="hidden" name="_method" value="PATCH">
                                            <div class="bg-gray-100 border-radius-lg">
                                                <button type="submit" class="btn btn-sm mt-2" style="background: #6EC1E4; color: #ffff;">Guardar</button>
                                            </div>

                                            <div class="row">
                                                <div class="col-6 mt-3">
                                                    <label for="acta">Acta de Naciemiento </label>
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
                                                    <label for="curp">CURP</label>
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
                                                    <label for="ine">INE</label>
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
                                                    <label for="comprobante">Comprobante de domicilio</label>
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

                                                <h5 class="mt-3">Diplomas</h5>
                                                <div class="col-6">
                                                    <label for="diplomas">Subir diplomas</label>
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

                                                <h5 class="mt-3">Nombramientos</h5>

                                                <div class="col-6">
                                                    <label for="nombramientos">Subir nombramientos</label>
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

                                                <h5 class="mt-3">Cedulas</h5>

                                                <div class="col-6">
                                                    <label for="cedulas">Subir cedulas</label>
                                                    <input id="cedulas" name="cedulas[]" type="file" class="form-control" value="" multiple>
                                                </div>

                                                <div class="col-6 mt-3">
                                                </div>

                                                @foreach ($minis_exp_ced as $minis_exp_ced)
                                                    <div class="col-3 mt-3">
                                                        @if ($minis_exp_ced->nombre != NULL)
                                                            @if (pathinfo($minis_exp_ced->nombre, PATHINFO_EXTENSION) == 'pdf')
                                                                <iframe class="mt-2" src="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$minis_exp_ced->nombre)}}" style="width: 60%; height: 60px;"></iframe>
                                                                <p class="text-center ">
                                                                    <a class="btn btn-sm text-dark" href="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$minis_exp_ced->nombre) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver archivo</a>
                                                                </p>
                                                            @else
                                                                <p class="text-center mt-2">
                                                                    <img id="blah" src="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$minis_exp_ced->nombre) }}" alt="Imagen" style="width: 60px;height: 60%;"/><br>
                                                                    <a class="text-center text-dark btn btn-sm" href="{{asset('cam_mini_exp/'. $mini_exp->celular . '/' .$minis_exp_ced->nombre) }}" target="_blank" style="background: #836262; color: #ffff!important">Ver Imagen</a>
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
