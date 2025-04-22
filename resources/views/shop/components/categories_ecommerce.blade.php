@php
    $colores = ['#FEEFEA', '#F2FCE4', '#FFFCEB', '#ECFFEC', '#FFF3FF', '#FFF3EB'];
    $indiceColor = 0;
@endphp

<div class="container-lg px-2 px-md-3 px-lg-4 py-0 py-md-3 py-lg-3">
    <div class="row">
        <div class="col-12">
            <h3 class="mb-4">
                Lineas Faciales
            </h3>
        </div>
    </div>

    <!-- Owl Carousel -->
    <div id="departmentsCarousel" class="owl-carousel">
        @foreach ($categoriasFacial as $categoria)
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
