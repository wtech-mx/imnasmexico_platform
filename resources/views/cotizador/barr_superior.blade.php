<style>
    .btn-outline-primary {
    --bs-btn-color: #2D2432;
    --bs-btn-border-color: #2D2432;
    --bs-btn-hover-color: #fff;
    --bs-btn-hover-bg: #2D2432;
    --bs-btn-hover-border-color: #2D2432;
    --bs-btn-focus-shadow-rgb: 13, 110, 253;
    --bs-btn-active-color: #fff;
    --bs-btn-active-bg: #2D2432;
    --bs-btn-active-border-color: #2D2432;
    --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
    --bs-btn-disabled-color: #2D2432;
    --bs-btn-disabled-bg: transparent;
    --bs-btn-disabled-border-color: #2D2432;
    --bs-gradient: none;
}

.btn-outline-dark {
    --bs-btn-color: #D19B9B;
    --bs-btn-border-color: #D19B9B;
    --bs-btn-hover-color: #fff;
    --bs-btn-hover-bg: #D19B9B;
    --bs-btn-hover-border-color: #D19B9B;
    --bs-btn-focus-shadow-rgb: 13, 110, 253;
    --bs-btn-active-color: #fff;
    --bs-btn-active-bg: #D19B9B;
    --bs-btn-active-border-color: #D19B9B;
    --bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
    --bs-btn-disabled-color: #D19B9B;
    --bs-btn-disabled-bg: transparent;
    --bs-btn-disabled-border-color: #D19B9B;
    --bs-gradient: none;
}
</style>


<div class="col-12 mb-3">
    <div class="d-flex justify-content-start mt-3 mb-1 product-navbar my-auto">

        @php
            setlocale(LC_TIME, 'es_MX.UTF-8');
            $fecha = \Carbon\Carbon::now()->translatedFormat('l d F Y');
        @endphp

        <p class="p-2 my-auto">
            <i class="bi bi-calendar3 p-2"></i>{{ ucfirst($fecha) }}
        </p>

        <p class="p-2 my-auto">
            <i class="bi bi-clock p-2"></i> <span id="hora-actual"></span>
        </p>

        <p class="my-auto">
            <a class="btn btn-sm btn-outline-dark" href="{{ route('index_cosmica.cotizador') }}">Comica</a>
            <a class="btn btn-sm btn-outline-primary" href="{{ route('index_nas.cotizador') }}">NAS</a>
        </p>
    </div>
</div>
