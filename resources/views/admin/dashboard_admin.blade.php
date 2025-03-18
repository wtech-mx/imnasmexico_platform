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
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Ingresos del dia</p>
                    <h5 class="font-weight-bolder">
                        $ {{ $totalPagadoFormateadoDia }}
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
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Clientes Totales</p>
                    <h5 class="font-weight-bolder">
                    {{ $clientesTotal }}
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
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Facturas Pendientes</p>
                    <h5 class="font-weight-bolder">
                        {{ $contadorfacturas }}
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
                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Envios Pendientes de doc</p>
                    <h5 class="font-weight-bolder">
                        {{ $contadorenvios }}
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

{{-- <div class="row">
    <div class="col-lg-7 mb-4 mb-lg-0">
        <div class="card z-index-2 h-100">
        <div class="card-header pb-0 pt-3 bg-transparent">
            <div class="d-flex justify-content-between">
                <h3 class="mb-3">Resumen de ventas del año</h3>
                <a type="button" href="{{ route('reporte.index_custom') }}" class="btn bg-gradient-primary" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                    <i class="fa fa-fw fa-eye"></i> - Ver Reportes
                </a>
            </div>
        </div>
        <div class="card-body p-3">
            <div class="chart">
            <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
            </div>
        </div>
        </div>
    </div>

    <div class="col-lg-5">
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
</div> --}}

<div class="row mt-4">
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
</div>

<div class="row mt-4">
    {{-- <div class="col-lg-6 col-md-6 mb-4 mb-lg-0">
        <div class="card h-100 ">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h3 class="mb-3">Profesores</h3>
                <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_profesor" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                    <i class="fa fa-fw fa-edit"></i> Agregar
                </a>
            </div>
        </div>
        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                    <thead class="thead">
                        <tr>
                            <th>Nombre</th>
                            <th>Telefono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($profesores as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->telefono }}</td>
                                <td>
                                    <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#update_user_{{ $user->id }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                                        <i class="fa fa-fw fa-edit"></i>
                                    </a>
                                </td>
                            </tr>
                            @include('admin.profesores.modal_prof_edit')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div> --}}

    @can('comisiones-kits')
    <div class="col-md-6">
        <div class="card">
            <div class="card-header pb-0 p-3">
                <div class="d-flex justify-content-between">
                    <h6 class="mb-0">Comisiones venta kits</h6>
                </div>
            </div>
            <div class="card-body p-3">
                <p class="text-center">
                    <img id="cerdito" src="{{ asset('assets/cam/piggy-bank.png') }}" alt="Cerdito" style="width: 100px; position: relative; top: 0;">
                </p>
                <div class="progress mt-4" style="height: 30px; position: relative;">

                    <div id="progress-bar" class="progress-bar bg-success" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                        <span id="progress-text" style="position: absolute; left: 50%; transform: translateX(-50%); color: white; font-weight: bold;">0%</span>
                    </div>
                </div>
                <div class="mt-3">
                    <p><strong>Total de Ventas:</strong> ${{ number_format($totalVentas, 2) }}</p>
                    <p><strong>Comisión Grupal:</strong> ${{ number_format($comisionGrupal, 2) }}</p>
                </div>
            </div>
        </div>
    </div>
    @endcan

    <div class="col-lg-6">
        <div class="card h-100 ">
        <div class="card-header">
            <h5 class="mb-0 text-capitalize">Mercado Pago</h5>
        </div>
        <div class="card-body pt-0">
            <div class="table-responsive">
                <table class="table table-flush" id="datatable-search">
                    <thead class="text-center">
                        <tr class="tr_checkout">
                        <th >Num. Pedido</th>
                        <th>Correo</th>
                        <th >Monto</th>
                        <th >Motivo</th>
                        <th >Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pagos as $pago)
                            <tr>
                                <td>{{ $pago->id }}</td>
                                @if ($pago->payer == null)
                                    <td>/</td>
                                @else
                                    <td>{{$pago->payer->email}}</td>
                                @endif
                                <td>${{ $pago->transaction_amount }}</td>
                                <td>{{ $pago->description }}</td>
                                <td>
                                    @php
                                        $fecha = $pago->date_approved;
                                        // Convertir a una marca de tiempo Unix
                                        $timestamp = strtotime($fecha);
                                        // Formatear la fecha
                                        $fecha_formateada = strftime('%e de %B del %Y', $timestamp);
                                        // Formatear la hora
                                        $hora_formateada = date('h:i A', $timestamp);
                                        // Combinar fecha y hora
                                        $fecha_hora_formateada = $fecha_formateada . ' a las ' . $hora_formateada;
                                    @endphp
                                    {{ $fecha_hora_formateada}}
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</div>

{{-- <div class="row mt-4">
    <div class="col-12 col-md-8 mb-4 mb-md-0">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3 class="mb-3">Usuarios</h3>
                    <a type="button" class="btn bg-gradient-primary" href="{{ route('users.create') }}" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                        <i class="fa fa-fw fa-plus"></i> Agregar
                    </a>
                </div>
            </div>
        <div class="table-responsive">
            <table class="table align-items-center mb-0">
            <thead>
                <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Funcion</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Rol</th>
                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Conexion </th>
                <th class="text-secondary opacity-7"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $user)
                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-xs">{{ $user->name }}</h6>
                                    <p class="text-xs text-secondary mb-0">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>

                        <td>
                            <p class="text-xs font-weight-bold mb-0">{{ $user->puesto }}</p>
                        </td>

                        <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm badge-success">Online</span>
                        </td>

                        <td class="align-middle text-center">
                            <span class="text-secondary text-xs font-weight-bold">23/04/18</span>
                        </td>

                        <td class="align-middle">
                            @can('usuarios-edit')
                            <a class="btn btn-sm btn-success" href="{{ route('users.edit',$user->id) }}"><i class="fa fa-fw fa-edit"></i> </a>
                            @endcan
                        </td>

                    </tr>
                @endforeach

            </tbody>
            </table>
        </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
        <div class="card-header pb-0 p-3">
            <div class="d-flex justify-content-between">
                <h6 class="mb-0">Cupones Activos</h6>
                <a type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#create_cupon" style="background: {{$configuracion->color_boton_add}}; color: #ffff">
                    <i class="fa fa-fw fa-plus"></i> Crear
                </a>
            </div>
        </div>


        <div class="card-body p-3">
            <ul class="list-group">

            @foreach ($cupones as $cupon)
            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                <div class="d-flex align-items-center">
                    <div class="icon icon-shape icon-sm me-3 bg-primary shadow text-center">
                        <i class="ni ni-mobile-button text-white opacity-10"></i>
                    </div>

                    <div class="d-flex flex-column">
                        <h6 class="mb-1 text-dark text-sm">{{ $cupon->nombre }}</h6>
                        <span class="text-xs">
                            @if($cupon->tipo_de_descuento == 'porcentaje')
                                % {{ $cupon->importe }} de descuento
                                @else
                                $  {{ $cupon->importe }} de descuento
                            @endif
                            <strong> -
                                <a type="button" class="" data-bs-toggle="modal" data-bs-target="#update_cupon_{{ $cupon->id }}" style="color: {{$configuracion->color_boton_add}};">
                                    Editar
                                </a>
                            </strong>
                        </span>

                    </div>
                </div>
            </li>
            @include('admin.marketing.modal_cupon_edit')
            @endforeach

            </ul>
        </div>
        </div>
    </div>
</div> --}}
