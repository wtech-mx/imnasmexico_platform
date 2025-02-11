<nav class="navbar navbar-expand-lg bg-white sticky-top">
    <div class="container py-3">
        <!-- Botón toggler para dispositivos móviles -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Logo centrado -->
        <a class="navbar-brand mx-auto order-lg-2 position-absolute start-50 translate-middle-x" href="{{ route('tienda.home') }}">
            <img src="{{ asset('cosmika/menu/logo.png') }}" class="logo_header" alt="Logo" style="">
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
                    <a class="nav-link" href="{{ route('distribuidoras.index_distribuidoras') }}">Distribuidoras</a>
                </li>
            </ul>
        </div>

        <!-- Iconos a la derecha -->
        <div class="d-flex order-lg-3">
            <i class="fa-solid fa-magnifying-glass icons_header my-auto" alt="Buscar" id="toggleForm"></i>

            <form class="w-100 d-none" role="search" id="searchForm">
                <input type="text" id="buscador" class="form-control" placeholder="Buscar producto...">
                <ul id="resultadoBusqueda" class="list-group position-absolute" style="max-height: 200px; overflow-y: auto; z-index: 1000;"></ul>
            </form>

            <a href="{{ route('tienda.cart') }}" class="btn position-relative">
                <i class="fa-solid fa-cart-shopping icons_header my-auto"></i>
                <span id="cart-count" class="badge bg-danger {{ session('cart_productos') ? '' : 'd-none' }}">
                    {{ session('cart_productos') ? array_sum(array_column(session('cart_productos'), 'cantidad')) : 0 }}
                </span>

            </a>

        </div>

    </div>
</nav>
