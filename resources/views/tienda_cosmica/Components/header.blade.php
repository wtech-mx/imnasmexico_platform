<nav class="navbar navbar-expand-lg bg-white">
    <div class="container py-3">
        <!-- Botón toggler para dispositivos móviles -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Logo centrado -->
        <a class="navbar-brand mx-auto order-lg-2 position-absolute start-50 translate-middle-x" href="{{ route('tienda.home') }}">
            <img src="{{ asset('cosmika/menu/logo.png') }}" alt="Logo" style="width: 80px;">
        </a>

        <!-- Contenido del menú -->
        <div class="collapse navbar-collapse order-lg-1" id="navbarNav">
            <!-- Lista a la izquierda -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('tienda.home') }}">Inicio</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Categorías
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('tienda.productos_faciales') }}">Facial</a></li>
                        <li><a class="dropdown-item" href="{{ route('tienda.productos_corporales') }}">Corporal</a></li>
                        <li><a class="dropdown-item" href="{{ route('tienda.productos') }}">Todo</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tienda.productos') }}">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tienda.about') }}">Sobre Nosotros</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('tienda.afiliadas') }}">Distribuidoras</a>
                </li>
            </ul>
        </div>

        <!-- Iconos a la derecha -->
        <div class="d-flex order-lg-3">
            <a href="#" target="_blank" class="btn me-2">
                <img src="{{ asset('cosmika/menu/CORAZON.png') }}" alt="Favoritos"  class="icons_header" style="">
            </a>
            <a href="#" class="btn me-2">
                <img src="{{ asset('cosmika/menu/LUPA.png') }}" alt="Buscar"  class="icons_header" style="">
            </a>
            <a href="#" class="btn">
                <img src="{{ asset('cosmika/menu/BOLSA-DE-COMPRA.png') }}" alt="Carrito"  class="icons_header" style="">
            </a>
        </div>
    </div>
</nav>
