<style>
#resultadoBusqueda {
    width: 100%; /* Asegura que tenga el mismo ancho del formulario */
    left: 0; /* Alinea el ul con el input */
}

</style>

<header class="py-3 border-bottom fixed-top" style="height: 100px;background-color: #EBDBDB;border-radius: 0 0 29px 29px;box-shadow: 6px 6px 9px -6px rgba(0, 0, 0, 0.25);">
    <div class="container d-flex align-items-center justify-content-between">

        <!-- LOGO -->
        <a href="{{route("tienda_online.index")}}" class="me-3">
            <img class="img_logo_header" src="{{ asset('ecommerce/logo_nas_h.png') }}" alt="" style="max-width: 160px;">
        </a>

        <!-- BUSCADOR EN EL CENTRO (Visible en PC) -->
        <div class="d-none d-lg-block flex-grow-1 mx-3 position-relative">
            <form class="w-100" role="search">
                <div class="input-group">
                    <input type="text" id="buscador" class="form-control" placeholder="Buscar producto...">
                    <div id="spinnerBusqueda" class="spinner-border text-primary ms-2" role="status" style="display: none; width: 1.5rem; height: 1.5rem;">
                        <span class="visually-hidden">Cargando...</span>
                    </div>
                </div>
                <ul id="resultadoBusqueda" class="list-group position-absolute w-100" style="max-height: 200px; overflow-y: auto; z-index: 1000;"></ul>
            </form>
        </div>

        <!-- ICONOS + BOTÓN MENÚ -->
        <div class="d-flex align-items-center">

            <!-- ICONOS SIEMPRE VISIBLES -->
            <ul class="nav flex-row d-flex align-items-center">
                <li class="nav-item">
                    <a href="{{ route('cart.index') }}" class="nav-link px-1 px-md-2 px-lg-2">
                        <i class=" icons_header bi bi-cart2" style="color: #875053;    color: #ffffff;background: #D19B9B;padding: 10px 10px 10px 10px;border-radius: 16px;"></i>
                        <span class="badge rounded-pill bg-danger" id="contador-carrito">
                            {{ session('cart_productos') ? count(session('cart_productos')) : 0 }}
                        </span>
                    </a>
                </li>


                {{-- <li class="nav-item">
                    <a href="#" class="nav-link px-1 px-md-2 px-lg-2 ">
                        <i class="text-white icons_header bi bi-person"></i>
                    </a> --}}

                <li class="nav-item">
                    <a target="_blank" href="https://maps.app.goo.gl/bgpY7t7DiifF4KH6A" class="nav-link px-1 px-md-2 px-lg-2 text_ubi_header" style="color: #875053">
                        <i class=" icons_header bi bi-geo-alt" style="color: #875053""></i></a>
                </li>
                <li class="nav-item">

                    <a target="_blank" href="https://maps.app.goo.gl/bgpY7t7DiifF4KH6A" class="nav-link px-1 px-md-2 px-lg-2 text_ubi_header"  style="color: #875053">
                         Castilla 136 <br> Álamos, CDMX
                    </a>
                </li>
            </ul>

        </div>

    </div>

    <!-- BUSCADOR EN MÓVIL -->
    <div class="container d-lg-none mt-2 position-relative">
        <form class="w-100" role="search">
            <div class="input-group">
                <input type="search" id="buscador-movil" class="form-control" placeholder="Buscar productos..." aria-label="Search">
                <div id="spinnerBusquedaMovil" class="spinner-border text-primary ms-2" role="status" style="display: none; width: 1.5rem; height: 1.5rem;">
                    <span class="visually-hidden">Cargando...</span>
                </div>
            </div>
            <ul id="resultadoBusquedaMovil" class="list-group position-absolute w-100" style="max-height: 200px; overflow-y: auto; z-index: 1000;"></ul>
        </form>
    </div>
</header>
