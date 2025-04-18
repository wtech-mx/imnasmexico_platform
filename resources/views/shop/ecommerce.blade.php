@extends('layouts.app_ecommerce')

@section('template_title') Home @endsection

@section('css_custom')

<style>

.input-group:not(.has-validation)>.dropdown-toggle:nth-last-child(n+3), .input-group:not(.has-validation)>.form-floating:not(:last-child)>.form-control, .input-group:not(.has-validation)>.form-floating:not(:last-child)>.form-select, .input-group:not(.has-validation)>:not(:last-child):not(.dropdown-toggle):not(.dropdown-menu):not(.form-floating) {
    background: #D19B9B;
    border-radius: 13px;
    color: #fff;
}

.input-group:not(.has-validation)>.dropdown-toggle:nth-last-child(n+3), .input-group:not(.has-validation)>.form-floating:not(:last-child)>.form-control, .input-group:not(.has-validation)>.form-floating:not(:last-child)>.form-select, .input-group:not(.has-validation)>:not(:last-child):not(.dropdown-toggle):not(.dropdown-menu):not(.form-floating)::placeholder {
    color: #fff;
}

</style>

@endsection

@section('ecomeerce')

@include('shop.components.categorias_corporales')

    <div class="container-lg  px-2 px-md-3 px-lg-4 py-3">
        <div id="carouselExample" class="carousel slide" data-bs-interval="4000" data-bs-ride="carousel">

            <div class="carousel-inner img_banners">
                @php
                    $activeAdded = false; // Asegurar que solo un elemento tenga la clase 'active'
                @endphp
                @foreach ($nas_slide as $item)
                    @if ($item->seccion === 'NAS_SLIDE')
                        @if ($item->tipo === 'imagen')
                            <a href="{{ $item->link }}">
                                <div class="carousel-item {{ !$activeAdded ? 'active' : '' }}">
                                <img src="{{asset('noticias/'.$item->multimedia) }}" class="d-block w-100" alt="{{ $item->titulo }}">
                                </div>
                            </a>


                        @elseif ($item->tipo === 'Video')
                            <div class="carousel-item {{ !$activeAdded ? 'active' : '' }}">
                                <video controls autoplay muted>
                                    <source src="{{asset('noticias/'.$item->multimedia) }}" type="video/mp4">
                                </video>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    @include('shop.components.categories_ecommerce')

    @include('shop.components.products_slide')

    @include('shop.components.promos')

    @include('shop.components.categories_slide')


@endsection

