<div class="container-lg px-2 px-md-3 px-lg-4 py-0 py-md-3 py-lg-3">
    <div class="row">
        <div class="col-12">
            <hr class="hr_custom">
        </div>
    </div>
</div>

<div class="container-lg px-2 px-md-3 px-lg-4 py-0 py-md-3 py-lg-3">
    <div class="row">
        <div class="col-12">
            <div class="my-auto mx-auto img_footer" style="background: url('{{ asset('ecommerce/Logo_horizontal_negro.png') }}') #ffffff00  50% / contain no-repeat;"></div>
        </div>
    </div>

    <footer class="d-flex flex-wrap justify-content-between align-items-center ">
    <div class="col">

    </div>

    <div class="col-10 ">
        <div class="row mt-4">
            <div class="col-12 col-sm-4 col-lg-4 mb-3">
                <h5 class="text-center mb-3">Contactanos</h5>
                <ul class="nav flex-column" style="align-items: center;">
                <li class="nav-item mb-2">
                    <a href="mailto:ventas@zocofresh.com.mx" class="nav-link p-0 text-body-secondary">
                    <i class="bi bi-envelope"></i> ventas@zocofresh.com.mx</a>
                </li>

                <li class="nav-item mb-2">
                    <a target="_blank" href="tel:+5589142564" class="nav-link p-0 text-body-secondary">
                    <i class="bi bi-phone"></i>5589142564</a>
                </li>
                <li class="nav-item mb-2">
                    <a target="_blank" href="tel:+5586142565" class="nav-link p-0 text-body-secondary">
                    <i class="bi bi-phone"></i>5586142565</a>
                </li>
                <li class="nav-item mb-2">
                    <a target="_blank" href="https://api.whatsapp.com/send?phone=521{{ $configuracion->whatsapp }}" class="nav-link p-0 text-body-secondary">
                    <i class="bi bi-whatsapp"></i> {{ $configuracion->whatsapp }}</a>
                </li>
                <li class="nav-item mb-2">
                    <a target="_blank" href="{{ $configuracion->instagram }}" class="nav-link p-0 text-body-secondary">
                    <i class="bi bi-instagram"></i> Instagram</a>
                </li>
                <li class="nav-item mb-2">
                    <a target="_blank" href="{{ $configuracion->facebook }}" class="nav-link p-0 text-body-secondary">
                    <i class="bi bi-facebook"></i> Facebook </a>
                </li>
                <li class="nav-item mb-2">
                    <a target="_blank" href="https://www.youtube.com/@ZOCOFRESH/shorts" class="nav-link p-0 text-body-secondary">
                    <i class="bi bi-youtube"></i> YouTube</a>
                </li>
                </ul>
            </div>

            <div class="col-12 col-sm-4 col-lg-4 mb-3">
                <h5 class="text-center mb-3">Acerca de ZocoFresh</h5>
                <ul class="nav flex-column" style="align-items: center;">
                <li class="nav-item mb-2"><a href="{{ route('terminos.index') }}" class="navl  ink p-0 text-body-secondary">Terminos y Condiciones</a></li>
                <li class="nav-item mb-2"><a href="{{ route('aviso.index') }}" class="na  -link p-0 text-body-secondary">Aviso de Provacidad</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Centro de Ayuda</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">Sobre Nosotros</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">FAQS</a></li>
                <li class="nav-item mb-2"><a href="{{ route('login') }}" class="nav-link p-0 text-body-secondary">Acceder</a></li>
                </ul>
            </div>

            <div class="col-12 col-sm-4 col-lg-4 mb-3">
                <h5 class="text-center mb-3">Formas de pago</h5>
                <p class="text-center">
                    <img src="{{ asset('ecommerce/formas_pago.png') }}" alt="" style="width: 80%">
                </p>
                <p class="text-center">
                    <img src="{{ asset('ecommerce/ssl.png') }}" alt="" style="width: 80%">
                </p>
            </div>
        </div>
    </div>

    <div class="col">

    </div>

    </footer>
</div>
