@php
    use Carbon\Carbon;
    use Carbon\CarbonInterface;
@endphp
<div class="row">
    <div class="col-lg-12">
        <div class="row">
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card  mb-4">
            <div class="card-body p-3">
                <div class="row">
                <div class="col-8">
                    <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Cotizaciones NAS</p>
                    <h5 class="font-weight-bolder">
                        {{ $cotizacion_NASCount }}
                    </h5>
                    </div>
                </div>
                <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card  mb-4">
            <div class="card-body p-3">
                <div class="row">
                <div class="col-8">
                    <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Cotizaciones Cosmica</p>
                    <h5 class="font-weight-bolder">
                    {{ $cotizacion_CosmicaCount }}
                    </h5>
                    </div>
                </div>
                <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card  mb-4">
            <div class="card-body p-3">
                <div class="row">
                <div class="col-8">
                    <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Ventas totales</p>
                    <h5 class="font-weight-bolder">
                        {{ $ventas_NASCount }}
                    </h5>
                    </div>
                </div>
                <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-12">
            <div class="card  mb-4">
            <div class="card-body p-3">
                <div class="row">
                <div class="col-8">
                    <div class="numbers">
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Clientes Totales</p>
                    <h5 class="font-weight-bolder">
                        {{ $clientesTotal }}
                    </h5>
                    </div>
                </div>
                <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>

<div class="row">
    @can('registro-imnas-pendientes')
        <div class="col-lg-12 col-md-12 mb-4 mb-lg-0">
            <div class="card h-100 ">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <h3 class="mb-3">Registro IMNAS</h3>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Doc Pendientes
                            <span class="badge rounded-pill bg-danger">
                                {{ $registros_pendientes ? $registros_pendientes->count() : 0 }}
                            </span>
                          </button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Especialidades Pendientes
                            <span class="badge rounded-pill bg-danger">
                                {{ $especialidades_pendientes ? $especialidades_pendientes->count() : 0 }}
                            </span>
                          </button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Envios Pagados
                            <span class="badge rounded-pill bg-danger">
                                {{ $envios_pendientes ? $envios_pendientes->count() : 0 }}
                            </span>
                          </button>
                        </li>
                      </ul>
                      <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            @include('admin.tabs_registro.doc_pendiente')
                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            @include('admin.tabs_registro.especialidad_pendiente')
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                            @include('admin.tabs_registro.envios_pendientes')
                        </div>
                      </div>
                </div>
            </div>
        </div>
    @endcan

    <div class="col-6 mt-5">
        <div class="card card-carousel overflow-hidden h-100 p-0">
            <div class="card-header pb-0 pt-3 bg-transparent">
                <h6 class="text-capitalize">Cursos de la semana</h6>
            </div>

            <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">

                <div class="carousel-inner border-radius-lg h-100">

                    @foreach ($cursos as $curso_car)

                        @php
                            $hora_inicial = Carbon::parse($curso_car->hora_inicial)->format('h:i A');
                            $hora_final = strftime("%H:%M %p", strtotime($curso_car->hora_final)) ;

                            $fecha_ini = $curso_car->fecha_inicial;
                            $fecha_inicial = Carbon::createFromFormat('Y-m-d', $fecha_ini)->locale('es')->isoFormat('D [de] MMMM');
                        @endphp

                        <div class="carousel-item h-100 {{ $loop->first ? 'active' : '' }}" style="background-image: url('{{asset('curso/'. $curso_car->foto) }}');background-size: cover;">
                            <div class="carousel-caption d-none d-md-block bottom-0 text-start start-0 ms-5">

                                <div class="icon icon-shape icon-sm bg-white text-center border-radius-md mb-3">
                                    <p class="text-dark" style="width:100px;">{{$curso_car->modalidad}}</p>
                                </div>

                                <h5 class="text-dark mb-1">{{$curso_car->nombre}}</h5>
                                <p class="text-dark">{{$fecha_inicial}}</p>

                                <div class="row">

                                    <div class="col-12">
                                        <div class="d-flex justify-content-start">
                                            <a class="btn btn-warning btn-sm" style="margin-right: 1rem" href="{{ route('cursos.edit',$curso_car->id) }}"  target="_blank"><i class="fa fa-fw fa-edit"></i> Editar</a>
                                            <a class="btn btn-success btn-sm" href="{{ route('cursos.show',$curso_car->slug) }}"  target="_blank"><i class="fas fa-external-link-alt"></i> Ver</a>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    @endforeach

                </div>

                <button class="carousel-control-prev w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>

            </div>

        </div>
    </div>
</div>
