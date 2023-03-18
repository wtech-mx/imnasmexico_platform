<nav class="navbar navbar_custom navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
          <img src="{{ asset('assets/user/logotipos/imnas.webp')}}" alt="Logo" width="90"  class="d-inline-block align-text-top">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarScroll">
        <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;margin-left: 7rem;">
          <li class="nav-item">
            <a class="nav-link nav_link_custom active" aria-current="page" href="#">Calendario</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav_link_custom" href="#">Avales</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav_link_custom" href="#">Paquetes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav_link_custom" href="#">Nosotros</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav_link_custom" href="#">Tienda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav_link_custom" href="#">Instalaciones</a>
          </li>
        </ul>

        <div class="d-flex">
            <a class="btn btn-primario me-4" type="button" data-bs-toggle="modal" data-bs-target="#login_modal" style="font-size: 25px;">
                Acceso alumnas
            </a>
        </div>

      </div>
    </div>
  </nav>
