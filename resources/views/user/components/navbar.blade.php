<nav class="navbar navbar_custom navbar-expand-md bg-body-tertiary">
    <div class="container-fluid">

      <a class="navbar-brand" href="{{ route('user.home') }}">
          <img src="{{ asset('assets/user/logotipos/imnas.webp')}}" class="image_navbar d-inline-block align-text-top">
      </a>

      <a class="btn btn-primario acceso_alumnas_flex_prim me-4" type="button" data-bs-toggle="modal" data-bs-target="#login_modal" style="font-size: 25px;">
        Acceso alumnas
      </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse nav_resp" id="navbarNavDropdown">
        <ul class="navbar-nav me-auto navbar_ul_custom my-2 my-lg-0 navbar-nav-scroll" style="">
          <li class="nav-item">
            <a class="nav-link nav_link_custom active" aria-current="page" href="{{ route('cursos.index_user') }}">Calendario</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav_link_custom" href="avales">Avales</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav_link_custom" href="paquetes">Paquetes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav_link_custom" href="#">Nosotros</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav_link_custom" href="#">Tienda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav_link_custom" href="nuestras_instalaciones">Instalaciones</a>
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
                    Acceso alumnas
                </a>
            @else
                {{-- <a class="btn btn-primario me-4" type="button" href="{{ route('signout') }}">Cerrar Sesion</a> --}}
                <a class="btn btn-primario me-4" type="button" href="{{ route('perfil.index') }}">Perfil</a>
            @endguest
        </div>

      </div>
    </div>
  </nav>

  <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Home</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="pills-disabled-tab" data-bs-toggle="pill" data-bs-target="#pills-disabled" type="button" role="tab" aria-controls="pills-disabled" aria-selected="false" disabled>Disabled</button>
    </li>
  </ul>
  <div class="tab-content" id="pills-tabContent">
    <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">...</div>
    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">...</div>
    <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">...</div>
    <div class="tab-pane fade" id="pills-disabled" role="tabpanel" aria-labelledby="pills-disabled-tab" tabindex="0">...</div>
  </div>


