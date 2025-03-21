<div class="container-lg px-2 px-md-3 px-lg-4 py-0 py-md-3 py-lg-3">
    <div class="row">
        <div class="col-12">
            <h3 class="mb-4">
                Nuestros Pasillos
            </h3>
        </div>
    </div>

    <!-- Owl Carousel -->
    <div id="departmentsCarousel" class="owl-carousel">
        @foreach ($categorias as $categoria)
            @if (trim($categoria->nombre) === "Lacteos" || trim($categoria->nombre) === "Verduras" || trim($categoria->nombre) === "Sin categoria")
                @continue
            @endif

            <a href="{{ route('tienda_online.categories', $categoria->slug) }}" style="text-decoration: none;">
                <div class="item">
                    <div class="container_categories" style="background-color: {{$categoria->color}}">
                        <div class="container_img_box mx-auto img_categories_2" style="background: url('{{ asset('categorias/'.$categoria->imagen) }}') #ffffff00  50% / contain no-repeat;"></div>
                        <h4 class="text-center text-dark title_categories">
                            {{$categoria->nombre}}
                        </h4>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

</div>
