<div id="carousel_Single_Product" class="owl-carousel">

    @foreach ($products_interesar as $product_interesar)
        @php
            $nombre = $product_interesar->nombre;
            $partes = explode(' ', $nombre, 2); // Divide el nombre en máximo 2 partes
            $primeraPalabra = $partes[0]; // La primera palabra
            $restoDelTexto = $partes[1] ?? ''; // El resto del texto, si existe
        @endphp
        <div class="item">

            <div class="container_lineas_single_carousel mx-auto" style="width:80%; ">
                <div class="content mb-3 mt-3">
                    <div class="img_container_single_corousel mx-auto">
                        <img class="img_grid_products_single_carousel" src="{{$product_interesar->imagenes}}" alt="Protector">
                    </div>
                </div>
            </div>

            <h2 class="text-center titulo_producto_carousel mt-4">
                <strong>{{$primeraPalabra}}</strong> <br>
                {{$restoDelTexto}}
            </h2>

            <h4 class="text-center price_producto_carousel mt-3">
                <strong class="">${{number_format($product_interesar->precio_normal, 0, '.', ',')}}</strong>
            </h4>

            <p class="text-center">

                <a href="" class="text-center mt-3">
                    <img class="icon_single_item_slide" src="{{ asset('cosmika/inicio/CORAZON-POPULARES.png') }}" alt="" style="width: 25px;margin-right: auto;margin-left: auto;">
                </a>
            </p>
            <p class="text-center">

                <a href="{{ route('tienda.single_product', $product_interesar->sku) }}" class="text-center mt-3">
                    <img class="icon_single_item_slide" src="{{ asset('cosmika/inicio/AGREGAR-POPULARES.png') }}" alt="" style="width: 25px;margin-right: auto;margin-left: auto;">
                </a>
            </p>

        </div>
    @endforeach

</div>
