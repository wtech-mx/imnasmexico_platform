@extends('layouts.app_admin')

@section('template_title')
    Notas Estandares
@endsection

@php
   use App\Models\NotasEstandaresEstatus;
@endphp

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-4">
                                <a class="btn bg-success" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                   <h5 style="color: #fff"> Crear nota</h5>
                                </a>
                            </div>

                            <div class="col-12">
                                @include('admin.notas_cam.create')
                            </div>
                        </div>

                        <form action="{{ route('notascam.buscador') }}" method="GET" >
                            <div class="row mt-4">
                                <div class="col-3">
                                    <h5 for="user_id">Buscar por nombre</h5>
                                    <select class="form-control nombre_persona" name="nombre_persona" id="nombre_persona">
                                        <option selected value="">Nombre</option>
                                        @foreach ($nombres_personas as $nombre_persona)
                                            <option value="{{$nombre_persona}}">{{$nombre_persona}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <h5 for="user_id">Buscar Telefono:</h5>
                                    <select class="form-control celular_persona" name="celular_persona" id="celular_persona">
                                        <option selected value="">Telefono</option>
                                        @foreach ($celular_personas as $celular_persona)
                                            <option value="{{$celular_persona}}">{{$celular_persona}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <h5 for="user_id">Buscar por Estandar:</h5>
                                    <select class="form-control estandar" name="estandar" id="estandar">
                                        <option selected value="">Estandar</option>
                                        @foreach ($estandares_cam as $estandar_cam)
                                            <option value="{{$estandar_cam->id}}">{{$estandar_cam->estandar}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <br>
                                    <button class="btn btn-sm mb-0 mt-sm-0 mt-1" type="submit" style="background-color: #F82018;"><h5 style="color: #ffffff;">Buscar</h5></button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @if(Route::currentRouteName() != 'notascam.index')
                                @foreach ( $notas as $item)
                                    @php
                                        $estandares_estatus = NotasEstandaresEstatus::where('id_nota','=', $item->id)->get();
                                    @endphp
                                    <div class="col-12 mb-4">
                                        <div class="comtainer_nota" style="background: #ddbba254;border-radius: 13px;box-shadow: 10px 10px 28px -25px rgba(0,0,0,0.73);padding: 15px;">
                                            <div class="row">

                                                <div class="col-12">
                                                    <div class="collapse" id="collapseExample">
                                                        <div class="card card-body ">
                                                            <div class="row">
                                                                <div class="col-4">
                                                                    <div class="form-group">
                                                                        <h5 for="name">Nombre *</h5>
                                                                        <div class="input-group mb-3">
                                                                            <span class="input-group-text" id="basic-addon1">
                                                                                <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                                                            </span>
                                                                            <input type="text" class="form-control" value="{{ $item->nombre_persona }}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-4">
                                                                    <div class="form-group">
                                                                        <h5 for="name">Telefono *</h5>
                                                                        <div class="input-group mb-3">
                                                                            <span class="input-group-text" id="basic-addon1">
                                                                                <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                                                            </span>
                                                                            <input type="text" class="form-control" value="{{ $item->celular }}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-4">
                                                                    <div class="form-group">
                                                                        <h5 for="name">Correo *</h5>
                                                                        <div class="input-group mb-3">
                                                                            <span class="input-group-text" id="basic-addon1">
                                                                                <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                                                            </span>
                                                                            <input type="text" class="form-control" value="{{ $item->email }}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-4">
                                                                    <div class="form-group">
                                                                        <h5 for="name">Fecha de evaluacion *</h5>
                                                                        <div class="input-group mb-3">
                                                                            <span class="input-group-text" id="basic-addon1">
                                                                                <img src="{{ asset('assets/cam/calenda.png') }}" alt="" width="35px">
                                                                            </span>
                                                                            <input type="date" class="form-control" value="{{ $item->fecha }}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-4">
                                                                    <div class="form-group">
                                                                        <h5 for="name">Hora *</h5>
                                                                        <div class="input-group mb-3">
                                                                            <span class="input-group-text" id="basic-addon1">
                                                                                <img src="{{ asset('assets/user/icons/reloj.png') }}" alt="" width="35px">
                                                                            </span>
                                                                            <input id="time" name="time" type="time" class="form-control" value="{{ $item->time }}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-4">
                                                                    <div class="form-group">
                                                                        <h5 for="name">Tipo *</h5>
                                                                        <div class="input-group mb-3">
                                                                            <span class="input-group-text" id="basic-addon1">
                                                                                <img src="{{ asset('assets/cam/change.png') }}" alt="" width="35px">
                                                                            </span>
                                                                            <select name="tipo" id="tipo" class="form-select d-inline-block" disabled>
                                                                                <option value="">{{ $item->tipo }}</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-4">
                                                                    <div class="form-group">
                                                                        <h5 for="name">Modalidad *</h5>
                                                                        <div class="input-group mb-3">
                                                                            <span class="input-group-text" id="basic-addon1">
                                                                                <img src="{{ asset('assets/cam/gestion-del-cambio.png') }}" alt="" width="35px">
                                                                            </span>
                                                                            <select name="tipo_modalidad" id="tipo_modalidad" class="form-select d-inline-block" disabled>
                                                                                <option value="">{{ $item->tipo_modalidad }}</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-4">
                                                                    <div class="form-group">
                                                                        <h5 for="name">Alumnos o externos *</h5>
                                                                        <div class="input-group mb-3">
                                                                            <span class="input-group-text" id="basic-addon1">
                                                                                <img src="{{ asset('assets/user/icons/perfil.png') }}" alt="" width="35px">
                                                                            </span>
                                                                            <select name="tipo_alumno" id="tipo_alumno" class="form-select d-inline-block" disabled>
                                                                                <option value="">{{ $item->tipo_alumno }}</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <h5 for="name">Nombre del Centro</h5>
                                                                        <div class="input-group mb-3">
                                                                            <span class="input-group-text" id="basic-addon1">
                                                                                <img src="{{ asset('assets/user/icons/letter.png') }}" alt="" width="35px">
                                                                            </span>
                                                                            <input id="nombre_centro" name="nombre_centro" type="text" class="form-control" value="{{ $item->nombre_centro }}" disabled>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-4 mb-3">
                                                    <h3 style="color: #35a79e"> Nombre: </h3><h4> {{ $item->nombre_persona }}</h4>
                                                </div>

                                                <div class="col-4 mb-3">
                                                    <h3 style="color: #35a79e">Fecha: </h3><h4> <strong>{{ \Carbon\Carbon::parse($item->fecha)->locale('es_ES')->isoFormat('dddd DD [de] MMMM YYYY') }}</strong></h4>
                                                </div>

                                                <div class="col-2 mb-3">
                                                    <h3 style="color: #35a79e">Hora: </h3><h4> <strong>{{ $item->time }}</strong></h4>
                                                </div>

                                                <div class="col-2 mb-3">
                                                    <a class="btn btn-sm btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                                    <h5 style="color: #ffff;"> Mas informacion</h5>
                                                    </a>
                                                </div>

                                                <div class="col-12">
                                                    @foreach ($estandares_estatus as $estandar_item)
                                                        @if ($id_estandar == NULL)
                                                            @include('admin.notas_cam.card_nota')
                                                        @else
                                                            @if ($estandar_item->id_estandar == $id_estandar)
                                                                @include('admin.notas_cam.card_nota')
                                                            @endif
                                                        @endif


                                                    @include('admin.notas_cam.modal_evaluador')
                                                    @include('admin.notas_cam.modal_estatus')
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('select2')
<script src="{{ asset('assets/admin/vendor/select2/dist/js/select2.min.js')}}"></script>
<script>
    $(document).ready(function() {
        $('.nombre_persona').select2();
    });

    $(document).ready(function() {
        $('.celular_persona').select2();
    });

    $(document).ready(function() {
        $('.estandar').select2();
    });

    $(document).ready(function() {
        $('.estandares').select2();
    });
</script>


@endsection
