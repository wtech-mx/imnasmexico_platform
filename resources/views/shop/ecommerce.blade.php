@extends('layouts.app_ecommerce')

@section('template_title') Home @endsection

@section('css_custom')

@endsection

@section('ecomeerce')

@include('shop.components.categorias_corporales')

<div class="container-lg mt-10 px-2 px-md-3 px-lg-4 py-3">
    <div id="carouselExample" class="carousel slide" data-bs-interval="4000" data-bs-ride="carousel">

        <div class="carousel-inner img_banners">
            @foreach ($nas_slide as $item)
                 @if ($item->seccion === 'NAS_SLIDE')
                    @if ($item->tipo === 'imagen')
                        <a href="{{ $item->link }}">
                            <img src="{{asset('noticias/'.$item->multimedia) }}" class="d-block w-100" alt="{{ $item->titulo }}">
                        </a>
                    @elseif ($item->tipo === 'Video')
                        <video controls autoplay muted>
                            <source src="{{asset('noticias/'.$item->multimedia) }}" type="video/mp4">
                        </video>
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

