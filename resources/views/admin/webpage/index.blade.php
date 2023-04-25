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
                    <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_revoe" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                        Crear Revoe
                    </a>
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
                          <form action="">
                          <div class="tab-content" id="pills-tabContent">

                                <div class="tab-pane fade show active" id="pills-inicio" role="tabpanel" aria-labelledby="pills-inicio-tab" tabindex="0">
                                    <div class="row">

                                        <div class="col-6">
                                          <div class="form-group">
                                            <label for="">Seccion uno Image Bg</label>
                                            <input type="file" class="form-control" id="stone_home_bg" name="stone_home_bg">
                                          </div>
                                        </div>

                                        <div class="col-6">
                                          <div class="form-group">
                                            <label for="">Seccion uno Titulo</label>
                                            <input type="text" class="form-control" id="stone_home_tittle" name="stone_home_tittle" />
                                          </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                              <label for="">Seccion uno Text</label>
                                              <textarea class="form-control" name="stone_home_text" id="stone_home_text" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="">Seccion sinco Titulo</label>
                                                <input type="text" class="form-control" id="stfive_home_tittle" name="stfive_home_tittle" />
                                              </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                              <label for="">Seccion sinco Text</label>
                                              <textarea class="form-control" name="stfive_home_text" id="stfive_home_text" cols="30" rows="10"></textarea>
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
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                            <label for="">Paquetes imagen 2</label>
                                            <input type="file" class="form-control" id="stpaquetestwo_image" name="stpaquetestwo_image">
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                            <label for="">Paquetes imagen 3</label>
                                            <input type="file" class="form-control" id="stpaquetesthree_image" name="stpaquetesthree_image">
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                            <label for="">Paquetes imagen 4</label>
                                            <input type="file" class="form-control" id="stpaquetesfour_image" name="stpaquetesfour_image">
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-group">
                                            <label for="">Paquetes imagen 5</label>
                                            <input type="file" class="form-control" id="stpaquetesfive_image" name="stpaquetesfive_image">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="pills-avales" role="tabpanel" aria-labelledby="pills-avales-tab" tabindex="0">
                                  <div class="row">

                                    <div class="col-3">
                                      <div class="form-group">
                                        <label for="">Certificado UNAM</label>
                                        <input type="file" class="form-control" id="stavalesunam_image" name="stavalesunam_image">
                                      </div>
                                    </div>

                                    <div class="col-3">
                                      <div class="form-group">
                                      <label for="">Certificado Sep Conocer</label>
                                      <input type="file" class="form-control" id="stavalesconocer_image" name="stavalesconocer_image">
                                      </div>
                                    </div>

                                    <div class="col-3">
                                      <div class="form-group">
                                      <label for="">Certificado REVOE</label>
                                      <input type="file" class="form-control" id="stavalesrevoe_image" name="stavalesrevoe_image">
                                      </div>
                                    </div>

                                    <div class="col-3">
                                      <div class="form-group">
                                      <label for="">Certificado STPS</label>
                                      <input type="file" class="form-control" id="stavalesstps_image" name="stavalesstps_image">
                                      </div>
                                    </div>

                                    <div class="col-3">
                                      <div class="form-group">
                                      <label for="">Registro Nacioanl 1</label>
                                      <input type="file" class="form-control" id="stavalesregistro_one_image" name="stavalesregistro_one_image">
                                      </div>
                                    </div>

                                    <div class="col-3">
                                      <div class="form-group">
                                      <label for="">Registro Nacioanl 2</label>
                                      <input type="file" class="form-control" id="stavalesregistro_two_image" name="stavalesregistro_two_image">
                                      </div>
                                    </div>

                                    <div class="col-3">
                                      <div class="form-group">
                                      <label for="">Registro Nacioanl 3</label>
                                      <input type="file" class="form-control" id="stavalesregistro_three_image" name="stavalesregistro_three_image">
                                      </div>
                                    </div>

                                    <div class="col-3">
                                      <div class="form-group">
                                      <label for="">Registro Nacioanl 4</label>
                                      <input type="file" class="form-control" id="stavalesregistro_four_image" name="stavalesregistro_four_image">
                                      </div>
                                    </div>

                                    <div class="col-3">
                                      <div class="form-group">
                                      <label for="">Registro Nacioanl 5</label>
                                      <input type="file" class="form-control" id="stavalesregistro_five_image" name="stavalesregistro_five_image">
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
                                      </div>
                                    </div>

                                    <div class="col-6">
                                      <div class="form-group">
                                        <label for="">Seccion nosotros Titulo</label>
                                        <input type="text" class="form-control" id="stone_nosotros_tittle" name="stone_nosotros_tittle" />
                                      </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                          <label for="">Seccion nosotros Text</label>
                                          <textarea class="form-control" name="stone_nosotros_text" id="stone_nosotros_text" cols="30" rows="10"></textarea>
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
                                      </div>
                                    </div>

                                    <div class="col-6">
                                      <div class="form-group">
                                        <label for="">Seccion instalaciones Titulo</label>
                                        <input type="text" class="form-control" id="stone_instalaciones_tittle" name="stone_instalaciones_tittle" />
                                      </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                          <label for="">Seccion instalaciones Text</label>
                                          <textarea class="form-control" name="stone_instalaciones_text" id="stone_instalaciones_text" cols="30" rows="10"></textarea>
                                        </div>
                                    </div>
                                  </div>
                                </div>

                                <div class="tab-pane fade" id="pills-generales" role="tabpanel" aria-labelledby="pills-generales-tab" tabindex="0">
                                  <div class="row">
                                    <div class="col-6">
                                      <div class="form-group">
                                        <label for="">Pixel</label>
                                        <textarea class="form-control" name="wb_all_pixel" id="wb_all_pixel" cols="30" rows="10"></textarea>
                                      </div>
                                    </div>
                                    <div class="col-6">
                                      <div class="form-group">
                                        <label for="">Google ANALITICS</label>
                                        <textarea class="form-control" name="wb_all_analitics" id="wb_all_analitics" cols="30" rows="10"></textarea>
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
        </div>
      </div>
</div>


@endsection

@section('datatable')

<script>
    const dataTableSearch = new simpleDatatables.DataTable("#datatable-search", {
      searchable: true,
      fixedHeight: false
    });
</script>

@endsection
