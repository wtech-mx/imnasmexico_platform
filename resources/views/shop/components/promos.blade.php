<div class="container-lg px-2 px-md-3 px-lg-4 py-0 py-md-3 py-lg-3">
    <div class="row">
        <div class="col-12">
            <h3 class="mb-4">
                Ofertas y Promociones
            </h3>
        </div>

        <div id="loop_ofertasPromos" class="owl-carousel owl-theme">
            @foreach ($banner_slide as $item)
                <a href="{{$item->link}}">
                    <img class="img_post_promos" src="{{asset('noticias/'.$item->multimedia) }}" alt="">
                </a>
            @endforeach

        </div>

    </div>
</div>
