<div class="container-lg px-2 px-md-3 px-lg-4 py-0 py-md-3 py-lg-3">
    <div class="row">
        <div class="col-12">
            <h3 class="mb-4">
                Ofertas y Promociones
            </h3>
        </div>

        <div class="col-4 col-sm-4 col-md-4 col-lg-4">
            <a href="{{$configuracion->oferta_link1}}">
                <img class="img_post_promos" src="{{ asset('ofertas/'.$configuracion->oferta_1) }}" alt="">
            </a>
        </div>
        <div class="col-4 col-sm-4 col-md-4 col-lg-4">
            <a href="{{$configuracion->oferta_link2}}">
                <img class="img_post_promos" src="{{ asset('ofertas/'.$configuracion->oferta_2) }}" alt="">
            </a>
        </div>
        <div class="col-4 col-sm-4 col-md-4 col-lg-4">
            <a href="{{$configuracion->oferta_link3}}">
                <img class="img_post_promos" src="{{ asset('ofertas/'.$configuracion->oferta_3) }}" alt="">
            </a>
        </div>
    </div>
</div>
