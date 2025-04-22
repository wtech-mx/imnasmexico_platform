@php
    $colores = ['#FEEFEA', '#F2FCE4', '#FFFCEB', '#ECFFEC', '#FFF3FF', '#FFF3EB'];
    $indiceColor = 0;
@endphp

<style>
.owl-carousel .item {
    text-align: center;
    margin-bottom: 40px;
}

</style>

<div class="container-lg px-2 px-md-3 px-lg-4 py-0 py-md-3 py-lg-3" style="margin-top: 6rem;">
    <div class="row">
        <div class="col-12">
            <h3 class="mb-4 mt-5  mt-sm-5 mt-md-5 mt-lg-5  mt-xl-0">
                Lineas Corporales
            </h3>
        </div>
    </div>

    <!-- Owl Carousel -->
    <div id="departmentsCarouselCorporal" class="owl-carousel">
        @foreach ($categoriasCorporal as $categoria)
            <a href="{{ route('tienda_online.categories', $categoria->slug) }}" style="text-decoration: none;">
                <div class="item">
                    <div class="container_categories" style="background-color: {{ $colores[$indiceColor] }}">
                        <div class="container_img_box mx-auto img_categories_2" style="background: url('{{ asset('categorias/'.$categoria->imagen) }}') #ffffff00  50% / contain no-repeat;"></div>
                        <h4 class="text-center text-dark title_categories" style="">
                            {{$categoria->nombre}}
                        </h4>
                    </div>
                </div>
            </a>
            @php
                $indiceColor = ($indiceColor + 1) % count($colores);
            @endphp
        @endforeach
    </div>

</div>
