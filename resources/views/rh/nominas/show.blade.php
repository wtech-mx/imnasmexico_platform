@extends('layouts.app_admin')

@section('template_title')
    Nomina {{ $user->name }}
@endsection


@section('content')
<body class="g-sidenav-show bg-gray-100">
    @php
        if($user->genero == 'M'){
            $img = asset('images/img5.jpg');
        }else {
            $img = asset('images/img7.jpg');
        }
    @endphp
    <div class="main-content position-relative max-height-vh-100 h-100">
        <!-- =========== BARRA INICIAL =========== -->
        <div class="card shadow-lg mx-4 mb-4">
            <div class="container-fluid py-4 ">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                        <img src="{{ $img }}" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                        <h5 class="mb-1">
                            {{ $user->name }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ $user->puesto }}
                        </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                        <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Resumen</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link " id="pills-pagos-tab" data-bs-toggle="pill" data-bs-target="#pills-pagos" type="button" role="tab" aria-controls="pills-pagos" aria-selected="false">Pagos</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link " id="pills-config-tab" data-bs-toggle="pill" data-bs-target="#pills-config" type="button" role="tab" aria-controls="pills-config" aria-selected="false">Configuracion</button>
                            </li>
                        </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>


            <div class="tab-content" id="pills-tabContent">
                {{-- ==================== S E C C I O N  I N I C I O ==================== --}}
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="row">
                        <!-- =========== Informacion personal =========== -->
                        <div class="col-12 col-md-6 col-xl-4 mt-md-0 mt-4">
                            <div class="card h-100">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-md-8 d-flex align-items-center">
                                            <h6 class="mb-0">Informacion Personal</h6>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <a href="javascript:;">
                                                <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <p class="text-sm">
                                        Hi, I’m Alec Thompson, Decisions: If you can’t decide, the answer is no. If two equally difficult paths, choose the one more painful in the short term (pain avoidance is creating an illusion of equality).
                                    </p>
                                    <hr class="horizontal gray-light my-4">
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nombre:</strong> &nbsp; {{ $user->name }}</li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Telefono:</strong> &nbsp; {{ $user->telefono }}</li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Sueldo:</strong> &nbsp; $ {{ $user->sueldo }}</li>
                                        <li class="list-group-item border-0 ps-0 pb-0">
                                        <strong class="text-dark text-sm">Social:</strong> &nbsp;
                                        <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                                            <i class="fab fa-facebook fa-lg"></i>
                                        </a>
                                        <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                                            <i class="fab fa-twitter fa-lg"></i>
                                        </a>
                                        <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                                            <i class="fab fa-instagram fa-lg"></i>
                                        </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- =========== Solicitudes del año =========== -->
                        <div class="col-12 col-md-6 col-xl-4 mt-md-0 mt-4">
                            <div class="card">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-md-8 d-flex align-items-center">
                                            <h6 class="mb-0">Solicitudes del año</h6>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#solicitudModal">
                                                <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <ul class="list-group">
                                        @foreach ($solicitudes as $solicitud)
                                            @php
                                                if($solicitud->tipo_permiso == 'Vacaciones'){
                                                    $icon = asset('assets/cam/cp.png');
                                                } elseif ($solicitud->tipo_permiso == 'Enfermedad') {
                                                    $icon = asset('assets/cam/medico.png');
                                                } else {
                                                    $icon = asset('assets/cam/servidor-en-la-nube.png');
                                                }
                                            @endphp
                                            <li class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                                    <div class="d-flex align-items-center">
                                                        <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                                        <img src="{{ $icon }}" class="mt-2" width="20px">
                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="mb-1 text-dark text-sm">{{ $solicitud->tipo_permiso }}</h6>
                                                        <span class="text-xs">Del {{ $solicitud->fecha_inicio->format('d \d\e F') }}, <span class="font-weight-bold">al {{ $solicitud->fecha_fin->format('d \d\e F') }}</span></span>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- =========== Ventas =========== -->
                        @if ($user->puesto == 'Ventas')
                            <div class="col-12 col-md-6 col-xl-4 mt-md-0 mt-4">
                                <div class="card overflow-hidden shadow-lg mt-4" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/reports3.jpg'); background-size: cover;">
                                    <span class="mask bg-gradient-dark"></span>
                                    <div class="card-body p-3 position-relative">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-white text-uppercase text-sm mb-0 opacity-7">Cotizaciones Hechas</p>
                                                    <h5 class="text-white font-weight-bolder mb-0">
                                                        # 99
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                                                    <img src="{{ asset('assets/cam/catalogo.webp') }}" class="mt-2" width="40px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card overflow-hidden shadow-lg mt-4" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/reports2.jpg'); background-size: cover;">
                                    <span class="mask bg-gradient-dark"></span>
                                    <div class="card-body p-3 position-relative">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-white text-uppercase text-sm mb-0 opacity-7">Cotizaciones Vendidas</p>
                                                    <h5 class="text-white font-weight-bolder mb-0">
                                                        # 50
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                                                    <img src="{{ asset('assets/cam/factura.png.webp') }}" class="mt-2" width="40px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card overflow-hidden shadow-lg mt-4" style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/reports4.jpg'); background-size: cover;">
                                    <span class="mask bg-gradient-dark"></span>
                                    <div class="card-body p-3 position-relative">
                                        <div class="row">
                                            <div class="col-8">
                                                <div class="numbers">
                                                    <p class="text-white text-uppercase text-sm mb-0 opacity-7">Venta de cursos</p>
                                                    <h5 class="text-white font-weight-bolder mb-0">
                                                        # 50
                                                    </h5>
                                                </div>
                                            </div>
                                            <div class="col-4 text-end">
                                                <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                                                    <img src="{{ asset('assets/cam/elearning.png') }}" class="mt-2" width="40px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- =========== Situacion en  Nomina =========== -->
                        <div class="col-12 col-md-6 col-xl-4 mt-md-2 mt-4">
                            <div class="card h-100">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-md-8 d-flex align-items-center">
                                            <h6 class="mb-0">Situacion en  Nomina</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <ul class="list-group">
                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">¿Cuenta con seguro?:</strong> &nbsp; {{ $user->seguro_estatus }}</li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Fecha de ingreso:</strong> &nbsp; {{ \Carbon\Carbon::parse($user->fecha_ingreso)->format('d/m/Y') }}</li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Años de servicio:</strong> &nbsp; {{ $user->years_of_service }}</li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Días de vacaciones:</strong> &nbsp; {{ $user->vacation_days }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- =========== Tarjeta =========== -->
                        <div class="col-12 col-md-6 col-xl-6 mt-md-4 mt-4">
                            <div class="row">
                                @php
                                    if($user->banco == 'STP') {
                                        $img = asset('assets/bancos/stp.jpg');
                                        $logo = asset('assets/bancos/logo_stp.png');
                                    } elseif($user->banco == 'BBVA') {
                                        $img = asset('assets/bancos/bbva.webp');
                                        $logo = asset('assets/bancos/logo_bbva.png');
                                    } elseif($user->banco == 'Banamex') {
                                        $img = asset('assets/bancos/banamex.jpg');
                                        $logo = asset('assets/bancos/logo_banamex.png');
                                    } elseif($user->banco == 'Inbursa') {
                                        $img = asset('assets/bancos/inbursa.jpg');
                                        $logo = asset('assets/bancos/logo_inbursa.png');
                                    } elseif($user->banco == 'Mercado Pago') {
                                        $img = asset('assets/bancos/mercado_pago.jpg');
                                        $logo = asset('assets/bancos/logo_mercado.png');
                                    } elseif($user->banco == 'Banco Azteca') {
                                        $img = asset('assets/bancos/azteca.jpeg');
                                        $logo = asset('assets/bancos/logo_azteca.png');
                                    } elseif($user->banco == 'NU') {
                                        $img = asset('assets/bancos/nu.jpg');
                                        $logo = asset('assets/bancos/logo_nu.png');
                                    } else {
                                        $img = 'https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/card-visa.jpg';
                                    }
                                @endphp
                                <div class="col-6">
                                    <div class="card bg-transparent shadow-xl">
                                        <div class="overflow-hidden position-relative border-radius-xl" style="background-image: url('{{$img}}');background-position: center center; background-repeat: no-repeat; background-size: cover;">
                                            <span class="mask bg-gradient-dark"></span>
                                            <div class="card-body position-relative z-index-1 p-3">
                                                <h4 class="text-white mb-0">{{ $user->name }}</h4>
                                                <h5 class="text-white mt-4 mb-5 pb-2">{{ chunk_split($user->clabe, 4, ' ') }}</h5>
                                                <div class="d-flex">
                                                    <div class="d-flex">
                                                        <div class="me-4">
                                                            <p class="text-white text-sm opacity-8 mb-0">Nombre Banco</p>
                                                            <h6 class="text-white mb-0">{{ $user->banco }}</h6>
                                                        </div>
                                                    </div>
                                                    <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                                                        <img class="w-60 mt-2" src="{{$logo}}" alt="logo">
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

                <div class="tab-pane fade" id="pills-pagos" role="tabpanel" aria-labelledby="pills-pagos-tab">
                    <div class="card h-100">
                        <table class="table table-flush mt-2" id="datatable-search">
                            <thead class="thead">
                                <tr>
                                    <th>Dia</th>
                                    <th>Pago</th>
                                    <th>Motivo</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th>21/07/2025</th>
                                    <th>$3,500</th>
                                    <th>Sueldo </th>
                                    <th>
                                        <a target="_blank">Ver comprobante</a>
                                    </th>
                                </tr>
                                <tr>
                                    <th>14/07/2025</th>
                                    <th>$4,500</th>
                                    <th>Sueldo mas extra</th>
                                    <th>
                                        <a target="_blank">Ver comprobante</a>
                                    </th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="pills-config" role="tabpanel" aria-labelledby="pills-config-tab">
                    <div class="row">
                        <!-- =========== Editar informacion =========== -->
                        <div class="col-12 col-md-12 col-xl-12 mt-md-2 mt-4 mb-4">
                            <div class="card h-100">
                                <div class="card-header pb-0 p-3">
                                    <div class="row">
                                        <div class="col-md-8 d-flex align-items-center">
                                            <h6 class="mb-0">Editar informacion</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body p-3">
                                    <div class="row">
                                        <div class="col-12 form-group">
                                            <label for="name">Nombre </label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/user_predeterminado.webp') }}" alt="" width="25px">
                                                </span>
                                                <input name="name" id="name" type="text" class="form-control" value="{{ $user->name }}" required>
                                            </div>
                                        </div>

                                        <div class="col-3 form-group">
                                            <label for="telefono">Telefono </label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/user_predeterminado.webp') }}" alt="" width="25px">
                                                </span>
                                                <input name="telefono" id="telefono" type="text" class="form-control" value="{{ $user->telefono }}" required>
                                            </div>
                                        </div>

                                        <div class="col-3 form-group">
                                            <label for="puesto">Puesto </label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/user_predeterminado.webp') }}" alt="" width="25px">
                                                </span>
                                                <select id="puesto" name="puesto" class="form-select" required>
                                                    <option value="{{ $user->puesto }}">{{ $user->puesto }}</option>
                                                    <option value="Ventas">Ventas</option>
                                                    <option value="Contenido Digital">Contenido Digital</option>
                                                    <option value="Atencion a Clientes">Atencion a Clientes</option>
                                                    <option value="Laboratorio">Laboratorio</option>
                                                    <option value="Atencion a Clientes CAM">Atencion a Clientes CAM</option>
                                                    <option value="Diseño">Diseño</option>
                                                    <option value="Bodega">Bodega</option>
                                                    <option value="Tiendita">Tiendita</option>
                                                    <option value="Conocer Documentos">Conocer Documentos</option>
                                                    <option value="Diseñadora">Diseñadora</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-3 form-group">
                                            <label for="seguro_estatus">¿Dado de alta en seguro? </label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/user_predeterminado.webp') }}" alt="" width="25px">
                                                </span>
                                                <select id="seguro_estatus" name="seguro_estatus" class="form-select" required>
                                                    <option value="{{ $user->seguro_estatus }}">{{ $user->seguro_estatus }}</option>
                                                    <option value="Si">Si</option>
                                                    <option value="No">No</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-3 form-group">
                                            <label for="sueldo">Sueldo</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/user_predeterminado.webp') }}" alt="" width="25px">
                                                </span>
                                                <input name="sueldo" id="sueldo" type="text" class="form-control" value="{{ $user->sueldo }}" required>
                                            </div>
                                        </div>

                                        <div class="col-4 form-group">
                                            <label for="fecha_contrato">Fecha Contrato </label>
                                            <input name="fecha_ingreso" id="fecha_ingreso" type="date" class="form-control" value="{{ $user->fecha_ingreso }}" required>
                                        </div>

                                        <div class="col-4 form-group">
                                            <label for="fecha_contrato">CV </label>
                                            <input name="cv" id="cv" type="file" class="form-control" value="{{ $user->cv }}">
                                        </div>

                                        <div class="col-4 form-group">
                                            <label for="curp">Curp </label>
                                            <input name="curp" id="curp" type="file" class="form-control" value="{{ $user->curp }}">
                                        </div>

                                        <div class="col-3 form-group">
                                            <label for="banco">Banco</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/user_predeterminado.webp') }}" alt="" width="25px">
                                                </span>
                                                <select id="banco" name="banco" class="form-select">
                                                    <option value="{{ $user->banco }}">{{ $user->banco }}</option>
                                                    <option value="STP">STP</option>
                                                    <option value="BBVA">BBVA</option>
                                                    <option value="Banamex">Banamex</option>
                                                    <option value="Inbursa">Inbursa</option>
                                                    <option value="Mercado Pago">Mercado Pago</option>
                                                    <option value="Banco Azteca">Banco Azteca</option>
                                                    <option value="NU">NU</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-3 form-group">
                                            <label for="tipo_cuenta">Tipo cuenta</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/user_predeterminado.webp') }}" alt="" width="25px">
                                                </span>
                                                <select id="tipo_cuenta" name="tipo_cuenta" class="form-select" required>
                                                    <option value="{{ $user->tipo_cuenta }}">{{ $user->tipo_cuenta }}</option>
                                                    <option value="Clabe">Clabe</option>
                                                    <option value="Tarjeta Debito">Tarjeta Debito</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-6 form-group">
                                            <label for="numero_cuenta">Numero cuenta</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/user_predeterminado.webp') }}" alt="" width="25px">
                                                </span>
                                                <input name="numero_cuenta" id="numero_cuenta" type="text" class="form-control" value="{{ $user->numero_cuenta }}" required>
                                            </div>
                                        </div>

                                        <div class="col-4 form-group">
                                            <label for="clave_stp">Clave STP</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/user_predeterminado.webp') }}" alt="" width="25px">
                                                </span>
                                                <input name="clave_stp" id="clave_stp" type="text" class="form-control" value="{{ $user->clave_stp }}" required>
                                            </div>
                                        </div>

                                        <div class="col-4 form-group">
                                            <label for="genero">Genero</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="basic-addon1">
                                                    <img src="{{ asset('assets/cam/user_predeterminado.webp') }}" alt="" width="25px">
                                                </span>
                                                <select id="genero" name="genero" class="form-select" required>
                                                    <option value="{{ $user->genero }}">{{ $user->genero }}</option>
                                                    <option value="M">M</option>
                                                    <option value="F">F</option>
                                                </select>
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
    @include('rh.solicitudes.modal_solicitud')
</body>
@endsection

@section('datatable')

@endsection
