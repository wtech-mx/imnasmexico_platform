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

@can('comisiones-kits')
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card">
            <div class="card-header pb-0 p-3">
                <div class="d-flex justify-content-between">
                    <h6 class="mb-0">Comisiones venta kits</h6>
                </div>
            </div>


            <div class="card-body p-3">
                <ul class="list-group">

                @foreach ($user_comision_kit as $item)
                    <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                        <div class="d-flex align-items-center">
                            <div class="icon icon-shape icon-sm me-3 bg-primary shadow text-center">
                                <i class="ni ni-mobile-button text-white opacity-10"></i>
                            </div>

                            <div class="d-flex flex-column">
                                <h6 class="mb-1 text-dark text-sm">{{ $item->name }}</h6>
                                <span class="text-xs">
                                    @php
                                        $notas_nas_individual = 0;
                                        $notas_nas_comp = 0;
                                        $notas_nas_comp2 = 0;
                                        $sum_comp = 0;
                                        $notas_nas_individual_pares = 0;
                                        $comision_comp = 0;
                                        $notas_nas_compartida_pares = 0;
                                        $division_comp = 0;
                                        $comision = 0;
                                        $comision_uno = 0;

                                        //C O M I S I O N E S  C O S M I C A
                                        $notas_nas_individual_cosmica = 0;
                                        $notas_nas_comp_cosmica = 0;
                                        $notas_nas_comp2_cosmica = 0;
                                        $sum_comp_cosmica = 0;
                                        $notas_nas_individual_pares_cosmica = 0;
                                        $comision_comp_cosmica = 0;
                                        $notas_nas_compartida_pares_cosmica = 0;
                                        $division_comp_cosmica = 0;
                                        $comision_cosmica = 0;
                                        $comision_uno_cosmica = 0;

                                        $suma_individual = 0;
                                        $suma_compartidas = 0;
                                    @endphp
                                    @foreach ($notasAprobadasNASComision as $notas)
                                        @if ($notas->id_admin == $item->id && $notas->id_admin_venta == $item->id)
                                            @php
                                                $notas_nas_individual += $notas->cantidad_kit + $notas->cantidad_kit2 + $notas->cantidad_kit3 + $notas->cantidad_kit4 + $notas->cantidad_kit5 + $notas->cantidad_kit6;
                                            @endphp
                                        @endif
                                        @if ($notas->id_admin == $item->id && $notas->id_admin_venta !== $item->id)
                                            @php
                                                $notas_nas_comp += $notas->cantidad_kit + $notas->cantidad_kit2 + $notas->cantidad_kit3 + $notas->cantidad_kit4 + $notas->cantidad_kit5 + $notas->cantidad_kit6;
                                            @endphp
                                        @endif
                                        @if ($notas->id_admin !== $item->id && $notas->id_admin_venta == $item->id)
                                            @php
                                                $notas_nas_comp2 += $notas->cantidad_kit + $notas->cantidad_kit2 + $notas->cantidad_kit3 + $notas->cantidad_kit4 + $notas->cantidad_kit5 + $notas->cantidad_kit6;
                                            @endphp
                                        @endif
                                        @php
                                            $sum_comp = $notas_nas_comp + $notas_nas_comp2;

                                            $notas_nas_individual_pares = $notas_nas_individual;
                                            if ($notas_nas_individual_pares % 2 != 0) {
                                                $notas_nas_individual_pares--; // Reducir en 1 si es impar
                                            }

                                            $division = $notas_nas_individual_pares / 2;
                                            $comision = $division * $item->comision_kit;

                                            $notas_nas_compartida_pares = $sum_comp;
                                            if ($notas_nas_compartida_pares % 2 != 0) {
                                                $notas_nas_compartida_pares--; // Reducir en 1 si es impar
                                            }
                                            $comision_comp = $item->comision_kit / 2;
                                            $division_comp = $notas_nas_compartida_pares / 2;
                                            $comision_uno = $division_comp * $comision_comp;
                                        @endphp
                                    @endforeach
                                    {{-- C O M I S I O N E S  C O S M I C A --}}
                                    @foreach ($notasAprobadasCosmicaComision as $notas)
                                        @if ($notas->id_admin == $item->id && $notas->id_admin_venta == $item->id)
                                            @php
                                                $notas_nas_individual_cosmica += $notas->cantidad_kit + $notas->cantidad_kit2 + $notas->cantidad_kit3 + $notas->cantidad_kit4 + $notas->cantidad_kit5 + $notas->cantidad_kit6;
                                            @endphp
                                        @endif
                                        @if ($notas->id_admin == $item->id && $notas->id_admin_venta !== $item->id)
                                            @php
                                                $notas_nas_comp_cosmica += $notas->cantidad_kit + $notas->cantidad_kit2 + $notas->cantidad_kit3 + $notas->cantidad_kit4 + $notas->cantidad_kit5 + $notas->cantidad_kit6;
                                            @endphp
                                        @endif
                                        @if ($notas->id_admin !== $item->id && $notas->id_admin_venta == $item->id)
                                            @php
                                                $notas_nas_comp2_cosmica += $notas->cantidad_kit + $notas->cantidad_kit2 + $notas->cantidad_kit3 + $notas->cantidad_kit4 + $notas->cantidad_kit5 + $notas->cantidad_kit6;
                                            @endphp
                                        @endif
                                        @php
                                            $sum_comp_cosmica = $notas_nas_comp_cosmica + $notas_nas_comp2_cosmica;

                                            $notas_nas_individual_pares_cosmica = $notas_nas_individual_cosmica;
                                            if ($notas_nas_individual_pares_cosmica % 2 != 0) {
                                                $notas_nas_individual_pares_cosmica--; // Reducir en 1 si es impar
                                            }

                                            $division = $notas_nas_individual_pares_cosmica / 2;
                                            $comision_cosmica = $division * $item->comision_kit;

                                            $notas_nas_compartida_pares_cosmica = $sum_comp_cosmica;
                                            if ($notas_nas_compartida_pares_cosmica % 2 != 0) {
                                                $notas_nas_compartida_pares_cosmica--; // Reducir en 1 si es impar
                                            }
                                            $comision_comp_cosmica = $item->comision_kit / 2;
                                            $division_comp_cosmica = $notas_nas_compartida_pares_cosmica / 2;
                                            $comision_uno_cosmica = $division_comp_cosmica * $comision_comp_cosmica;

                                            $suma_individual = $notas_nas_individual + $notas_nas_individual_cosmica;
                                            $suma_compartidas = $sum_comp + $sum_comp_cosmica;
                                        @endphp
                                    @endforeach
                                    Kits vendidos: {{$suma_individual}} <br>
                                    Kits vendidos compartidos: {{$suma_compartidas}}
                                    <strong> -
                                        <a type="button" class="" data-bs-toggle="modal" data-bs-target="#comision_{{ $item->id }}" style="color: {{$configuracion->color_boton_add}};">
                                            Ver detalles
                                        </a>
                                    </strong>
                                </span>

                            </div>
                        </div>
                    </li>
                    @include('admin.users.comision_kits')
                @endforeach

                </ul>
            </div>
            </div>
        </div>
    </div>
@endcan

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
