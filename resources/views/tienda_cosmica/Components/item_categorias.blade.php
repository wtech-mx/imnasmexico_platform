@php
$nombre = $product->nombre;
$partes = explode(' ', $nombre, 2); // Divide el nombre en máximo 2 partes
$primeraPalabra = $partes[0]; // La primera palabra
$restoDelTexto = $partes[1] ?? ''; // El resto del texto, si existe
@endphp
<div class="col-6 col-sm-6 col-md-4 col-lg-3">
    <a href="{{ route('tienda.single_product', $product->slug) }}" class="text-center mt-3">
        <div class="container_lineas_single_carousel mx-auto" style="width:80%; ">
            <div class="content mb-3 mt-3">
                <div class="img_container_single_corousel mx-auto">
                    <img class="img_grid_products_single_carousel" src="{{$product->imagenes}}" alt="Protector">
                </div>
            </div>
        </div>
    </a>

    <h2 class="text-center titulo_producto_carousel mt-4">
        <strong>{{$primeraPalabra}}</strong> <br>
        {{$restoDelTexto}}
    </h2>

    <h4 class="text-center price_producto_carousel mt-3">
        <strong class="">${{number_format($product->precio_normal, 0, '.', ',')}}</strong>
    </h4>

    <p class="text-center">
        <a href="{{ route('tienda.single_product', $product->slug) }}" class="text-center mt-3">
            <img class="icon_single_item_slide" src="{{ asset('cosmika/inicio/AGREGAR-POPULARES.png') }}" alt="" style="width: 25px;margin-right: auto;margin-left: auto;">
        </a>
    </p>
</div>
