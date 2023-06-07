@extends('layouts.app_admin')

@section('template_title')
    Configuraciones de la Pag Web
@endsection

@section('content')

<div class="container-fluid mt-3">
      <div class="row">
        <div class="col">

          <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="mb-3">Configuraciones de la Pag Web</h3>

                    <div class="contebnt_btn">
                        <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_estandar" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                            Crear estandar
                        </a>
                        <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_revoe" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                            Crear Revoe
                        </a>
                        <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_comentario" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                            Crear Comentario
                        </a>
                    </div>

                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-12">

                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            <li class="nav-item" role="inicio">
                            <button class="nav-link active" id="pills-inicio-tab" data-bs-toggle="pill" data-bs-target="#pills-inicio" type="button" role="tab" aria-controls="pills-inicio" aria-selected="true">
                                Inicio
                            </button>
                            </li>
                            <li class="nav-item" role="paquetes">
                              <button class="nav-link" id="pills-paquetes-tab" data-bs-toggle="pill" data-bs-target="#pills-paquetes" type="button" role="tab" aria-controls="pills-paquetes" aria-selected="false">
                                Paquetes
                            </button>
                            </li>
                            <li class="nav-item" role="avales">
                              <button class="nav-link" id="pills-avales-tab" data-bs-toggle="pill" data-bs-target="#pills-avales" type="button" role="tab" aria-controls="pills-avales" aria-selected="false">
                                Avales
                            </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-nosotros-tab" data-bs-toggle="pill" data-bs-target="#pills-nosotros" type="button" role="tab" aria-controls="pills-nosotros" aria-selected="false">
                                  Nosotros
                                </button>
                              </li>
                              <li class="nav-item" role="Instalaciones">
                                <button class="nav-link" id="pills-instalaciones-tab" data-bs-toggle="pill" data-bs-target="#pills-instalaciones" type="button" role="tab" aria-controls="pills-instalaciones" aria-selected="false">
                                  Instalaciones
                                </button>
                              </li>
                              <li class="nav-item" role="Generales">
                                <button class="nav-link" id="pills-generales-tab" data-bs-toggle="pill" data-bs-target="#pills-generales" type="button" role="tab" aria-controls="pills-generales" aria-selected="false">
                                  Generales
                                </button>
                              </li>
                          </ul>
                          <form method="POST" action="{{ route('webpage.update', 1) }}" enctype="multipart/form-data" role="form">
                            @csrf
                            <input type="hidden" name="_method" value="PATCH">
                          <div class="tab-content" id="pills-tabContent">

                                <div class="tab-pane fade show active" id="pills-inicio" role="tabpanel" aria-labelledby="pills-inicio-tab" tabindex="0">
                                    <div class="row">

                                        <div class="col-6">
                                          <div class="form-group">
                                            <label for="">Seccion uno Image Bg</label>
                                            <input type="file" class="form-control" id="stone_home_bg" name="stone_home_bg">
                                            <img id="blah" src="{{asset('webpage/'.$webpage->stone_home_bg) }}" alt="Imagen" style="width: 100px; height: 100px;"/>
                                          </div>
                                        </div>

                                        <div class="col-6">
                                          <div class="form-group">
                                            <label for="">Seccion uno Titulo</label>
                                            <input type="text" class="form-control" id="stone_home_tittle" name="stone_home_tittle" value="{{$webpage->stone_home_tittle}}"/>
                                          </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                              <label for="">Seccion uno Text</label>
                                              <textarea class="form-control" name="stone_home_text" id="stone_home_text" cols="30" rows="10">
                                                {{$webpage->stone_home_text}}
                                              </textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Seccion sinco Titulo</label>
                                                <input type="text" class="form-control" id="stfive_home_tittle" name="stfive_home_tittle" value="{{$webpage->stfive_home_tittle}}"/>
                                              </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                              <label for="">Seccion sinco Text</label>
                                              <textarea class="form-control" name="stfive_home_text" id="stfive_home_text" cols="30" rows="10">
                                                {{$webpage->stfive_home_text}}
                                              </textarea>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-paquetes" role="tabpanel" aria-labelledby="pills-paquetes-tab" tabindex="0">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="form-group">
                                            <label for="">Paquetes imagen 1</label>
                                            <input type="file" class="form-control" id="stpaquetesone_image" name="stpaquetesone_image">
                                            <img id="blah" src="{{asset('webpage/'.$webpage->stpaquetesone_image) }}" alt="Imagen" style="width: 100px; height: 100px;"/>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                            <label for="">Paquetes imagen 2</label>
                                            <input type="file" class="form-control" id="stpaquetestwo_image" name="stpaquetestwo_image">
                                            <img id="blah" src="{{asset('webpage/'.$webpage->stpaquetestwo_image) }}" alt="Imagen" style="width: 100px; height: 100px;"/>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                            <label for="">Paquetes imagen 3</label>
                                            <input type="file" class="form-control" id="stpaquetesthree_image" name="stpaquetesthree_image">
                                            <img id="blah" src="{{asset('webpage/'.$webpage->stpaquetesthree_image) }}" alt="Imagen" style="width: 100px; height: 100px;"/>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                            <label for="">Paquetes imagen 4</label>
                                            <input type="file" class="form-control" id="stpaquetesfour_image" name="stpaquetesfour_image">
                                            <img id="blah" src="{{asset('webpage/'.$webpage->stpaquetesfour_image) }}" alt="Imagen" style="width: 100px; height: 100px;"/>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                            <label for="">Paquetes imagen 5</label>
                                            <input type="file" class="form-control" id="stpaquetesfive_image" name="stpaquetesfive_image">
                                            <img id="blah" src="{{asset('webpage/'.$webpage->stpaquetesfive_image) }}" alt="Imagen" style="width: 100px; height: 100px;"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-avales" role="tabpanel" aria-labelledby="pills-avales-tab" tabindex="0">
                                  <div class="row">

                                    <div class="col-3">
                                      <div class="form-group">
                                        <label for="">Certificado UNAM</label>
                                        <input type="file" class="form-control" id="stavalesunam_image" name="stavalesunam_image" >
                                        <img id="blah" src="{{asset('webpage/'.$webpage->stavalesunam_image) }}" alt="Imagen" style="width: 100px; height: 100px;"/>
                                      </div>
                                    </div>

                                    <div class="col-3">
                                      <div class="form-group">
                                      <label for="">Certificado Sep Conocer</label>
                                      <input type="file" class="form-control" id="stavalesconocer_image" name="stavalesconocer_image">
                                      <img id="blah" src="{{asset('webpage/'.$webpage->stavalesconocer_image) }}" alt="Imagen" style="width: 100px; height: 100px;"/>
                                      </div>
                                    </div>

                                    <div class="col-3">
                                      <div class="form-group">
                                      <label for="">Certificado REVOE</label>
                                      <input type="file" class="form-control" id="stavalesrevoe_image" name="stavalesrevoe_image">
                                      <img id="blah" src="{{asset('webpage/'.$webpage->stavalesrevoe_image) }}" alt="Imagen" style="width: 100px; height: 100px;"/>
                                      </div>
                                    </div>

                                    <div class="col-3">
                                      <div class="form-group">
                                      <label for="">Certificado STPS</label>
                                      <input type="file" class="form-control" id="stavalesstps_image" name="stavalesstps_image">
                                      <img id="blah" src="{{asset('webpage/'.$webpage->stavalesstps_image) }}" alt="Imagen" style="width: 100px; height: 100px;"/>
                                      </div>
                                    </div>

                                    <div class="col-3">
                                      <div class="form-group">
                                      <label for="">Registro Nacioanl 1</label>
                                      <input type="file" class="form-control" id="stavalesregistro_one_image" name="stavalesregistro_one_image">
                                      <img id="blah" src="{{asset('webpage/'.$webpage->stavalesregistro_one_image) }}" alt="Imagen" style="width: 100px; height: 100px;"/>
                                      </div>
                                    </div>

                                    <div class="col-3">
                                      <div class="form-group">
                                      <label for="">Registro Nacioanl 2</label>
                                      <input type="file" class="form-control" id="stavalesregistro_two_image" name="stavalesregistro_two_image">
                                      <img id="blah" src="{{asset('webpage/'.$webpage->stavalesregistro_two_image) }}" alt="Imagen" style="width: 100px; height: 100px;"/>
                                      </div>
                                    </div>

                                    <div class="col-3">
                                      <div class="form-group">
                                      <label for="">Registro Nacioanl 3</label>
                                      <input type="file" class="form-control" id="stavalesregistro_three_image" name="stavalesregistro_three_image">
                                      <img id="blah" src="{{asset('webpage/'.$webpage->stavalesregistro_three_image) }}" alt="Imagen" style="width: 100px; height: 100px;"/>
                                      </div>
                                    </div>

                                    <div class="col-3">
                                      <div class="form-group">
                                      <label for="">Registro Nacioanl 4</label>
                                      <input type="file" class="form-control" id="stavalesregistro_four_image" name="stavalesregistro_four_image">
                                      <img id="blah" src="{{asset('webpage/'.$webpage->stavalesregistro_four_image) }}" alt="Imagen" style="width: 100px; height: 100px;"/>
                                      </div>
                                    </div>

                                    <div class="col-3">
                                      <div class="form-group">
                                      <label for="">Registro Nacioanl 5</label>
                                      <input type="file" class="form-control" id="stavalesregistro_five_image" name="stavalesregistro_five_image">
                                      <img id="blah" src="{{asset('webpage/'.$webpage->stavalesregistro_five_image) }}" alt="Imagen" style="width: 100px; height: 100px;"/>
                                      </div>
                                    </div>

                                  </div>
                                </div>

                                <div class="tab-pane fade" id="pills-nosotros" role="tabpanel" aria-labelledby="pills-nosotros-tab" tabindex="0">
                                  <div class="row">
                                    <div class="col-6">
                                      <div class="form-group">
                                        <label for="">Seccion nosotros Image Bg</label>
                                        <input type="file" class="form-control" id="stone_nosotros_bg" name="stone_nosotros_bg">
                                        <img id="blah" src="{{asset('webpage/'.$webpage->stone_nosotros_bg) }}" alt="Imagen" style="width: 100px; height: 100px;"/>
                                      </div>
                                    </div>

                                    <div class="col-6">
                                      <div class="form-group">
                                        <label for="">Seccion nosotros Titulo</label>
                                        <input type="text" class="form-control" id="stone_nosotros_tittle" name="stone_nosotros_tittle" value="{{$webpage->stone_nosotros_tittle}}"/>
                                      </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                          <label for="">Seccion nosotros Text</label>
                                          <textarea class="form-control" name="stone_nosotros_text" id="stone_nosotros_text" cols="30" rows="10">
                                            {{$webpage->stone_nosotros_text}}
                                          </textarea>
                                        </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="tab-pane fade" id="pills-instalaciones" role="tabpanel" aria-labelledby="pills-instalaciones-tab" tabindex="0">
                                  <div class="row">
                                    <div class="col-6">
                                      <div class="form-group">
                                        <label for="">Seccion instalaciones Image Bg</label>
                                        <input type="file" class="form-control" id="stone_instalaciones_bg" name="stone_instalaciones_bg">
                                        <img id="blah" src="{{asset('webpage/'.$webpage->stone_instalaciones_bg) }}" alt="Imagen" style="width: 100px; height: 100px;"/>
                                      </div>
                                    </div>

                                    <div class="col-6">
                                      <div class="form-group">
                                        <label for="">Seccion instalaciones Titulo</label>
                                        <input type="text" class="form-control" id="stone_instalaciones_tittle" name="stone_instalaciones_tittle" value="{{$webpage->stone_instalaciones_tittle}}"/>
                                      </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                          <label for="">Seccion instalaciones Text</label>
                                          <textarea class="form-control" name="stone_instalaciones_text" id="stone_instalaciones_text" cols="30" rows="10">
                                            {{$webpage->stone_instalaciones_text}}
                                          </textarea>
                                        </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="tab-pane fade" id="pills-generales" role="tabpanel" aria-labelledby="pills-generales-tab" tabindex="0">
                                  <div class="row">
                                    <div class="col-6">
                                      <div class="form-group">
                                        <label for="">Pixel</label>
                                        <textarea class="form-control" name="wb_all_pixel" id="wb_all_pixel" cols="30" rows="10">
                                            {{$webpage->wb_all_pixel}}
                                        </textarea>
                                      </div>
                                    </div>

                                    <div class="col-6">
                                      <div class="form-group">
                                        <label for="">Google ANALITICS</label>
                                        <textarea class="form-control" name="wb_all_analitics" id="wb_all_analitics" cols="30" rows="10">
                                            {{$webpage->wb_all_analitics}}
                                        </textarea>
                                      </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                          <label for="">Email Admin</label>
                                          <input type="text" class="form-control" id="email_admin" name="email_admin" value="{{ $webpage->email_admin }}">
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                          <label for="">Email Admin 2</label>
                                          <input type="text" class="form-control" id="email_admin_two" name="email_admin_two" value="{{ $webpage->email_admin_two }}">
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                          <label for="">Email Dev</label>
                                          <input type="text" class="form-control" id="email_developer" name="email_developer" value="{{ $webpage->email_developer }}">
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                          <label for="">Email Dev 2</label>
                                          <input type="text" class="form-control" id="email_developer_two" name="email_developer_two" value="{{ $webpage->email_developer_two }}">
                                        </div>
                                    </div>

                                    <div class="col-3">
                                      <div class="form-group">
                                        <label for="">Imagen de Parallax</label>
                                        <input type="file" class="form-control" id="parallax" name="parallax">
                                        <img id="blah" src="{{asset('webpage/'.$webpage->parallax) }}" alt="Imagen" style="width: 100px; height: 100px;"/>
                                      </div>
                                    </div>

                                    <div class="col-3">
                                        <div class="form-group">
                                            <label for="Estatus">Estatus boton Votar</label>
                                            <select name="btn_votar" id="btn_votar" class="form-control">
                                                <option selected value="">{{ $webpage->btn_votar }}</option>
                                                <option value="Activo">Activo</option>
                                                <option value="Desabilitado">Desabilitado</option>
                                            </select>
                                        </div>
                                    </div>

                                  </div>
                                </div>

                                <button type="submit" class="btn close-modal" style="background: {{$configuracion->color_boton_save}}; color: #ffff">Guardar</button>

                          </div>
                          </form>
                    </div>
                </div>
            </div>
          </div>

          <div class="card mt-3">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="mb-3">Estandares ,Revoes y Comentarios</h3>

                    <div class="contebnt_btn">
                        <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_estandar" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                            Crear estandar
                        </a>
                        <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_revoe" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                            Crear Revoe
                        </a>
                        <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_comentario" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                            Crear Comentario
                        </a>
                        <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_reality" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                            Reality
                        </a>
                    </div>

                </div>
            </div>

            <div class="card-body ">
                <div class="row">
                    <div class="col-12">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                              <button class="nav-link active" id="estandares-tab" data-bs-toggle="tab" data-bs-target="#estandares-tab-pane" type="button" role="tab" aria-controls="estandares-tab-pane" aria-selected="true">
                                Estandares
                              </button>
                            </li>

                            <li class="nav-item" role="presentation">
                              <button class="nav-link" id="revoe-tab" data-bs-toggle="tab" data-bs-target="#revoe-tab-pane" type="button" role="tab" aria-controls="revoe-tab-pane" aria-selected="false">
                                Revoe
                              </button>
                            </li>

                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="comenatarios-tab" data-bs-toggle="tab" data-bs-target="#comenatarios-tab-pane" type="button" role="tab" aria-controls="comenatarios-tab-pane" aria-selected="false">
                                  Comentarios
                                </button>
                              </li>

                              <li class="nav-item" role="presentation">
                                <button class="nav-link" id="reality-tab" data-bs-toggle="tab" data-bs-target="#reality-tab-pane" type="button" role="tab" aria-controls="reality-tab-pane" aria-selected="false">
                                  Reality
                                </button>
                              </li>

                          </ul>

                          <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="estandares-tab-pane" role="tabpanel" aria-labelledby="estandares-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table table-flush" id="estandares-search">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Imagen</th>
                                                        <th>Nombre</th>
                                                        <th>Num de estandar</th>
                                                        <th width="280px">Acciones</th>
                                                    </tr>
                                                </thead>
                                                @foreach ($estandares as $estandar)
                                                <tr>
                                                    <td>{{ $estandar->id }}</td>
                                                    <th><img id="blah" src="{{asset('estandares/'.$estandar->image) }}" alt="Imagen" style="width: 60px; height: 60px;"/></th>
                                                    <td>{{ $estandar->name }}</td>
                                                    <td>{{ $estandar->num_estandar }}</td>
                                                    <td>
                                                        @can('client-edit')
                                                        <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#update_estandar_{{ $estandar->id }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                                                <i class="fa fa-fw fa-edit"></i> </a>
                                                        @endcan
                                                    </td>
                                                </tr>
                                                @include('admin.webpage.modal_estandar_edit')
                                                @endforeach

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="revoe-tab-pane" role="tabpanel" aria-labelledby="revoe-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="table-responsive">
                                            <table class="table table-flush" id="revoes-search">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Imagen</th>
                                                        <th>Nombre</th>
                                                        <th>Num de Revoe</th>
                                                        <th width="280px">Acciones</th>
                                                    </tr>
                                                </thead>

                                                @foreach ($revoes as $revoe)
                                                <tr>
                                                    <td>{{ $revoe->id }}</td>
                                                    <th><img id="blah" src="{{asset('revoes/'.$revoe->image) }}" alt="Imagen" style="width: 60px; height: 60px;"/></th>
                                                    <td>{{ $revoe->name }}</td>
                                                    <td>{{ $revoe->num_revoe }}</td>
                                                    <td>
                                                        @can('client-edit')
                                                        <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#update_revoe_{{ $revoe->id }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                                            <i class="fa fa-fw fa-edit"></i>
                                                        </a>
                                                        @endcan
                                                    </td>
                                                </tr>

                                                @include('admin.webpage.modal_revoe_edit')

                                                @endforeach

                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="comenatarios-tab-pane" role="tabpanel" aria-labelledby="comenatarios-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-flush" id="comentarios-search">
                                            <thead class="thead">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Img</th>
                                                    <th>Nombre</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($comentarios as $comentario)
                                                    <tr>
                                                        <td>{{ $comentario->id }}</td>
                                                        <th><img id="blah" src="{{asset('comentarios/'.$comentario->foto) }}" alt="Imagen" style="width: 60px; height: 60px;"/></th>
                                                        <td>{{ $comentario->nombre }}</td>
                                                        <td>
                                                            <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#update_comenatario_{{ $comentario->id }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                                                <i class="fa fa-fw fa-edit"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @include('admin.webpage.modal_comentario_edit')

                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="reality-tab-pane" role="tabpanel" aria-labelledby="reality-tab" tabindex="0">
                                <div class="row">
                                    <div class="col-12">
                                        <table class="table table-flush" id="comentarios-search">
                                            <thead class="thead">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Img</th>
                                                    <th>Nombre</th>
                                                    <th>Votos</th>
                                                    <th>Estatus</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($votos as $voto)
                                                    <tr>
                                                        <td>{{ $voto->id }}</td>
                                                        <th><img id="blah" src="{{asset('reality/'.$voto->foto_perfil) }}" alt="Imagen" style="width: 60px; height: 60px;"/></th>
                                                        <td>{{ $voto->nombre }}</td>
                                                        <td>{{ $voto->votos }}</td>
                                                        <td>{{ $voto->estatus }}</td>
                                                        <td>
                                                            <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#update_reality_{{ $voto->id }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                                                <i class="fa fa-fw fa-edit"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @include('admin.webpage.modal_reality__edit')
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                          </div>
                    </div>
                </div>
            </div>
          </div>

        </div>
      </div>
</div>

@include('admin.webpage.modal_reality_create')
@include('admin.webpage.modal_estandar_create')
@include('admin.webpage.modal_revoe_create')
@include('admin.webpage.modal_comentario_create')

@endsection

@section('datatable')
<script>
    const dataTableSearch = new simpleDatatables.DataTable("#estandares-search", {
      searchable: true,
      fixedHeight: false
    });

    const dataTableSearch = new simpleDatatables.DataTable("#revoes-search", {
      searchable: true,
      fixedHeight: false
    });

    const dataTableSearch = new simpleDatatables.DataTable("#comentarios-search", {
      searchable: true,
      fixedHeight: false
    });

</script>
@endsection
