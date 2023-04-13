<nav class="navbar navbar_custom navbar-expand-md bg-body-tertiary">
    <div class="container-fluid">

      <a class="navbar-brand" href="{{ route('user.home') }}">
          <img src="{{asset('assets/user/logotipos/imnas.webp')}}" class="image_navbar d-inline-block align-text-top">
      </a>

      <a class="btn btn-primario acceso_alumnas_flex_prim me-4" type="button" data-bs-toggle="modal" data-bs-target="#login_modal" style="font-size: 25px;">
        Acceso alumn@s
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse nav_resp" id="navbarNavDropdown">
        <ul class="navbar-nav me-auto navbar_ul_custom my-2 my-lg-0 navbar-nav-scroll" style="">
          <li class="nav-item">
            <a class="nav-link nav_link_custom {{ (Request::is('/*') ? 'active' : '') }}" aria-current="page" href="{{ route('user.home') }}">Inicio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav_link_custom {{ (Request::is('calendario*') ? 'active' : '') }}" aria-current="page" href="{{ route('cursos.index_user') }}">Calendario</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav_link_custom {{ (Request::is('paquetes*') ? 'active' : '') }}" href="{{ route('cursos.paquetes') }}">Paquetes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav_link_custom {{ (Request::is('avales*') ? 'active' : '') }}" href="{{ route('user.avales') }}">Avales</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav_link_custom {{ (Request::is('nosotros*') ? 'active' : '') }}" href="{{ route('user.nosotros') }}">Nosotros</a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link nav_link_custom {{ (Request::is('calendario*') ? 'active' : '') }}" href="#">Nosotros</a>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link nav_link_custom" target="_blank" href="https://imnasmexico.com/new/tienda/">Tienda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav_link_custom {{ (Request::is('nuestras_instalaciones*') ? 'active' : '') }}" href="{{ route('user.instalaciones') }}">Instalaciones</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav_link_custom" data-bs-toggle="modal" data-bs-target="#checkout_modal" href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i> {{ count((array) session('cart')) }}</a>
          </li>

          {{-- <li>
            <a type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#checkout_modal">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> Cart <span class="badge badge-pill badge-danger">{{ count((array) session('cart')) }}</span>
            </a>
          </li> --}}
        </ul>

        <div class="d-flex acceso_alumnas_flex">
            @guest
                <a class="btn btn-login me-4" type="button" data-bs-toggle="modal" data-bs-target="#login_modal" style="font-size: 25px;">
                    Acceso alumn@s
                </a>
            @else
                {{-- <a class="btn btn-primario me-4" type="button" href="{{ route('signout') }}">Cerrar Sesion</a> --}}
                <a class="btn btn-primario me-4" type="button" href="{{ route('perfil.index', auth()->user()->code) }}">Perfil</a>
            @endguest
        </div>

      </div>
    </div>
  </nav>


