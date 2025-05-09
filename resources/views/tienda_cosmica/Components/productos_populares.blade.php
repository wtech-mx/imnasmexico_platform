<div class="row">
    <div class="col-12 mt-5">
        <h3 class="text-center Quinsi titulos">Cósmica Skin</h3>
        <h2 class="text-center Avenir titulos">Productos Populares</h2>
        <p class="text-center">
            <img src="{{asset('cosmika/INICIO/ESTRELLAS-DORADAS.png')}}" alt="">
        </p>
    </div>
</div>

<div id="generalPopular" class="owl-carousel mt-4 mb-4">
    @foreach ($products_popular as $product_popular)
        @php
            $nombre = $product_popular->nombre;
            $partes = explode(' ', $nombre, 2); // Divide el nombre en máximo 2 partes
            $primeraPalabra = $partes[0]; // La primera palabra
            $restoDelTexto = $partes[1] ?? ''; // El resto del texto, si existe
        @endphp
        <div class="item">
            <div class="container_lineas_grid" style="height: 350px;">

                <div class="content mt-3">
                    <div class="img_container mx-auto">
                        <a href="{{ route('tienda.single_product', $product_popular->slug) }}" class="">
                            <img class="img_grid_products" src="{{$product_popular->imagenes}}" alt="Protector">
                        </a>
                    </div>
                    <h4 class="text-center Avenir color_2 title_lineagrid m-0">{{ $primeraPalabra }}</h4>
                    <h5 class="text-center Avenir color_2 subtitle_lineagrid m-0">{{ $restoDelTexto }}</h5>
                    <p class="text-center">
                        <a href="{{ route('tienda.single_product', $product_popular->slug) }}" class="btn btn_plus_grid">
                            <img class="img_btn_plus_grid" src="{{ asset('cosmika/inicio/AGREGAR-POPULARES.png') }}" alt="">
                        </a>
                    </p>
                </div>

            </div>
        </div>
    @endforeach
</div>
