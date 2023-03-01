<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="{{ route('dashboard') }}" target="">
        <img src="{{asset('logo/'.$configuracion->logo) }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold"></span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
      <ul class="navbar-nav">

        <li class="nav-item">
          <a class="nav-link {{ (Request::is('dashboard*') ? 'active' : '') }}" href="{{ route('dashboard') }}" target="">
            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
             <i class="ni ni-calendar-grid-58 text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
            </div>
            <span class="nav-link-text ms-1">Inicio</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ (Request::is('clients*') ? 'active' : '') }}" href="" target="">
            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
             <i class="ni ni-circle-08 text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
            </div>
            <span class="nav-link-text ms-1">Clientes</span>
          </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ (Request::is('notas/servicios*') ? 'active' : '') }}" href="">
                <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                    <i class="ni ni-book-bookmark text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                </div>
                <span class="nav-link-text ms-1">Notas Servicios</span>
            </a>
        </li>

        <li class="nav-item">
          <a class="nav-link {{ (Request::is('notas/pedidos*') ? 'active' : '') }}" href="" target="">
            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
             <i class="ni ni-basket text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
            </div>
            <span class="nav-link-text ms-1">Notas Pedidos</span>
          </a>
        </li>


        <li class="nav-item">
          <a class="nav-link {{ (Request::is('paquetes/servicios*') ? 'active' : '') }}" href="" target="">
            <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-file text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>

            </div>
            <span class="nav-link-text ms-1">Notas Paquetes</span>
          </a>
        </li>

        @can('caja')
            <li class="nav-item">
            <a class="nav-link {{ (Request::is('caja*') ? 'active' : '') }}" href="" target="">
                <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-money-coins text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
                </div>
                <span class="nav-link-text ms-1">Caja</span>
            </a>
            </li>
        @endcan

        <li class="nav-item mt-3">
          <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Administrativo</h6>
        </li>

        <li class="nav-item">
        <a data-bs-toggle="collapse" href="#pagesExamples1" class="nav-link {{ (Request::is('servicio*') ? 'active' : '') }}{{ (Request::is('reporte*') ? 'active' : '') }}" aria-controls="pagesExamples1" role="button" aria-expanded="false">
            <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                <i class="ni ni-collection text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
            </div>
            <span class="nav-link-text ms-1">Administrativo</span>
        </a>
        <div class="collapse mb-3" id="pagesExamples1">
        <ul class="nav ms-4">
            <li class="nav-item ">
            <a class="nav-link {{ (Request::is('servicio*') ? 'show' : '') }}" href="">
                <span class="sidenav-mini-icon"> P </span>
                <span class="sidenav-normal">Servicio</span>
            </a>

            @can('reportes')
                <a class="nav-link {{ (Request::is('reporte*') ? 'show' : '') }}" href="">
                    <span class="sidenav-mini-icon"> P </span>
                    <span class="sidenav-normal">Reporte</span>
                </a>
            @endcan
            </li>
        </ul>
        </div>

          <a data-bs-toggle="collapse" href="#pagesExamples" class="nav-link {{ (Request::is('users*') ? 'active' : '') }}{{ (Request::is('roles*') ? 'active' : '') }}" aria-controls="pagesExamples" role="button" aria-expanded="false">
            <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
              <i class="ni ni-settings text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
            </div>
            <span class="nav-link-text ms-1">Roles y Permisos</span>
          </a>
          <div class="collapse " id="pagesExamples">
            <ul class="nav ms-4">
              <li class="nav-item ">
                <a class="nav-link {{ (Request::is('users*') ? 'show' : '') }}" href="">
                  <span class="sidenav-mini-icon"> P </span>
                  <span class="sidenav-normal">Usuarios</span>
                </a>

                <a class="nav-link {{ (Request::is('roles*') ? 'show' : '') }}" href="">
                  <span class="sidenav-mini-icon"> P </span>
                  <span class="sidenav-normal">Roles</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

        <li class="nav-item mt-3">
          <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Configuraciones</h6>
        </li>

        <li class="nav-item">
          <a data-bs-toggle="collapse" href="#sistem" class="nav-link {{ (Request::is('users*') ? 'active' : '') }}{{ (Request::is('roles*') ? 'active' : '') }}" aria-controls="sistem" role="button" aria-expanded="false">
            <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
              <i class="ni ni-settings-gear-65 text-sm opacity-10" style="color: {{$configuracion->color_iconos_sidebar}}"></i>
            </div>
            <span class="nav-link-text ms-1">Configuraciones</span>
          </a>
          <div class="collapse " id="sistem">
            <ul class="nav ms-4">
              <li class="nav-item ">
                <a class="nav-link {{ (Request::is('configuracion*') ? 'show' : '') }}" href="#">
                  <span class="sidenav-mini-icon">U</span>
                  <span class="sidenav-normal">Horarios</span>
                </a>
              </li>
            </ul>
          </div>
          <div class="collapse " id="sistem">
            <ul class="nav ms-4">
              <li class="nav-item ">
                <a class="nav-link {{ (Request::is('configuracion*') ? 'show' : '') }}" href="{{ route('index.configuracion') }}">
                  <span class="sidenav-mini-icon">U</span>
                  <span class="sidenav-normal">Pagina</span>
                </a>
              </li>
            </ul>
          </div>
        </li>

      </ul>

    </div>

  </aside>
