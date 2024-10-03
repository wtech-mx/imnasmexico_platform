<style>

.navbar > .container, .navbar > .container-fluid, .navbar > .container-sm, .navbar > .container-md, .navbar > .container-lg, .navbar > .container-xl, .navbar > .container-xxl {
    background: #2D2034;
}

.nav_link_custom {
    color: #fff;
}

.nav-link:hover, .nav-link:focus {
    color: #c39691!important;
}

.image_cosmika{
       width: 15%;
}

@media only screen and (max-width: 1700px) {
    .image_cosmika{
       width: 30%;
}

}

@media only screen and (max-width: 1200px) {
    .image_cosmika{
       width: 45%;
}

}

@media only screen and (max-width: 1000px) {
    .image_cosmika{
       width: 60%;
}

}

@media only screen and (max-width: 850px) {
    .image_cosmika{
       width: 65%;
}

}

</style>

<nav class="navbar navbar_custom navbar-expand-md bg-body-tertiary" style="    background-color: #2D2034 !important;border: solid 3px #fff;">
    <div class="container-fluid">



      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse nav_resp" id="navbarNavDropdown">
        <ul class="navbar-nav me-auto navbar_ul_custom my-2 my-lg-0 navbar-nav-scroll" style="">

          <li class="nav-item">
            <a class="nav-link nav_link_custom" aria-current="page" href="https://cosmicaskin.com">Inicio</a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link nav_link_custom dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Linea Corporal
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="https://cosmicaskin.com/categoria-producto/astros-terapia-para-la-piel/">Terapia Para La Piel</a></li>
              <li><a class="dropdown-item" href="https://cosmicaskin.com/categoria-producto/galaxia-hydraboosters-corporales/">Hydraboosters</a></li>
              <li><a class="dropdown-item" href="https://cosmicaskin.com/categoria-producto/eclipse-velas-para-masje/">Velas Para Masaje</a></li>
              <li><a class="dropdown-item" href="https://cosmicaskin.com/categoria-producto/renacer-aceite-gel-para-masajes/">Aceite & Gel para masajes</a></li>
              <li><a class="dropdown-item" href="https://cosmicaskin.com/categoria-producto/flash-geles-corporales/">Geles</a></li>

            </ul>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link nav_link_custom dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Linea Facial
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="https://cosmicaskin.com/categoria-producto/nebulosa-limpieza/">Limpieza</a></li>
              <li><a class="dropdown-item" href="https://cosmicaskin.com/categoria-producto/constelacion-acidos/">Ácidos</a></li>
              <li><a class="dropdown-item" href="https://cosmicaskin.com/categoria-producto/venus-serum-y-tonico/">Serum y Tónico</a></li>
              <li><a class="dropdown-item" href="https://cosmicaskin.com/categoria-producto/espectro-mascarilla-peel-off/">Mascarilla Peel Off</a></li>
              <li><a class="dropdown-item" href="https://cosmicaskin.com/categoria-producto/mascarillas-estelares-fangos/">Fangos</a></li>
              <li><a class="dropdown-item" href="https://cosmicaskin.com/categoria-producto/pluton-mascarillas-hidroplasticas/">Mascarillas Hidroplásticas</a></li>
              <li><a class="dropdown-item" href="https://cosmicaskin.com/categoria-producto/solar-fps-50/">FPS 50+</a></li>
              <li><a class="dropdown-item" href="https://cosmicaskin.com/categoria-producto/lunar-hydraboosters-faciales/">Hydraboosters</a></li>
            </ul>
          </li>


          <li class="nav-item">
            <a class="nav-link nav_link_custom "  href="https://cosmicaskin.com/about/ "  style="width: 230px;">¿Quienes Somos?</a>
          </li>

          <li class="nav-item">
            <a class="nav-link nav_link_custom" target="" href="https://plataforma.imnasmexico.com/distribuidoras">Distribuidoras</a>
          </li>

          <a class="navbar-brand" href="{{ route('user.home') }}">
            <img src="{{asset('assets/user/logotipos/cosmica.png')}}" class="image_cosmika d-inline-block align-text-top" style="">
         </a>

        </ul>

      </div>
    </div>
  </nav>


